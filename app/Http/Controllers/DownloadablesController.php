<?php

namespace App\Http\Controllers;

use App\Actions\StoreDownloadableAction;
use App\Http\Requests\StoreDownloadableRequest;
use App\Models\Downloadable;
use Illuminate\Http\Request;

class DownloadablesController extends Controller
{
    public function store(StoreDownloadableRequest $request, StoreDownloadableAction $storeDownloadable)
    {
        $downloadable = $storeDownloadable->execute(
            $request->title,
            $request->file('file')
        );

        return $downloadable;
    }
}
