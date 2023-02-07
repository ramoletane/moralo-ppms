<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
Use App\Models\CompetencyGroup;
use Database\Seeders\CompetencyGroupSeeder;
use App\Providers\RouteServiceProvider;

class CompetencyGroupTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_competency_groups_can_be_listed()
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(CompetencyGroupSeeder::class);
        //When a user visits the index page
        $response = $this->actingAs($user)
            ->get(route('competency_groups.index', [
                'competency_groups' => CompetencyGroup::all(),
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

    public function test_competency_group_creation_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user clicks on a button to create a record
        $response = $this
            ->actingAs($user)
            ->get('/competency_groups/create');
        //The user sees a page with a form to create a record
        $response
            ->assertStatus(200)
            ->assertSee('group_name');
    }

   /**
    * Test the create (store) operation.
    *
    * @return void
    */

   public function test_competency_group_can_be_created() : void
   {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user submits new data
        $response = $this
            ->actingAs($user)
            ->post(route('competency_groups.store', [
                'group_name' => 'Information and Communication Technologies',
            ]));
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/competency_groups');
        //A matching record becomes available in the database
        $this->assertDatabaseHas('competency_groups', [
            'group_name' => 'Information and Communication Technologies',
        ]);
   }

   /**
    * Test the read (show) operation.
    *
    * @return void
    */

    public function test_competency_group_can_be_read() : void
    {
        //Given a logged in user
        $user = User::factory()->create();    
        //Given a saved record
        $this->seed(CompetencyGroupSeeder::class);
        //When the user clicks on a link to the record
        $competencyGroup = CompetencyGroup::first();
        $response = $this
            ->actingAs($user)
            ->get(route('competency_groups.show', $competencyGroup));
        //The user sees the seleted record on the page displayed
        $response
            ->assertStatus(200)
            ->assertSeeText($competencyGroup->group_name);
    }

   /**
    * Test navigation to the edit page.
    *
    * @return void
    */

   public function test_competency_group_editing_page_can_be_rendered(): void
   {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(CompetencyGroupSeeder::class);
        $competencyGroup = CompetencyGroup::first();
        //When the user selects a record for editing
        $response = $this
            ->actingAs($user)
            ->get(route('competency_groups.edit', $competencyGroup));
        //The user sees a page with a form to edit the record
        $response
            ->assertStatus(200)
            ->assertSee('group_name');
   }

   /**
    * Test the update operation.
    *
    * @return void
    */

   public function test_competency_group_can_be_updated(): void
   {
       //Given a logged in user
       $user = User::factory()->create();
       //Given a saved record
       $this->seed(CompetencyGroupSeeder::class);
       $competencyGroup = CompetencyGroup::first();
       //When the user submits edited data
       $response = $this
           ->actingAs($user)
           ->put(route('competency_groups.update', $competencyGroup), [
               'group_name' => 'Information Technology',
           ]);
       $response
           ->assertSessionHasNoErrors();
       //The database contains the updated record
       $this->assertDatabaseHas('competency_groups', [
           'group_name' => 'Information Technology',
       ]);
   }

   /**
    * Test the delete (destroy) operation.
    *
    * @return void
    */

   public function test_competency_group_can_be_deleted() : void
   {
       //Given a logged in user
       $user = User::factory()->create();
       //Given a saved record
       $this->seed(CompetencyGroupSeeder::class);
       $competencyGroup = CompetencyGroup::first();
       //When the user chooses a record to delete  
       $response = $this
           ->actingAs($user)
           ->delete(route('competency_groups.destroy', $competencyGroup));
       //The database does not contain the deleted record
       $this->assertDatabaseMissing('competency_groups', [
           'group_name' => $competencyGroup->group_name,
       ]);
   }

}
