<?php

namespace Tests\Feature;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AddImageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_upload_a_new_image()
    {
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('images.store'), [
            'label' => 'My image label',
            'url' => 'https://example.com/fake-image',
        ]);

        $response->assertStatus(200)->assertJsonFragment([
            'label' => 'My image label',
            'url' => 'https://example.com/fake-image',
        ]);

        $image = Image::first();
        $this->assertEquals('My image label', $image->label);
        $this->assertEquals('https://example.com/fake-image', $image->url);
    }

    /** @test */
    public function label_field_is_required()
    {
        $response = $this->postJson(route('images.store'), [
            'label' => '',
            'url' => 'https://example.com/fake-image',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('label');

        $this->assertDatabaseCount('images', 0);
    }

    /** @test */
    public function url_field_is_required()
    {
        $response = $this->postJson(route('images.store'), [
            'label' => 'My image label',
            'url' => '',
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('url');
    }
}
