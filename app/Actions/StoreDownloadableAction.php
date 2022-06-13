<?php

namespace App\Actions;

use App\Models\Downloadable;
use Illuminate\Http\UploadedFile;

class StoreDownloadableAction
{
    public function execute(string $title, UploadedFile $file): Downloadable
    {
        $path = $file->store('downloadables', 'public');

        $downloadable = Downloadable::create([
            'title' => $title,
            'path' => $path,
        ]);

        return $downloadable;
    }
}