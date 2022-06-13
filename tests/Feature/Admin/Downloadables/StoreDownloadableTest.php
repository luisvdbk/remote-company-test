<?php

namespace Tests\Feature\Downloadables;

use App\Models\Downloadable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Str;

class StoreDownloadableTest extends TestCase
{
    /** @test */
    public function downloadable_can_be_stored()
    {
        Storage::fake(Downloadable::STORAGE_DISK);

        $this->post(route('admin.downloadables.store'), [
            'title' => 'Example title',
            'file' => $fakeFile = UploadedFile::fake()->create('test-file.pdf', 1000, 'application/pdf'),
        ])->assertCreated();

        $downloadable = Downloadable::latest()->first();
        $storedFiles = Storage::disk(Downloadable::STORAGE_DISK)->allFiles('downloadables');
        $storedDownloadable = $storedFiles[0];

        $this->assertEquals('Example title', $downloadable->title);
        $this->assertEquals($storedDownloadable, $downloadable->path);

        $this->assertCount(1, $storedFiles);
        $this->assertEquals($fakeFile->getContent(), Storage::get($storedDownloadable));
    }

    /**
     * @dataProvider validationProvider
     * @test
     */
    public function validations_must_pass(array $overrides = [], array $expectedErrors = [])
    {
        $data = array_merge([
            'title' => 'Example title',
            'file' => UploadedFile::fake()->create('test-file.pdf', 1000, 'application/pdf'),
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
            'file cannot be null' => [['file' => null], ['file']],
            'file type cannot be othern than pdf' => [
                ['file' => UploadedFile::fake()->create('test-file.jpg', 1000, 'image/jpeg')],
                ['file'],
            ],
            'file size cannot be greater than 1 mb' => [
                ['file' => UploadedFile::fake()->create('test-file.pdf', 1001, 'application/pdf')],
                ['file'],
            ],
        ];
    }
}
