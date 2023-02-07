<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Industry;
Use App\Models\Sector;
use Database\Seeders\IndustrySeeder;
use Database\Seeders\SectorSeeder;
use App\Providers\RouteServiceProvider;

class SectorTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the list (index) operation.
     *
     * @return void
     */
  
    public function test_sectors_can_be_listed()
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(IndustrySeeder::class);
        $this->seed(SectorSeeder::class);
        //When a user visits the index page
        $response = $this->actingAs($user)
            ->get(route('sectors.index', [
                'sectors' => Sector::all(),
            ]));
        //The user sees a list of records from the database
        $response
            ->assertStatus(200);
    }
 
    /**
     * Test navigation to the record creation page.
     *
     * @return void
     */

    public function test_sector_creation_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user clicks on a button to create a record
        $response = $this
            ->actingAs($user)
            ->get('/sectors/create');
        //The user sees a page with a form to create a record
        $response
            ->assertStatus(200)
            ->assertSee('sector_name');
    }

    /**
     * Test the create (store) operation.
     *
     * @return void
     */
 
    public function test_sector_can_be_created() : void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user submits new data
        $this->seed(IndustrySeeder::class);
        $sectorIDs = Industry::pluck('id');
        $response = $this
            ->actingAs($user)
            ->post(route('sectors.store', [
                'sector_name' => 'Software Engineering',
                'sector_id' => fake()->randomElement($sectorIDs),
            ]));
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/sectors');
        //A matching record becomes available in the database
        $this->assertDatabaseHas('sectors', [
            'sector_name' => 'Software Engineering',
        ]);
    }

    /**
     * Test the read (show) operation.
     *
     * @return void
     */

    public function test_sector_can_be_read() : void
    {
        //Given a logged in user
        $user = User::factory()->create();    
        //Given a saved record
        $this->seed(IndustrySeeder::class);
        $this->seed(SectorSeeder::class);
        //When the user clicks on a link to the record
        $sector = Sector::first();
        $response = $this
            ->actingAs($user)
            ->get(route('sectors.show', $sector));
        //The user sees the seleted record on the page displayed
        $response
            ->assertStatus(200)
            ->assertSeeText($sector->sector_name);
    }

    /**
     * Test navigation to the edit page.
     *
     * @return void
     */

    public function test_sector_editing_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(IndustrySeeder::class);
        $options = Industry::pluck('industry_name', 'id');
        $this->seed(SectorSeeder::class);
        $sector = Sector::first();
        //When the user selects a record for editing
        $response = $this
            ->actingAs($user)
            ->get(route('sectors.edit', $sector));
        //The user sees a page with a form to edit the record
        $response
            ->assertStatus(200)
            ->assertSee('sector_name')
            ->assertViewHas('sector', $sector);
    }

    public function test_sector_can_be_updated(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(IndustrySeeder::class);
        $sectorIDs = Industry::pluck('id');
        $this->seed(SectorSeeder::class);
        $sector = Sector::first();
        //When the user submits edited data
        $response = $this
            ->actingAs($user)
            ->put(route('sectors.update', $sector), [
                'sector_name' => 'Software Engineering',
                'sector_id' => fake()->randomElement($sectorIDs),
            ]);
        $response
            ->assertSessionHasNoErrors();
        //The database contains the updated record
        $this->assertDatabaseHas('sectors', [
            'sector_name' => 'Software Engineering',
        ]);
    }

    /**
     * Test the delete (destroy) operation.
     *
     * @return void
     */

    public function test_sector_can_be_deleted() : void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(SectorSeeder::class);
        $sector = Sector::first();
        //When the user chooses a record to delete  
        $response = $this
            ->actingAs($user)
            ->delete(route('sectors.destroy', $sector));
        //The database does not contain the deleted record
        $this->assertDatabaseMissing('sectors', [
            'sector_name' => $sector->sector_name,
        ]);
    }
 
}
