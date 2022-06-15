<?php

namespace Tests\Feature\Admin\snippets;

use App\Models\Snippet;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class SnippetsIndexTest extends TestCase
{
    /** @test */
    public function it_displays_the_index_view_with_a_paginated_list_of_snippets()
    {
        $snippetA = Snippet::factory()->create(['created_at' => now()->subDays(2)]);
        $snippetB = Snippet::factory()->create(['created_at' => now()->subDays(1)]);
        $snippetC = Snippet::factory()->create(['created_at' => now()->subDays(3)]);
       
        
        $this
            ->get(route('admin.snippets.index'))
            ->assertOk()
            ->assertInertia(fn (Assert $page) =>
                $page
                    ->component('Admin/Snippets/Index')
                    ->has('snippets.data', 3, fn (Assert $page) => $page->hasAll(['id', 'title', 'description', 'contents']))
                    ->where('snippets.data.0.id', $snippetB->id)
                    ->where('snippets.data.1.id', $snippetA->id)
                    ->where('snippets.data.2.id', $snippetC->id)
                    ->has('snippets.links')
                    ->has('snippets.meta')
            );
    }
}
