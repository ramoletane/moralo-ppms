<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
Use App\Models\ProficiencyLevel;
use Database\Seeders\ProficiencyLevelSeeder;
use App\Providers\RouteServiceProvider;

class ProficiencyLevelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the list (index) operation.
     *
     * @return void
     */

    public function test_proficiency_levels_can_be_listed(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(ProficiencyLevelSeeder::class);
        $proficiencyLevel = ProficiencyLevel::first();
        //When a user visits the index page
        $response = $this->actingAs($user)
            ->get(route('proficiency_levels.index', [
                'proficiency_levels' => ProficiencyLevel::all(),
            ]));
        //The user sees a list of records from the database
        $response
            ->assertStatus(200)
            ->assertSeeText($proficiencyLevel->level_name)
            ->assertSeeText($proficiencyLevel->level_description);
    }
 
    /**
     * Test navigation to the record creation page.
     *
     * @return void
     */
 
    public function test_proficiency_level_creation_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user clicks on a button to create a record
        $response = $this
            ->actingAs($user)
            ->get('/proficiency_levels/create');
        //The user sees a page with a form to create a record
        $response
            ->assertStatus(200)
            ->assertSee('level_name')
            ->assertSee('level_description');
    }
 
    /**
     * Test the create (store) operation.
     *
     * @return void
     */
 
    public function test_proficiency_level_can_be_created(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user submits new data
        $response = $this
            ->actingAs($user)
            ->post(route('proficiency_levels.store', [
                'level_name' => 'Basic',
                'level_description' => 'Basic',
            ]));
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/proficiency_levels');
        //A matching record becomes available in the database
        $this->assertDatabaseHas('proficiency_levels', [
            'level_name' => 'Basic',
            'level_description' => 'Basic',
        ]);
    }
 
    /**
     * Test the read (show) operation.
     *
     * @return void
     */
 
    public function test_proficiency_level_can_be_read(): void
    {
        //Given a logged in user
        $user = User::factory()->create();    
        //Given a saved record
        $this->seed(ProficiencyLevelSeeder::class);
        $proficiencyLevel = ProficiencyLevel::first();
        //When the user clicks on a link to the record
        $response = $this
            ->actingAs($user)
            ->get(route('proficiency_levels.show', $proficiencyLevel));
        //The user sees the seleted record on the page displayed
        $response
            ->assertStatus(200)
            ->assertSeeText($proficiencyLevel->level_name)
            ->assertSeeText($proficiencyLevel->level_description);
    }
 
    /**
     * Test navigation to the edit page.
     *
     * @return void
     */
 
    public function test_proficiency_level_editing_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(ProficiencyLevelSeeder::class);
        $proficiencyLevel = ProficiencyLevel::first();
        //When the user selects a record for editing
        $response = $this
            ->actingAs($user)
            ->get(route('proficiency_levels.edit', $proficiencyLevel));
        //The user sees a page with a form to edit the record
        $response
            ->assertStatus(200)
            ->assertSee('level_name')
            ->assertSee('level_description');
    }
 
    /**
     * Test the update operation.
     *
     * @return void
     */
 
    public function test_proficiency_level_can_be_updated(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(ProficiencyLevelSeeder::class);
        $proficiencyLevel = ProficiencyLevel::first();
        //When the user submits edited data
        $response = $this
            ->actingAs($user)
            ->put(route('proficiency_levels.update', $proficiencyLevel), [
                'level_name' => 'Expert',
                'level_description' => 'Expert',
            ]);
        $response
            ->assertSessionHasNoErrors();
        //The database contains the updated record
        $this->assertDatabaseHas('proficiency_levels', [
            'level_name' => 'Expert',
            'level_description' => 'Expert',
        ]);
    }
 
    /**
     * Test the delete (destroy) operation.
     *
     * @return void
     */
 
    public function test_proficiency_level_can_be_deleted(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(ProficiencyLevelSeeder::class);
        $proficiencyLevel = ProficiencyLevel::first();
        //When the user chooses a record to delete  
        $response = $this
            ->actingAs($user)
            ->delete(route('proficiency_levels.destroy', $proficiencyLevel));
        //The database does not contain the deleted record
        $this->assertDatabaseMissing('proficiency_levels', [
            'level_name' => $proficiencyLevel->level_name,
        ]);
    }

}
