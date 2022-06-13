<?php

namespace Tests\Feature\Downloadables;

use App\Models\Downloadable;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StoreDownloadableTest extends TestCase
{
    /** @test */
    public function downlodable_can_be_stored()
    {
        Storage::fake(Downloadable::STORAGE_DISK);

        $this->post(route('admin.downloadables.store'), [
            'title' => 'Example title',
            'file' => $fakeFile = UploadedFile::fake()->create('test-file.pdf'),
        ])
        ->assertStatus(Response::HTTP_CREATED);

        $downloadable = Downloadable::latest()->first();
        $storedFiles = Storage::disk(Downloadable::STORAGE_DISK)->allFiles('downloadables');
        $storedDownloadable = $storedFiles[0];

        $this->assertEquals('Example title', $downloadable->title);
        $this->assertEquals($storedDownloadable, $downloadable->path);

        $this->assertCount(1, $storedFiles);
        $this->assertEquals($fakeFile->getContent(), Storage::get($storedDownloadable));
    }
}
