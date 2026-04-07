<?php

namespace Tests\Feature;

use App\Models\Muallaf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MuallafApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test GET /api/muallafs returns correct JSON structure
     */
    public function test_list_muallafs_api_returns_correct_structure()
    {
        // Create test data
        Muallaf::factory()->count(3)->create();

        $response = $this->getJson('/api/muallafs');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'message',
                'data' => [
                    '*' => ['Id', 'NamaIslam']
                ],
                'count'
            ])
            ->assertJsonPath('success', true)
            ->assertJsonPath('count', 3);
    }

    /**
     * Test POST /api/muallafs creates record and returns 201
     */
    public function test_create_muallaf_via_api()
    {
        $data = [
            'NamaIslam' => 'Ahmad Bin Muallaf',
            'NamaAsal' => 'Ahmad Original',
            'NoKP' => '123456-12-1234',
            'Jantina' => 'L',
            'Status' => 'A',
        ];

        $response = $this->postJson('/api/muallafs', $data);

        $response->assertStatus(201)
            ->assertJsonPath('success', true)
            ->assertJsonPath('message', 'Muallaf berjaya ditambah.')
            ->assertJsonStructure([
                'success',
                'message',
                'data' => ['Id', 'NamaIslam']
            ]);

        $this->assertDatabaseHas('maklumat_muallafs', [
            'NamaIslam' => 'Ahmad Bin Muallaf'
        ]);
    }

    /**
     * Test POST /api/muallafs with validation error returns 422
     */
    public function test_create_muallaf_validation_error()
    {
        $data = [
            'NamaAsal' => 'No Islamic Name',
            // Missing required: NamaIslam
        ];

        $response = $this->postJson('/api/muallafs', $data);

        $response->assertStatus(422)
            ->assertJsonPath('success', false)
            ->assertJsonPath('message', 'Ralat validasi.')
            ->assertJsonStructure([
                'success',
                'message',
                'errors'
            ]);
    }

    /**
     * Test GET /api/muallafs/{id} returns specific record
     */
    public function test_show_muallaf_api()
    {
        $muallaf = Muallaf::factory()->create([
            'NamaIslam' => 'Fatimah Muallaf'
        ]);

        $response = $this->getJson("/api/muallafs/{$muallaf->Id}");

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('data.NamaIslam', 'Fatimah Muallaf');
    }

    /**
     * Test GET /api/muallafs/{id} with invalid ID returns 404
     */
    public function test_show_muallaf_not_found()
    {
        $response = $this->getJson('/api/muallafs/99999');

        $response->assertStatus(404)
            ->assertJsonPath('success', false)
            ->assertJsonPath('message', 'Muallaf tidak dijumpai.');
    }

    /**
     * Test PUT /api/muallafs/{id} updates record
     */
    public function test_update_muallaf_api()
    {
        $muallaf = Muallaf::factory()->create([
            'NamaIslam' => 'Old Name'
        ]);

        $updateData = [
            'NamaIslam' => 'Updated Name',
            'Status' => 'I'
        ];

        $response = $this->putJson("/api/muallafs/{$muallaf->Id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('message', 'Muallaf berjaya dikemas kini.')
            ->assertJsonPath('data.NamaIslam', 'Updated Name');

        $this->assertDatabaseHas('maklumat_muallafs', [
            'Id' => $muallaf->Id,
            'NamaIslam' => 'Updated Name'
        ]);
    }

    /**
     * Test DELETE /api/muallafs/{id} removes record
     */
    public function test_delete_muallaf_api()
    {
        $muallaf = Muallaf::factory()->create();
        $muallafId = $muallaf->Id;

        $response = $this->deleteJson("/api/muallafs/{$muallafId}");

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('message', 'Muallaf berjaya dipadam.');

        $this->assertDatabaseMissing('maklumat_muallafs', [
            'Id' => $muallafId
        ]);
    }

    /**
     * Test web controller store endpoint is blocked (405)
     */
    public function test_web_store_endpoint_blocked()
    {
        $data = [
            'NamaIslam' => 'Test',
            'Status' => 'A'
        ];

        // POST /muallafs (web) should return 405
        $response = $this->post('/muallafs', $data);

        $response->assertStatus(405);
    }

    /**
     * Test web controller update endpoint is blocked (405)
     */
    public function test_web_update_endpoint_blocked()
    {
        $muallaf = Muallaf::factory()->create();

        $data = [
            'NamaIslam' => 'Updated',
            '_method' => 'PUT'
        ];

        // PUT /muallafs/{id} (web) should return 405
        $response = $this->put("/muallafs/{$muallaf->Id}", $data);

        $response->assertStatus(405);
    }

    /**
     * Test web controller destroy endpoint is blocked (405)
     */
    public function test_web_destroy_endpoint_blocked()
    {
        $muallaf = Muallaf::factory()->create();

        $data = ['_method' => 'DELETE'];

        // DELETE /muallafs/{id} (web) should return 405
        $response = $this->delete("/muallafs/{$muallaf->Id}", $data);

        $response->assertStatus(405);
    }
}
