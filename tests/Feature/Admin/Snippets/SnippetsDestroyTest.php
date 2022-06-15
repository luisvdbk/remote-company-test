<?php

namespace Tests\Feature\Admin\Downloadables;

use App\Models\Snippet;
use Tests\TestCase;

class SnippetsDestroyTest extends TestCase
{
    public function test_it_removes_snippet_record()
    {
        $snippet = Snippet::factory()->create();

        $this
            ->delete(route('admin.snippets.destroy', $snippet->id))
            ->assertRedirect(route('admin.snippets.index'));

        $this->assertNull($snippet->fresh());
    }
}
