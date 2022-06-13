<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Downloadable extends Model
{
    use HasFactory;

    const STORAGE_DISK = 'public';

    public function getUrlAttribute(): string
    {
        if (! $path = $this->path) {
            return '';
        }

        return Storage::disk(self::STORAGE_DISK)->url($path);
    }
}
