<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Throwable;

class StaffController extends BaseController
{
    private UserModel $users;

    public function __construct()
    {
        $this->users = new UserModel();
    }

    public function index()
    {
        return view('staff/index', [
            'title' => 'Staff',
            'staff' => $this->users->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('staff/form', [
            'title' => 'Add Staff Member',
            'staffMember' => [
                'id' => '',
                'username' => '',
                'full_name' => '',
                'avatar' => null,
            ],
            'formAction' => site_url('staff'),
            'buttonText' => 'Save Staff Member',
            'isEditing' => false,
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->staffRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        [$avatar, $avatarError] = $this->saveAvatar();

        if ($avatarError !== null) {
            return redirect()->back()->withInput()->with('error', $avatarError);
        }

        try {
            $saved = $this->users->insert([
                'username' => trim((string) $this->request->getPost('username')),
                'full_name' => trim((string) $this->request->getPost('full_name')),
                'password' => password_hash((string) $this->request->getPost('password'), PASSWORD_DEFAULT),
                'avatar' => $avatar,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (Throwable $exception) {
            $saved = false;
        }

        if (! $saved) {
            $this->removeAvatar($avatar);

            return redirect()->back()
                ->withInput()
                ->with('error', 'The staff account could not be saved. Check that the username is not already in use.');
        }

        return redirect()->to(site_url('staff'))
            ->with('success', 'Staff account added successfully.');
    }

    public function edit(int $id)
    {
        $staffMember = $this->users->find($id);

        if (! $staffMember) {
            throw PageNotFoundException::forPageNotFound('Staff member not found.');
        }

        return view('staff/form', [
            'title' => 'Edit Staff Member',
            'staffMember' => $staffMember,
            'formAction' => site_url('staff/' . $id . '/update'),
            'buttonText' => 'Update Staff Member',
            'isEditing' => true,
        ]);
    }

    public function update(int $id)
    {
        $staffMember = $this->users->find($id);

        if (! $staffMember) {
            throw PageNotFoundException::forPageNotFound('Staff member not found.');
        }

        if (! $this->validate($this->staffRules($id))) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        [$newAvatar, $avatarError] = $this->saveAvatar();

        if ($avatarError !== null) {
            return redirect()->back()->withInput()->with('error', $avatarError);
        }

        $data = [
            'username' => trim((string) $this->request->getPost('username')),
            'full_name' => trim((string) $this->request->getPost('full_name')),
            'avatar' => $newAvatar ?? $staffMember['avatar'],
        ];

        $newPassword = (string) $this->request->getPost('password');

        if ($newPassword !== '') {
            $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
        }

        try {
            $saved = $this->users->update($id, $data);
        } catch (Throwable $exception) {
            $saved = false;
        }

        if (! $saved) {
            $this->removeAvatar($newAvatar);

            return redirect()->back()
                ->withInput()
                ->with('error', 'The account could not be updated. Check that the username is not already in use.');
        }

        if ($newAvatar !== null) {
            $this->removeAvatar($staffMember['avatar'] ?? null);
        }

        return redirect()->to(site_url('staff'))
            ->with('success', 'Staff account updated successfully.');
    }

    public function delete(int $id)
    {
        $staffMember = $this->users->find($id);

        if (! $staffMember) {
            throw PageNotFoundException::forPageNotFound('Staff member not found.');
        }

        if ((int) session()->get('user_id') === $id) {
            return redirect()->to(site_url('staff'))
                ->with('error', 'You cannot delete the staff account currently signed in.');
        }

        try {
            $deleted = $this->users->delete($id);
        } catch (Throwable $exception) {
            return redirect()->to(site_url('staff'))
                ->with('error', 'This staff account could not be deleted. It may be linked to a sale.');
        }

        if (! $deleted) {
            return redirect()->to(site_url('staff'))
                ->with('error', 'The staff account could not be deleted.');
        }

        $this->removeAvatar($staffMember['avatar'] ?? null);

        return redirect()->to(site_url('staff'))
            ->with('success', 'Staff account deleted successfully.');
    }

    private function staffRules(?int $id = null): array
    {
        $usernameRule = 'required|alpha_numeric_punct|min_length[3]|max_length[50]|is_unique[users.username]';

        if ($id !== null) {
            $usernameRule = "required|alpha_numeric_punct|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]";
        }

        $passwordRule = $id === null
            ? 'required|min_length[8]'
            : 'permit_empty|min_length[8]';

        return [
            'username' => $usernameRule,
            'full_name' => 'required|max_length[100]',
            'password' => $passwordRule,
        ];
    }

    /**
     * @return array{0: ?string, 1: ?string}
     */
    private function saveAvatar(): array
    {
        $file = $this->request->getFile('avatar');

        if ($file === null || $file->getError() === UPLOAD_ERR_NO_FILE) {
            return [null, null];
        }

        if (! $file->isValid()) {
            return [null, 'The avatar upload failed. Please choose the image again.'];
        }

        if ($file->getSize() > 2 * 1024 * 1024) {
            return [null, 'The avatar must be 2 MB or smaller.'];
        }

        $mimeExtensions = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
        ];

        $mimeType = $file->getMimeType();

        if (! isset($mimeExtensions[$mimeType])) {
            return [null, 'Choose a JPG or PNG avatar.'];
        }

        $directory = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars';

        if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) {
            return [null, 'The avatar folder could not be created.'];
        }

        $newName = bin2hex(random_bytes(16)) . '.' . $mimeExtensions[$mimeType];

        try {
            $file->move($directory, $newName);
        } catch (Throwable $exception) {
            return [null, 'The avatar could not be saved. Please try again.'];
        }

        return [$newName, null];
    }

    private function removeAvatar(?string $avatar): void
    {
        if (empty($avatar)) {
            return;
        }

        $path = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'avatars'
            . DIRECTORY_SEPARATOR . basename($avatar);

        if (is_file($path)) {
            unlink($path);
        }
    }
}