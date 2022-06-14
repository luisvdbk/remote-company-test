<?php

namespace Tests\Feature\Admin\Downloadables;

use App\Models\Downloadable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Str;

class DownloadablesUpdateTest extends TestCase
{
    /** @test */
    public function downloadable_can_be_updated()
    {
        $storage = Storage::fake(Downloadable ::STORAGE_DISK);

        $storage->put($initialPath = 'downloadables/test-file.pdf', 'file contents');

        $downloadable = Downloadable::factory()->create([
            'title' => 'Initial title',
            'path' => $initialPath,
        ]);

        $this->put(route('admin.downloadables.update', $downloadable->id), [
            'title' => 'Updated title',
            'file' => $fakeFile = UploadedFile::fake()->create('test-file.pdf', 1000, 'application/pdf'),
        ])->assertRedirect(route('admin.downloadables.index'));

        $downloadable = Downloadable::latest()->first();
        $storedFiles = $storage->allFiles('downloadables');
        $storedDownloadable = $storedFiles[0];

        $this->assertEquals('Updated title', $downloadable->title);
        $this->assertEquals($storedDownloadable, $downloadable->path);

        $this->assertCount(1, $storedFiles);
        $this->assertEquals($fakeFile->getContent(), $storage->get($storedDownloadable));
    }

    /** @test */
    public function if_no_file_is_provided_the_old_one_is_kept()
    {
        $storage = Storage::fake(Downloadable ::STORAGE_DISK);

        $storage->put($initialPath = 'downloadables/test-file.pdf', 'file contents');
        
        $downloadable = Downloadable::factory()->create([
            'title' => 'Initial title',
            'path' => $initialPath,
        ]);

        $this->put(route('admin.downloadables.update', $downloadable->id), [
            'title' => 'Updated title',
            'file' => null,
        ])->assertRedirect(route('admin.downloadables.index'));

        $downloadable = Downloadable::latest()->first();
        $storedFiles = $storage->allFiles('downloadables');
        $storedDownloadable = $storedFiles[0];

        $this->assertEquals('Updated title', $downloadable->title);
        $this->assertEquals($storedDownloadable, $downloadable->path);

        $this->assertCount(1, $storedFiles);
        $this->assertEquals('file contents', $storage->get($storedDownloadable));
    }

    /**
     * @dataProvider validationProvider
     * @test
     */
    public function validations_must_pass(array $overrides = [], array $expectedErrors = [])
    {
        $data = array_merge([
            'title' => 'Updated title',
            'file' => null,
        ], $overrides);

        $this
            ->from(route('admin.downloadables.create'))
            ->post(route('admin.downloadables.store'), $data)
            ->assertRedirect(route('admin.downloadables.create'))
            ->assertSessionHasErrors($expectedErrors);
    }

    public function validationProvider(): array
    {
        return [
            'title cannot be null' => [['title' => null], ['title']],
            'title cannot be empty' => [['title' => null], ['title']],
            'title cannot be longer than 255 characters' => [['title' => Str::random(256)]],
            'if present, file cannot be null' => [['file' => null], ['file']],
            'if present, file type cannot be othern than pdf' => [
                ['file' => UploadedFile::fake()->create('test-file.jpg', 1000, 'image/jpeg')],
                ['file'],
            ],
            'if present, file size cannot be greater than 1 mb' => [
                ['file' => UploadedFile::fake()->create('test-file.pdf', 1001, 'application/pdf')],
                ['file'],
            ],
        ];
    }
}
