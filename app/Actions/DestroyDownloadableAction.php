<?php

namespace App\Actions;

use App\Models\Downloadable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class DestroyDownloadableAction
{
    public function execute(Downloadable $downloadable): void
    {
        $downloadable->delete();

        Storage::disk(Downloadable::STORAGE_DISK)->delete($downloadable->path);
    }
}