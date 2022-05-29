<?php

namespace Tests\Unit;

use App\Models\Banner;
use Tests\TestCase;

class BannerTest extends TestCase
{
    /**
     * Test for checking GET /api/banners
     *
     * @return void
     */
    public function test_banners_get_list()
    {
        $response = $this->getJson('/api/banners')->assertOk();
        $this->assertArrayHasKey('data', $response->json());
    }

    /**
     * Test for checking POST /api/banners with correct input data
     *
     * @return void
     */
    public function test_create_banner_with_correct_input()
    {
        $requestData = Banner::factory()->make()->toArray();
        $response = $this->postJson('/api/banners', $requestData)->assertOk();
        $data = $response->json();
        $this->assertArrayHasKey('data', $data);
        foreach ($requestData as $field => $value) {
            $this->assertEquals($data['data'][$field], $value);
        }
    }

    /**
     * Test for checking POST /api/banners with incorrect input data
     *
     * @return void
     */
    public function test_create_banner_with_incorrect_input()
    {
        $invalidVields = [
            Banner::FIELD_NAME => null,
            Banner::FIELD_TEXT => null,
        ];
        $response = $this->postJson('/api/banners', $invalidVields);
        $response->assertStatus(422);
        $data = $response->json();
        $this->assertArrayHasKey('errors', $data);

        foreach ($invalidVields as $field => $value) {
            $this->assertArrayHasKey($field, $data['errors']);
        }
    }

    /**
     * Test for checking PUT /api/banners/{id} with correct input data
     *
     * @return void
     */
    public function test_update_banner_with_correct_input()
    {
        $id = Banner::factory()->create()->id;
        $this->getJson('/api/banners/' . $id)->assertOk();

        $requestData = Banner::factory()->make()->toArray();
        $response = $this->postJson('/api/banners', $requestData)->assertOk();
        $data = $response->json();
        $this->assertArrayHasKey('data', $data);
        foreach ($requestData as $field => $value) {
            $this->assertEquals($data['data'][$field], $value);
        }
    }

    /**
     * Test for checking PUT /api/banners/{id} with incorrect input data
     *
     * @return void
     */
    public function test_update_banner_with_incorrect_input()
    {
        $id = Banner::factory()->create()->id;
        $this->getJson('/api/banners/' . $id)->assertOk();

        $invalidVields = [
            Banner::FIELD_NAME => null,
            Banner::FIELD_TEXT => null,
        ];
        $response = $this->putJson('/api/banners/' . $id, $invalidVields);
        $response->assertStatus(422);
        $data = $response->json();
        $this->assertArrayHasKey('errors', $data);

        foreach ($invalidVields as $field => $value) {
            $this->assertArrayHasKey($field, $data['errors']);
        }
    }

    /**
     * Test for checking DELETE /api/banners/{id} and check not found GET /api/banners/{id}
     *
     * @return void
     */
    public function test_delete_banner_and_check_not_found()
    {
        $id = Banner::factory()->create()->id;
        $this->getJson('/api/banners/' . $id)->assertOk();

        $response = $this->delete('/api/banners/' . $id);
        $response->assertStatus(204);

        $this->getJson('/api/banners/' . $id)->assertNotFound();
    }
}
