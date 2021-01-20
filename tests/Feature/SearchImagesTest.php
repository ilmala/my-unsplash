<?php

namespace Tests\Feature;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchImagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_search_in_images_list()
    {
        $imageA = Image::factory()->create(['label'=> 'You can find this image']);
        $imageB = Image::factory()->create(['label'=> 'Other image']);

        $this->withoutExceptionHandling();
        $response = $this->getJson("/images?search=find");

        $response->assertStatus(200);

        $data = $response->json('images.data');

        $this->assertCount(1, $data);
        $this->assertEquals('You can find this image', $data[0]['label']);
    }
}
