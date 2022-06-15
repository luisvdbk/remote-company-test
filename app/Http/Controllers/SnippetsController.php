<?php

namespace App\Http\Controllers;

use App\Http\Resources\SnippetResource;
use App\Models\Snippet;
use Illuminate\Http\Request;

class SnippetsController extends Controller
{
    public function index(Request $request)
    {
        $snippets = Snippet::query()->latest()->simplePaginate(10);

        return inertia('App/Snippets/Index', [
            'snippets' =>  SnippetResource::collection($snippets),
        ]);
    }

    public function show(Snippet $snippet, Request $request)
    {
        return inertia('App/Snippets/Show', [
            'snippet' =>  new SnippetResource($snippet),
        ]);
    }
}
