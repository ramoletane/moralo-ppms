<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Skill;
Use App\Models\DevelopmentMethod;
Use App\Models\SkillDevelopmentMethod;
use Database\Seeders\SkillSeeder;
use Database\Seeders\DevelopmentMethodSeeder;
use Database\Seeders\SkillDevelopmentMethodSeeder;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\DB;

class SkillDevelopmentMethodTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_skill_development_methods_can_be_listed()
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(SkillSeeder::class);
        $this->seed(DevelopmentMethodSeeder::class);
        $this->seed(SkillDevelopmentMethodSeeder::class);
        $skillDevelopmentMethods = DB::table('skill_development_methods')
            ->join('skills', 'skill_development_methods.skill_id', '=', 'skills.id')
            ->join('development_methods', 'skill_development_methods.development_method_id', '=', 'development_methods.id')
            ->get();
        //When a user visits the index page
        $response = $this->actingAs($user)
            ->get(route('skill_development_methods.index', [
                'skill_development_methods' => SkillDevelopmentMethod::all(),
            ]));
        //The user sees a list of records from the database
        $response
            ->assertStatus(200)
            ->assertSee($skillDevelopmentMethods[0]->skill_name)
            ->assertSee($skillDevelopmentMethods[0]->method_name);
    }
 
    /**
     * Test navigation to the record creation page.
     *
     * @return void
     */
 
    public function test_skill_development_method_creation_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user clicks on a button to create a record
        $response = $this
            ->actingAs($user)
            ->get('/skill_development_methods/create');
        //The user sees a page with a form to create a record
        $response
            ->assertStatus(200)
            ->assertSee('method_name');
    }
 
    /**
     * Test the create (store) operation.
     *
     * @return void
     */
 
    public function test_skill_development_method_can_be_created() : void
    {
        //Given a logged in user
        $user = User::factory()->create();
        $this->seed(SkillSeeder::class);
        $this->seed(DevelopmentMethodSeeder::class);
        $skillIDs = Skill::pluck('id');
        $developmentMethodIDs = DevelopmentMethod::pluck('id');
        //When the user submits new data
        $response = $this
            ->actingAs($user)
            ->post(route('skill_development_methods.store', [
                'skill_id' => fake()->randomElement($skillIDs),
                'development_method_id' => fake()->randomElement($developmentMethodIDs),
            ]));
        $skillDevelopmentMethods = DB::table('skill_development_methods')
            ->join('skills', 'skill_development_methods.skill_id', '=', 'skills.id')
            ->join('development_methods', 'skill_development_methods.development_method_id', '=', 'development_methods.id')
            ->get();
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/skill_development_methods');
        //A matching record becomes available in the database
        $this->assertDatabaseHas('skill_development_methods', [
            'skill_id' => $skillDevelopmentMethods[0]->skill_id,
            'development_method_id' => $skillDevelopmentMethods[0]->development_method_id,
        ]);
    }
 
    /**
     * Test the read (show) operation.
     *
     * @return void
     */
 
    public function test_skill_development_method_can_be_read() : void
    {
        //Given a logged in user
        $user = User::factory()->create();    
        //Given a saved record
        $this->seed(SkillSeeder::class);
        $this->seed(DevelopmentMethodSeeder::class);
        $this->seed(SkillDevelopmentMethodSeeder::class);
        //When the user clicks on a link to the record
        $skillDevelopmentMethod = SkillDevelopmentMethod::first();
        $response = $this
            ->actingAs($user)
            ->get(route('skill_development_methods.show', $skillDevelopmentMethod));
        //The user sees the seleted record on the page displayed
        $response
            ->assertStatus(200)
            ->assertSeeText($skillDevelopmentMethod->method_name);
    }
 
    /**
     * Test navigation to the edit page.
     *
     * @return void
     */
 
    public function test_skill_development_method_editing_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(SkillSeeder::class);
        $this->seed(DevelopmentMethodSeeder::class);
        $this->seed(SkillDevelopmentMethodSeeder::class);
        $skillDevelopmentMethod = SkillDevelopmentMethod::first();
        //When the user selects a record for editing
        $response = $this
            ->actingAs($user)
            ->get(route('skill_development_methods.edit', $skillDevelopmentMethod));
        //The user sees a page with a form to edit the record
        $response
            ->assertStatus(200)
            ->assertSee('method_id')
            ->assertSeeText($skillDevelopmentMethod->method_name)
            ->assertSee('skill_name')
            ->assertSeeText($skillDevelopmentMethod->skill_name);
    }
 
    /**
     * Test the update operation.
     *
     * @return void
     */
 
    public function test_skill_development_method_can_be_updated(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(SkillSeeder::class);
        $this->seed(DevelopmentMethodSeeder::class);
        $this->seed(SkillDevelopmentMethodSeeder::class);
        $skillDevelopmentMethod = SkillDevelopmentMethod::first();
        $developmentMethod = DevelopmentMethod::latest()->first();
        //When the user submits edited data
        $response = $this
            ->actingAs($user)
            ->put(route('skill_development_methods.update', $skillDevelopmentMethod), [
                'development_method_id' => $developmentMethod->id,
            ]);
        $response
            ->assertSessionHasNoErrors();
        //The database contains the updated record
        $this->assertDatabaseHas('skill_development_methods', [
            'development_method_id' => $developmentMethod->id,
        ]);
    }
 
    /**
     * Test the delete (destroy) operation.
     *
     * @return void
     */
 
    public function test_skill_development_method_can_be_deleted() : void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(SkillSeeder::class);
        $this->seed(DevelopmentMethodSeeder::class);
        $this->seed(SkillDevelopmentMethodSeeder::class);
        $skillDevelopmentMethod = SkillDevelopmentMethod::first();
        //When the user chooses a record to delete  
        $response = $this
            ->actingAs($user)
            ->delete(route('skill_development_methods.destroy', $skillDevelopmentMethod));
        //The database does not contain the deleted record
        $this->assertDatabaseMissing('skill_development_methods', [
            'development_method_id' => $skillDevelopmentMethod->id,
        ]);
    }

}
