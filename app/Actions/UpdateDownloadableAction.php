<?php

namespace App\Actions;

use App\Models\Downloadable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UpdateDownloadableAction
{
    /**
     * Note: when the downloadable starts growing in fields it might be worth to refactor the title and file parameters as a DTO
     */
    public function execute(Downloadable $downloadable, string $title, ?UploadedFile $file): Downloadable
    {
        $downloadable->title = $title;

        if ($file) {
            $newPath = $file->store('downloadables', Downloadable::STORAGE_DISK);
            $oldPath = $downloadable->path;
            
            $downloadable->path = $newPath;

            Storage::disk(Downloadable::STORAGE_DISK)->delete($oldPath);
        }
        
        $downloadable->save();

        return $downloadable;
    }
}