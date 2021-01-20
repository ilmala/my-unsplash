<?php

namespace Tests\Feature;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteImagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_delete_a_image()
    {
        $image = Image::factory()->create(['label'=> 'You can find this image']);

        $response = $this->deleteJson(route('images.destroy', $image));

        $response->assertStatus(200);

        $this->assertDatabaseCount('images', 0);
    }
}
