<?php

namespace Tests\Feature\Admin\Downloadables;

use App\Models\Downloadable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DownloadablesDestroyTest extends TestCase
{
    public function test_it_removes_downloadable_record_and_stored_file()
    {
        $storage = Storage::fake(Downloadable::STORAGE_DISK);

        $storage->put('downloadables/test-file.pdf', 'pdf contents');
       
        $downloadable = Downloadable::factory()->create([
            'path' => 'downloadables/test-file.pdf',
        ]);

        $this
            ->delete(route('admin.downloadables.destroy', $downloadable->id))
            ->assertRedirect(route('admin.downloadables.index'));

        $this->assertNull($downloadable->fresh());

        $this->assertCount(0, $storage->allFiles('downloadables'));
    }
}
