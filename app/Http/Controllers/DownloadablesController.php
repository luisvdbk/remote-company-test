<?php

namespace App\Http\Controllers;

use App\Http\Resources\DownloadableResource;
use App\Models\Downloadable;
use Illuminate\Http\Request;

class DownloadablesController extends Controller
{
    public function index(Request $request)
    {
        $downloadables = Downloadable::query()->latest()->simplePaginate(10);

        return inertia('App/Downloadables/Index', [
            'downloadables' =>  DownloadableResource::collection($downloadables),
        ]);
    }
}
