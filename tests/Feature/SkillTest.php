<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Skill;
use Database\Seeders\SkillSeeder;
use App\Providers\RouteServiceProvider;

class SkillTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_skills_can_be_listed()
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(SkillSeeder::class);
        //When a user visits the index page
        $response = $this->actingAs($user)
            ->get(route('skills.index', [
                'skills' => Skill::all(),
            ]));
        //The user sees a list of records from the database
        $response
            ->assertStatus(200)
            ->assertSee('Leadership');
    }
 
    /**
     * Test navigation to the record creation page.
     *
     * @return void
     */
 
     public function test_skill_creation_page_can_be_rendered(): void
     {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user clicks on a button to create a record
        $response = $this
            ->actingAs($user)
            ->get('/skills/create');
        //The user sees a page with a form to create a record
        $response
            ->assertStatus(200)
            ->assertSee('skill_name');
     }
 
    /**
     * Test the create (store) operation.
     *
     * @return void
     */
 
    public function test_skill_can_be_created() : void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user submits new data
        $response = $this
            ->actingAs($user)
            ->post(route('skills.store', [
                'skill_name' => 'Leadership',
            ]));
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/skills');
        //A matching record becomes available in the database
        $this->assertDatabaseHas('skills', [
            'skill_name' => 'Leadership',
        ]);
    }
 
    /**
     * Test the read (show) operation.
     *
     * @return void
     */
 
     public function test_skill_can_be_read() : void
     {
         //Given a logged in user
         $user = User::factory()->create();    
         //Given a saved record
         $this->seed(SkillSeeder::class);
         //When the user clicks on a link to the record
         $skill = Skill::first();
         $response = $this
             ->actingAs($user)
             ->get(route('skills.show', $skill));
         //The user sees the seleted record on the page displayed
         $response
             ->assertStatus(200)
             ->assertSeeText($skill->skill_name);
     }
 
    /**
     * Test navigation to the edit page.
     *
     * @return void
     */
 
    public function test_skill_editing_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(SkillSeeder::class);
        $skill = Skill::first();
        //When the user selects a record for editing
        $response = $this
            ->actingAs($user)
            ->get(route('skills.edit', $skill));
        //The user sees a page with a form to edit the record
        $response
            ->assertStatus(200)
            ->assertSee('skill_name')
            ->assertViewHas('skill', $skill);
    }
 
    /**
     * Test the update operation.
     *
     * @return void
     */
 
    public function test_skill_can_be_updated(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(SkillSeeder::class);
        $skill = Skill::first();
        //When the user submits edited data
        $response = $this
            ->actingAs($user)
            ->put(route('skills.update', $skill), [
                'skill_name' => 'Training',
            ]);
        $response
            ->assertSessionHasNoErrors();
        //The database contains the updated record
        $this->assertDatabaseHas('skills', [
            'skill_name' => 'Training',
        ]);
    }
 
    /**
     * Test the delete (destroy) operation.
     *
     * @return void
     */
 
    public function test_skill_can_be_deleted() : void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(SkillSeeder::class);
        $skill = Skill::first();
        //When the user chooses a record to delete  
        $response = $this
            ->actingAs($user)
            ->delete(route('skills.destroy', $skill));
        //The database does not contain the deleted record
        $this->assertDatabaseMissing('skills', [
            'skill_name' => $skill->skill_name,
        ]);
    }
     
}
