<?php

namespace Tests\Feature\Admin\Downloadables;

use App\Models\Snippet;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class SnippetsShowTest extends TestCase
{
    /** @test */
    public function is_displays_the_show_view()
    {
        $snippet = Snippet::factory()->create();
        
        $this
            ->get(route('snippets.show', $snippet->id))
            ->assertOk()
            ->assertInertia(fn (Assert $page) =>
                $page
                    ->component('App/Snippets/Show')
                    ->has('snippet.id')
                    ->where('snippet.id', $snippet->id)
            );
    }
}
