<?php

namespace App\Controllers;

use App\Models\ProductModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Throwable;

class ProductController extends BaseController
{
    private ProductModel $products;

    public function __construct()
    {
        $this->products = new ProductModel();
    }

    public function index()
    {
        return view('products/index', [
            'title' => 'Products',
            'products' => $this->products->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function new()
    {
        return view('products/form', [
            'title' => 'Add Product',
            'product' => [
                'id' => '',
                'name' => '',
                'price' => '',
                'stock_quantity' => '',
                'image' => null,
            ],
            'formAction' => site_url('products'),
            'buttonText' => 'Save Product',
        ]);
    }

    public function create()
    {
        if (! $this->validate($this->productRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        [$imageName, $imageError] = $this->saveUploadedImage();

        if ($imageError !== null) {
            return redirect()->back()->withInput()->with('error', $imageError);
        }

        $saved = $this->products->insert([
            'name' => trim((string) $this->request->getPost('name')),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        if (! $saved) {
            $this->removeProductImage($imageName);

            return redirect()->back()
                ->withInput()
                ->with('error', 'The product could not be saved.');
        }

        return redirect()->to(site_url('products'))
            ->with('success', 'Product added successfully.');
    }

    public function edit(int $id)
    {
        $product = $this->products->find($id);

        if (! $product) {
            throw PageNotFoundException::forPageNotFound('Product not found.');
        }

        return view('products/form', [
            'title' => 'Edit Product',
            'product' => $product,
            'formAction' => site_url('products/' . $id . '/update'),
            'buttonText' => 'Update Product',
        ]);
    }

    public function update(int $id)
    {
        $product = $this->products->find($id);

        if (! $product) {
            throw PageNotFoundException::forPageNotFound('Product not found.');
        }

        if (! $this->validate($this->productRules())) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        [$newImageName, $imageError] = $this->saveUploadedImage();

        if ($imageError !== null) {
            return redirect()->back()->withInput()->with('error', $imageError);
        }

        $imageToSave = $newImageName ?? $product['image'];

        $saved = $this->products->update($id, [
            'name' => trim((string) $this->request->getPost('name')),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image' => $imageToSave,
        ]);

        if (! $saved) {
            if ($newImageName !== null) {
                $this->removeProductImage($newImageName);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'The product could not be updated.');
        }

        if ($newImageName !== null && ! empty($product['image'])) {
            $this->removeProductImage($product['image']);
        }

        return redirect()->to(site_url('products'))
            ->with('success', 'Product updated successfully.');
    }

    public function delete(int $id)
    {
        $product = $this->products->find($id);

        if (! $product) {
            throw PageNotFoundException::forPageNotFound('Product not found.');
        }

        try {
            $deleted = $this->products->delete($id);
        } catch (Throwable $exception) {
            return redirect()->to(site_url('products'))
                ->with('error', 'This product could not be deleted. It may be linked to a sale.');
        }

        if (! $deleted) {
            return redirect()->to(site_url('products'))
                ->with('error', 'The product could not be deleted.');
        }

        $this->removeProductImage($product['image'] ?? null);

        return redirect()->to(site_url('products'))
            ->with('success', 'Product deleted successfully.');
    }

    private function productRules(): array
    {
        return [
            'name' => 'required|max_length[100]',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
        ];
    }

    /**
     * @return array{0: ?string, 1: ?string}
     */
    private function saveUploadedImage(): array
    {
        $file = $this->request->getFile('image');

        if ($file === null || $file->getError() === UPLOAD_ERR_NO_FILE) {
            return [null, null];
        }

        if (! $file->isValid()) {
            return [null, 'The image upload failed. Please choose the image again.'];
        }

        if ($file->getSize() > 2 * 1024 * 1024) {
            return [null, 'The image must be 2 MB or smaller.'];
        }

        $mimeExtensions = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/webp' => 'webp',
        ];

        $mimeType = $file->getMimeType();

        if (! isset($mimeExtensions[$mimeType])) {
            return [null, 'Choose a JPG, PNG, or WEBP image.'];
        }

        $directory = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'products';

        if (! is_dir($directory) && ! mkdir($directory, 0755, true) && ! is_dir($directory)) {
            return [null, 'The product image folder could not be created.'];
        }

        $newName = bin2hex(random_bytes(16)) . '.' . $mimeExtensions[$mimeType];

        try {
            $file->move($directory, $newName);
        } catch (Throwable $exception) {
            return [null, 'The image could not be saved. Please try again.'];
        }

        return [$newName, null];
    }

    private function removeProductImage(?string $imageName): void
    {
        if (empty($imageName)) {
            return;
        }

        $safeName = basename($imageName);
        $path = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . 'products'
            . DIRECTORY_SEPARATOR . $safeName;

        if (is_file($path)) {
            unlink($path);
        }
    }
}