<?php

namespace Tests\Unit;

use App\Models\Campaign;
use Tests\TestCase;

class CampaignTest extends TestCase
{
    /**
     * Test for checking GET /api/campaigns
     *
     * @return void
     */
    public function test_campaigns_get_list()
    {
        $response = $this->getJson('/api/campaigns')->assertOk();
        $this->assertArrayHasKey('data', $response->json());
    }

    /**
     * Test for checking POST /api/campaigns with correct input data
     *
     * @return void
     */
    public function test_create_campaign_with_correct_input()
    {
        $requestData = Campaign::factory()->make()->toArray();
        $response = $this->postJson('/api/campaigns', $requestData)->assertOk();
        $data = $response->json();
        $this->assertArrayHasKey('data', $data);
        foreach ($requestData as $field => $value) {
            $this->assertEquals($data['data'][$field], $value);
        }
    }

    /**
     * Test for checking POST /api/campaigns with incorrect input data
     *
     * @return void
     */
    public function test_create_campaign_with_incorrect_input()
    {
        $invalidVields = [
            Campaign::FIELD_NAME => null,
        ];
        $response = $this->postJson('/api/campaigns', $invalidVields);
        $response->assertStatus(422);
        $data = $response->json();
        $this->assertArrayHasKey('errors', $data);

        foreach ($invalidVields as $field => $value) {
            $this->assertArrayHasKey($field, $data['errors']);
        }
    }

    /**
     * Test for checking PUT /api/campaigns/{id} with correct input data
     *
     * @return void
     */
    public function test_update_campaign_with_correct_input()
    {
        $id = Campaign::factory()->create()->id;
        $this->getJson('/api/campaigns/' . $id)->assertOk();

        $requestData = Campaign::factory()->make()->toArray();
        $response = $this->postJson('/api/campaigns', $requestData)->assertOk();
        $data = $response->json();
        $this->assertArrayHasKey('data', $data);
        foreach ($requestData as $field => $value) {
            $this->assertEquals($data['data'][$field], $value);
        }
    }

    /**
     * Test for checking PUT /api/campaigns/{id} with incorrect input data
     *
     * @return void
     */
    public function test_update_campaign_with_incorrect_input()
    {
        $id = Campaign::factory()->create()->id;
        $this->getJson('/api/campaigns/' . $id)->assertOk();

        $invalidVields = [
            Campaign::FIELD_NAME => null,
        ];
        $response = $this->putJson('/api/campaigns/' . $id, $invalidVields);
        $response->assertStatus(422);
        $data = $response->json();
        $this->assertArrayHasKey('errors', $data);

        foreach ($invalidVields as $field => $value) {
            $this->assertArrayHasKey($field, $data['errors']);
        }
    }

    /**
     * Test for checking DELETE /api/campaigns/{id} and check not found GET /api/campaigns/{id}
     *
     * @return void
     */
    public function test_delete_campaign_and_check_not_found()
    {
        $id = Campaign::factory()->create()->id;
        $this->getJson('/api/campaigns/' . $id)->assertOk();

        $response = $this->delete('/api/campaigns/' . $id);
        $response->assertStatus(204);

        $this->getJson('/api/campaigns/' . $id)->assertNotFound();
    }
}
