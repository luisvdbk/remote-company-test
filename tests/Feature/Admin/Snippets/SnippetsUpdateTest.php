<?php

namespace Tests\Feature\Admin\Downloadables;

use App\Models\Snippet;
use Tests\TestCase;
use Illuminate\Support\Str;

class SnippetsUpdateTest extends TestCase
{
    /** @test */
    public function snippet_can_be_updated()
    {
        $snippet = Snippet::factory()->create([
            'title' => 'Initial title',
            'description' => 'Initial description',
            'contents' => '<!DOCTYPE HTML><html></html>',
        ]);

        $this->put(route('admin.snippets.update', $snippet->id), [
            'title' => 'Updated title',
            'description' => 'Updated description',
            'contents' => '<!DOCTYPE HTML><html><div>Hello!</div></html>',
        ])->assertRedirect(route('admin.snippets.index'));

        $snippet = Snippet::latest()->first();

        $this->assertEquals('Updated title', $snippet->title);
        $this->assertEquals('Updated description', $snippet->description);
        $this->assertEquals('<!DOCTYPE HTML><html><div>Hello!</div></html>', $snippet->contents);
    }

    /**
     * @dataProvider validationProvider
     * @test
     */
    public function validations_must_pass(array $overrides = [], array $expectedErrors = [])
    {
        $data = array_merge([
            'title' => 'Test title',
            'description' => 'Test description',
            'contents' => '<!DOCTYPE HTML><html></html>',
        ], $overrides);

        $this
            ->from(route('admin.snippets.create'))
            ->post(route('admin.snippets.store'), $data)
            ->assertRedirect(route('admin.snippets.create'))
            ->assertSessionHasErrors($expectedErrors);

        $this->assertEquals(0, Snippet::query()->count());
    }

    public function validationProvider(): array
    {
        return [
            'title cannot be null' => [['title' => null], ['title']],
            'title cannot be empty' => [['title' => null], ['title']],
            'title cannot be longer than 255 characters' => [['title' => Str::random(256)]],

            'description cannot be null' => [['description' => null], ['description']],
            'description cannot be empty' => [['description' => null], ['description']],
            'description cannot be longer than 65535 characters' => [['description' => Str::random(65536)]],

            'contents cannot be null' => [['contents' => null], ['contents']],
            'contents cannot be empty' => [['contents' => null], ['contents']],
            'contents cannot be longer than 65535 characters' => [['contents' => Str::random(65536)]],
        ];
    }
}
