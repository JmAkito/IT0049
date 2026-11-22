<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View { return view('users.index', ['users' => User::orderBy('full_name')->get()]); }
    public function create(): View { return view('users.form', ['staff' => new User(), 'heading' => 'Add staff account']); }
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        if ($request->hasFile('avatar')) $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        User::create($data);
        return redirect()->route('users.index')->with('success', 'Staff account created.');
    }
    public function edit(User $user): View { return view('users.form', ['staff' => $user, 'heading' => 'Edit staff account']); }
    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $this->validated($request, $user);
        if (empty($data['password'])) unset($data['password']);
        $oldAvatar = $user->avatar;
        if ($request->hasFile('avatar')) $data['avatar'] = $request->file('avatar')->store('avatars', 'public');
        $user->update($data);
        if (isset($data['avatar']) && $oldAvatar) Storage::disk('public')->delete($oldAvatar);
        return redirect()->route('users.index')->with('success', 'Staff account updated.');
    }
    public function destroy(User $user): RedirectResponse
    {
        if ($user->is(auth()->user())) return back()->with('error', 'You cannot delete the account you are currently using.');
        if ($user->sales()->exists()) return back()->with('error', 'This staff member has sales records and cannot be deleted.');
        if ($user->avatar) Storage::disk('public')->delete($user->avatar);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Staff account deleted.');
    }
    private function validated(Request $request, ?User $user = null): array
    {
        return $request->validate([
            'full_name' => ['required', 'string', 'max:120'],
            'username' => ['required', 'string', 'max:60', 'alpha_dash', 'unique:users,username'.($user ? ','.$user->id : '')],
            'password' => [$user ? 'nullable' : 'required', 'string', 'min:8', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }
}
