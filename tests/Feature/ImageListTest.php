<?php

namespace Tests\Feature;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImageListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_a_list_of_images()
    {
        $images = Image::factory()->count(20)->create();

        $this->withoutExceptionHandling();
        $response = $this->getJson('/images');

        $response->assertStatus(200);

        $data = $response->json('images.data');
        $this->assertCount(10, $data);
    }
}
