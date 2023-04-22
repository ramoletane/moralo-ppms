<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Impact;
use Database\Seeders\ImpactSeeder;
use App\Providers\RouteServiceProvider;

class ImpactTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the list (index) operation.
     *
     * @return void
     */
  
    public function test_impacts_can_be_listed(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(ImpactSeeder::class);
        $impact = Impact::first();
        //When a user visits the index page
        $response = $this->actingAs($user)
            ->get(route('impacts.index', [
                'impacts' => Impact::all(),
            ]));
        //The user sees a list of records from the database
        $response
            ->assertStatus(200)
            ->assertSeeText($impact->impact_name);
    }
 
    /**
     * Test navigation to the record creation page.
     *
     * @return void
     */

    public function test_impact_creation_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user clicks on a button to create a record
        $response = $this
            ->actingAs($user)
            ->get('/impacts/create');
        //The user sees a page with a form to create a record
        $response
            ->assertStatus(200)
            ->assertSee('impact_name');
    }

    /**
     * Test the create (store) operation.
     *
     * @return void
     */
 
    public function test_impact_can_be_created(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user submits new data
        $response = $this
            ->actingAs($user)
            ->post(route('impacts.store', [
                'impact_name' => 'Sustainable High Quality Employment',
            ]));
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/impacts');
        //A matching record becomes available in the database
        $this->assertDatabaseHas('impacts', [
            'impact_name' => 'Sustainable High Quality Employment',
        ]);
    }

    /**
     * Test the read (show) operation.
     *
     * @return void
     */

    public function test_impact_can_be_read(): void
    {
        //Given a logged in user
        $user = User::factory()->create();    
        //Given a saved record
        $this->seed(ImpactSeeder::class);
        $impact = Impact::first();
        //When the user clicks on a link to the record
        $response = $this
            ->actingAs($user)
            ->get(route('impacts.show', $impact));
        //The user sees the seleted record on the page displayed
        $response
            ->assertStatus(200)
            ->assertSeeText($impact->impact_name);
    }

    /**
     * Test navigation to the edit page.
     *
     * @return void
     */

    public function test_impact_editing_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(ImpactSeeder::class);
        $impact = Impact::first();
        //When the user selects a record for editing
        $response = $this
            ->actingAs($user)
            ->get(route('impacts.edit', $impact));
        //The user sees a page with a form to edit the record
        $response
            ->assertStatus(200)
            ->assertSee('impact_name')
            ->assertViewHas('impact', $impact);
    }

    /**
     * Test the update operation.
     *
     * @return void
     */

    public function test_impact_can_be_updated(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(ImpactSeeder::class);
        $impact = Impact::first();
        //When the user submits edited data
        $response = $this
            ->actingAs($user)
            ->put(route('impacts.update', $impact), [
                'impact_name' => 'High Quality Employment',
            ]);
        $response
            ->assertSessionHasNoErrors();
        //The database contains the updated record
        $this->assertDatabaseHas('impacts', [
            'impact_name' => 'High Quality Employment',
        ]);
    }

    /**
     * Test the delete (destroy) operation.
     *
     * @return void
     */

    public function test_impact_can_be_deleted(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(ImpactSeeder::class);
        $impact = Impact::first();
        //When the user chooses a record to delete  
        $response = $this
            ->actingAs($user)
            ->delete(route('impacts.destroy', $impact));
        //The database does not contain the deleted record
        $this->assertDatabaseMissing('impacts', [
            'impact_name' => $impact->impact_name,
        ]);
    }
    
}
