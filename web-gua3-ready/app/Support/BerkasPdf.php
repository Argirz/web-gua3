<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BerkasPdf
{
    public static function simpan(UploadedFile $file, string $folder): string
    {
        if (strtolower($file->getClientOriginalExtension()) !== 'pdf') {
            throw new RuntimeException('Berkas harus berformat PDF.');
        }

        if (env('CLOUDINARY_URL')) {
            try {
                return Cloudinary::upload($file->getRealPath(), [
                    'folder' => 'web-gua3/' . $folder,
                    'resource_type' => 'raw'
                ])->getSecurePath();
            } catch (\Exception $e) {
                throw new RuntimeException('Gagal mengunggah PDF ke Cloudinary: ' . $e->getMessage());
            }
        }

        $nama = Str::random(20) . '.pdf';
        $file->storeAs($folder, $nama, 'public');

        return $folder . '/' . $nama;
    }

    public static function hapus(?string $path): void
    {
        if (!$path) return;

        if (str_starts_with($path, 'http')) {
            if (env('CLOUDINARY_URL') && str_contains($path, 'cloudinary.com')) {
                try {
                    $parts = explode('/', parse_url($path, PHP_URL_PATH));
                    $filename = end($parts);
                    // raw file di cloudinary termasuk ekstensinya sebagai public_id
                    
                    $uploadIndex = array_search('upload', $parts);
                    if ($uploadIndex !== false && count($parts) > $uploadIndex + 2) {
                        $folders = array_slice($parts, $uploadIndex + 2, -1);
                        $fullPublicId = implode('/', $folders) . '/' . $filename;
                        Cloudinary::destroy($fullPublicId, ['resource_type' => 'raw']);
                    }
                } catch (\Exception $e) {
                    // Abaikan
                }
            }
            return;
        }

        if (is_file(public_path('storage/' . $path))) {
            Storage::disk('public')->delete($path);
        }
    }
}