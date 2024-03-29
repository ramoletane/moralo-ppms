<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
Use App\Models\DevelopmentMethod;
use Database\Seeders\DevelopmentMethodSeeder;
use App\Providers\RouteServiceProvider;

class DevelopmentMethodTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_development_methods_can_be_listed(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(DevelopmentMethodSeeder::class);
        $developmentMethod = DevelopmentMethod::first();
        //When a user visits the index page
        $response = $this->actingAs($user)
            ->get(route('development_methods.index', [
                'development_methods' => DevelopmentMethod::all(),
            ]));
        //The user sees a list of records from the database
        $response
            ->assertStatus(200)
            ->assertSee($developmentMethod->method_name);
    }
 
    /**
     * Test navigation to the record creation page.
     *
     * @return void
     */
 
    public function test_development_method_creation_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user clicks on a button to create a record
        $response = $this
            ->actingAs($user)
            ->get('/development_methods/create');
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
 
    public function test_development_method_can_be_created(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user submits new data
        $response = $this
            ->actingAs($user)
            ->post(route('development_methods.store', [
                'method_name' => 'Training',
            ]));
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/development_methods');
        //A matching record becomes available in the database
        $this->assertDatabaseHas('development_methods', [
            'method_name' => 'Training',
        ]);
    }
 
    /**
     * Test the read (show) operation.
     *
     * @return void
     */
 
    public function test_development_method_can_be_read(): void
    {
        //Given a logged in user
        $user = User::factory()->create();    
        //Given a saved record
        $this->seed(DevelopmentMethodSeeder::class);
        $developmentMethod = DevelopmentMethod::first();
        //When the user clicks on a link to the record
        $response = $this
            ->actingAs($user)
            ->get(route('development_methods.show', $developmentMethod));
        //The user sees the seleted record on the page displayed
        $response
            ->assertStatus(200)
            ->assertSeeText($developmentMethod->method_name);
    }
 
    /**
     * Test navigation to the edit page.
     *
     * @return void
     */
 
    public function test_development_method_editing_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(DevelopmentMethodSeeder::class);
        $developmentMethod = DevelopmentMethod::first();
        //When the user selects a record for editing
        $response = $this
            ->actingAs($user)
            ->get(route('development_methods.edit', $developmentMethod));
        //The user sees a page with a form to edit the record
        $response
            ->assertStatus(200)
            ->assertSee('method_name');
    }
 
    /**
     * Test the update operation.
     *
     * @return void
     */
 
    public function test_development_method_can_be_updated(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(DevelopmentMethodSeeder::class);
        $developmentMethod = DevelopmentMethod::first();
        //When the user submits edited data
        $response = $this
            ->actingAs($user)
            ->put(route('development_methods.update', $developmentMethod), [
                'method_name' => 'Training',
            ]);
        $response
            ->assertSessionHasNoErrors();
        //The database contains the updated record
        $this->assertDatabaseHas('development_methods', [
            'method_name' => 'Training',
        ]);
    }
 
    /**
     * Test the delete (destroy) operation.
     *
     * @return void
     */
 
    public function test_development_method_can_be_deleted(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(DevelopmentMethodSeeder::class);
        $developmentMethod = DevelopmentMethod::first();
        //When the user chooses a record to delete  
        $response = $this
            ->actingAs($user)
            ->delete(route('development_methods.destroy', $developmentMethod));
        //The database does not contain the deleted record
        $this->assertDatabaseMissing('development_methods', [
            'method_name' => $developmentMethod->method_name,
        ]);
    }
     
}
