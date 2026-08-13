<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use RuntimeException;

class GambarWebp
{
    public static function simpan(UploadedFile $file, string $folder, int $kualitas = 80): string
    {
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
        if ($path && is_file(public_path($path))) {
            @unlink(public_path($path));
        }
    }
}