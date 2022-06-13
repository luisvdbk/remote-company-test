<?php

namespace Tests\Feature\Admin\Downloadables;

use App\Models\Downloadable;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ListDownloadablesTest extends TestCase
{
    /** @test */
    public function it_returns_a_paginated_list_of_downloadables()
    {
        Downloadable::factory(5)->create();
        
        $this
            ->get(route('admin.downloadables.index'))
            ->assertOk()
            ->assertInertia(function (Assert $page) {
                $page
                    ->component('Admin/Downloadables/Index')
                    ->has('downloadables.data', 5, fn (Assert $page) => $page->hasAll(['id', 'title', 'url']))
                    ->has('downloadables.links')
                    ->has('downloadables.meta');
            });
    }
}
