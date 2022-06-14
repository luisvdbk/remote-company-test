<?php

namespace Tests\Feature\Admin\Downloadables;

use App\Models\Downloadable;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class DownloadablesIndexTest extends TestCase
{
    /** @test */
    public function is_displays_the_index_view_with_a_paginated_list_of_downloadables()
    {
        $downloadableA = Downloadable::factory()->create(['created_at' => now()->subDays(2)]);
        $downloadableB = Downloadable::factory()->create(['created_at' => now()->subDays(1)]);
        $downloadableC = Downloadable::factory()->create(['created_at' => now()->subDays(3)]);
       
        
        $this
            ->get(route('admin.downloadables.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) =>
                $page
                    ->component('Admin/Downloadables/Index')
                    ->has('downloadables.data', 3, fn (Assert $page) => $page->hasAll(['id', 'title', 'url']))
                    ->where('downloadables.data.0.id', $downloadableB->id)
                    ->where('downloadables.data.1.id', $downloadableA->id)
                    ->where('downloadables.data.2.id', $downloadableC->id)
                    ->has('downloadables.links')
                    ->has('downloadables.meta')
            );
    }
}
