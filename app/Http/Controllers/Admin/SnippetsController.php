<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSnippetRequest;
use App\Http\Requests\UpdateSnippetRequest;
use App\Http\Resources\SnippetResource;
use App\Models\Snippet;
use Illuminate\Http\Request;

class SnippetsController extends Controller
{
    public function index(Request $request)
    {
        $snippets = Snippet::query()->latest()->simplePaginate(10);

        return inertia('Admin/Snippets/Index', [
            'snippets' => SnippetResource::collection($snippets),
        ]);
    }

    public function create(Request $request)
    {
        return inertia('Admin/Snippets/Create');
    }

    public function store(StoreSnippetRequest $request)
    {
        Snippet::create([
            'title' => $request->title,
            'description' => $request->description,
            'contents' => $request->contents,
        ]);

        return redirect()->route('admin.snippets.index')->with('message', 'Successfully added a new snippet');
    }

    public function edit(Snippet $snippet, Request $request)
    {
        return inertia('Admin/Snippets/Edit', [
            'snippet' => new SnippetResource($snippet),
        ]);
    }

    public function update(Snippet $snippet, UpdateSnippetRequest $request)
    {
        $snippet->update([
            'title' => $request->title,
            'description' => $request->description,
            'contents' => $request->contents,
        ]);
        
        return redirect()->route('admin.snippets.index')->with('message', 'Successfully updated snippet');
    }

    public function destroy(Snippet $snippet, Request $request)
    {
        $snippet->delete();

        return redirect()->route('admin.snippets.index')->with('message', 'Successfully deleted the snippet');
    }
}
