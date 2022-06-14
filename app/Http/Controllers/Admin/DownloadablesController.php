<?php

namespace App\Http\Controllers\Admin;

use App\Actions\DestroyDownloadableAction;
use App\Actions\StoreDownloadableAction;
use App\Actions\UpdateDownloadableAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDownloadableRequest;
use App\Http\Requests\UpdateDownloadableRequest;
use App\Http\Resources\DownloadableResource;
use App\Models\Downloadable;
use Illuminate\Http\Request;

class DownloadablesController extends Controller
{
    public function index(Request $request)
    {
        $downloadables = Downloadable::query()->latest()->simplePaginate(10);

        return inertia('Admin/Downloadables/Index', [
            'downloadables' => DownloadableResource::collection($downloadables),
        ]);
    }

    public function create(Request $request)
    {
        return inertia('Admin/Downloadables/Create');
    }

    public function store(StoreDownloadableRequest $request, StoreDownloadableAction $storeDownloadable)
    {
        $storeDownloadable->execute(
            $request->title,
            $request->file('file')
        );

        return redirect()->route('admin.downloadables.index')->with('message', 'Successfully added a new downloadable');
    }

    public function edit(Downloadable $downloadable, Request $request)
    {
        return inertia('Admin/Downloadables/Edit', [
            'downloadable' => new DownloadableResource($downloadable),
        ]);
    }

    public function update(Downloadable $downloadable, UpdateDownloadableRequest $request, UpdateDownloadableAction $updateDownloadable)
    {
        $updateDownloadable->execute(
            $downloadable,
            $request->title,
            $request->file('file')
        );
        
        return redirect()->route('admin.downloadables.index')->with('message', 'Successfully updated downloadable');
    }

    public function destroy(Downloadable $downloadable, Request $request, DestroyDownloadableAction $destroyDownloadable)
    {
        $destroyDownloadable->execute($downloadable);
        
        return redirect()->route('admin.downloadables.index')->with('message', 'Successfully deleted the downloadable');
    }
}
