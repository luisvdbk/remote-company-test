<?php

namespace App\Http\Controllers\Admin;

use App\Actions\StoreDownloadableAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDownloadableRequest;
use App\Http\Resources\DownloadableResource;
use App\Models\Downloadable;
use Illuminate\Http\Request;

class DownloadablesController extends Controller
{
    public function index(Request $request)
    {
        $downloadables = Downloadable::query()->simplePaginate();

        return inertia('Admin/Downloadables/Index', [
            'downloadables' => DownloadableResource::collection($downloadables),
        ]);
    }

    public function create(Request $request)
    {

    }

    public function store(StoreDownloadableRequest $request, StoreDownloadableAction $storeDownloadable)
    {
        $downloadable = $storeDownloadable->execute(
            $request->title,
            $request->file('file')
        );

        return $downloadable;
    }

    public function view(Downloadable $downloadable, Request $request)
    {
        
    }
}
