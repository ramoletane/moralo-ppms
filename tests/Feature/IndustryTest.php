<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
Use App\Models\Industry;
use Database\Seeders\IndustrySeeder;
use App\Providers\RouteServiceProvider;

class IndustryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test the list (index) operation.
     *
     * @return void
     */
  
     public function test_industries_can_be_listed()
     {
         //Given a logged in user
         $user = User::factory()->create();
         //Given a saved record
         $this->seed(IndustrySeeder::class);
         //When a user visits the index page
         $response = $this->actingAs($user)
             ->get(route('industries.index', [
                 'industries' => Industry::all(),
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

     public function test_industry_creation_page_can_be_rendered(): void
     {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user clicks on a button to create a record
        $response = $this
            ->actingAs($user)
            ->get('/industries/create');
        //The user sees a page with a form to create a record
        $response->assertStatus(200);
        $view = $this->blade(
            '<x-text-input id="industry-name" name="industry_name" type="text" />',
        );
        $view->assertSee('industry_name');
     }

    /**
     * Test the create (store) operation.
     *
     * @return void
     */
 
    public function test_industry_can_be_created() : void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user submits new data
        $response = $this
            ->actingAs($user)
            ->post(route('industries.store', [
                'industry_name' => 'Information and Communication Technologies',
            ]));
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/industries');
        //A matching record becomes available in the database
        $this->assertDatabaseHas('industries', [
            'industry_name' => 'Information and Communication Technologies',
        ]);
    }

    /**
     * Test the read (show) operation.
     *
     * @return void
     */

     public function test_industry_can_be_read() : void
     {
         //Given a logged in user
         $user = User::factory()->create();    
         //Given a saved record
         $this->seed(IndustrySeeder::class);
         //When the user clicks on a link to the record
         $industry = Industry::first();
         $response = $this
             ->actingAs($user)
             ->get(route('industries.show', $industry));
         //The user sees the seleted record on the page displayed
         $response
             ->assertStatus(200)
             ->assertSeeText($industry->industry_name);
     }

    /**
     * Test navigation to the edit page.
     *
     * @return void
     */

    public function test_industry_editing_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(IndustrySeeder::class);
        $industry = Industry::first();
        //When the user selects a record for editing
        $response = $this
            ->actingAs($user)
            ->get(route('industries.edit', $industry));
        //The user sees a page with a form to edit the record
        $response
            ->assertStatus(200);
        $view = $this->blade(
            '<x-text-input id="industry-name" name="industry_name" type="text" />',
        );
        $view->assertSee('industry_name');
    }

    /**
     * Test the update operation.
     *
     * @return void
     */

    public function test_industry_can_be_updated(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(IndustrySeeder::class);
        $industry = Industry::first();
        //When the user submits edited data
        $response = $this
            ->actingAs($user)
            ->put(route('industries.update', $industry), [
                'industry_name' => 'Information Technology',
            ]);
        $response
            ->assertSessionHasNoErrors();
        //The database contains the updated record
        $this->assertDatabaseHas('industries', [
            'industry_name' => 'Information Technology',
        ]);
    }

    /**
     * Test the delete (destroy) operation.
     *
     * @return void
     */

    public function test_industry_can_be_deleted() : void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(IndustrySeeder::class);
        $industry = Industry::first();
        //When the user chooses a record to delete  
        $response = $this
            ->actingAs($user)
            ->delete(route('industries.destroy', $industry));
        //The database does not contain the deleted record
        $this->assertDatabaseMissing('industries', [
            'industry_name' => $industry->industry_name,
        ]);
    }
 
}
