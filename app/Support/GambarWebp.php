<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use RuntimeException;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class GambarWebp
{
    public static function simpan(UploadedFile $file, string $folder, int $kualitas = 80): string
    {
        if (config('filesystems.disks.cloudinary.url')) {
            try {
                $hasil = Cloudinary::uploadApi()->upload($file->getRealPath(), [
                    'folder' => 'web-gua3/' . $folder,
                    'format' => 'webp',
                    'quality' => 'auto',
                ]);

                return $hasil['secure_url'];
            } catch (\Exception $e) {
                throw new RuntimeException('Gagal mengunggah gambar ke Cloudinary: ' . $e->getMessage());
            }
        }

        $dir = public_path('images/' . $folder);
        if (! is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        $gambar = match (strtolower($file->getClientOriginalExtension())) {
            'png' => @imagecreatefrompng($file->getRealPath()),
            'gif' => @imagecreatefromgif($file->getRealPath()),
            'webp' => @imagecreatefromwebp($file->getRealPath()),
            default => @imagecreatefromjpeg($file->getRealPath()),
        };

        if (! $gambar) {
            throw new RuntimeException('Gagal membaca gambar yang diunggah.');
        }

        if (function_exists('exif_read_data')) {
            $orientasi = (int) (@exif_read_data($file->getRealPath())['Orientation'] ?? 0);
            if (in_array($orientasi, [3, 6, 8], true)) {
                $asli = $gambar;
                $gambar = match ($orientasi) {
                    3 => imagerotate($asli, 180, 0),
                    6 => imagerotate($asli, -90, 0),
                    8 => imagerotate($asli, 90, 0),
                    default => $asli,
                };
                if ($gambar !== $asli) {
                    imagedestroy($asli);
                }
            }
        }

        $nama = Str::random(20) . '.webp';
        $path = $dir . DIRECTORY_SEPARATOR . $nama;

        imagepalettetotruecolor($gambar);
        imagesavealpha($gambar, true);
        imagealphablending($gambar, true);

        $tersimpan = imagewebp($gambar, $path, $kualitas);
        imagedestroy($gambar);

        if (! $tersimpan) {
            @unlink($path);
            throw new RuntimeException('Gagal menyimpan gambar webp.');
        }

        return 'images/' . $folder . '/' . $nama;
    }

    public static function hapus(?string $path): void
    {
        if (!$path) return;

        if (str_starts_with($path, 'http')) {
            // Jika ini URL Cloudinary, ekstrak public ID dan hapus
            if (config('filesystems.disks.cloudinary.url') && str_contains($path, 'cloudinary.com')) {
                try {
                    $parts = explode('/', parse_url($path, PHP_URL_PATH));
                    $filename = end($parts);
                    $publicId = explode('.', $filename)[0];
                    
                    // Mendapatkan struktur folder dari path
                    // Asumsi: path Cloudinary biasanya .../upload/v1234/folder/subfolder/file.ext
                    $uploadIndex = array_search('upload', $parts);
                    if ($uploadIndex !== false && count($parts) > $uploadIndex + 2) {
                        $folders = array_slice($parts, $uploadIndex + 2, -1);
                        $fullPublicId = implode('/', $folders) . '/' . $publicId;
                        Cloudinary::uploadApi()->destroy($fullPublicId);
                    }
                } catch (\Exception $e) {
                    // Abaikan error saat menghapus di Cloudinary
                }
            }
            return;
        }

        if (is_file(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}