<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RuntimeException;

class BerkasPdf
{
    public static function simpan(UploadedFile $file, string $folder): string
    {
        if (strtolower($file->getClientOriginalExtension()) !== 'pdf') {
            throw new RuntimeException('Berkas harus berformat PDF.');
        }

        $nama = Str::random(20) . '.pdf';
        $file->storeAs($folder, $nama, 'public');

        return $folder . '/' . $nama;
    }

    public static function hapus(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}