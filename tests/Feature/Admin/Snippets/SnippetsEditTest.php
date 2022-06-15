<?php

namespace Tests\Feature\Admin\Downloadables;

use App\Models\Downloadable;
use App\Models\Snippet;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class SnippetsEditTest extends TestCase
{
    /** @test */
    public function is_displays_the_edit_view()
    {
        $snippet = Snippet::factory()->create();
        
        $this
            ->get(route('admin.snippets.edit', $snippet->id))
            ->assertOk()
            ->assertInertia(fn (Assert $page) =>
                $page
                    ->component('Admin/Snippets/Edit')
                    ->has('snippet.id')
                    ->where('snippet.id', $snippet->id)
            );
    }
}
