<?php

namespace Tests\Feature\Admin\Downloadables;

use App\Models\Downloadable;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class DownloadablesEditTest extends TestCase
{
    /** @test */
    public function is_displays_the_edit_view()
    {
        $downloadable = Downloadable::factory()->create();
        
        $this
            ->get(route('admin.downloadables.edit', $downloadable->id))
            ->assertOk()
            ->assertInertia(fn (Assert $page) =>
                $page
                    ->component('Admin/Downloadables/Edit')
                    ->has('downloadable.id')
                    ->where('downloadable.id', $downloadable->id)
            );
    }
}
