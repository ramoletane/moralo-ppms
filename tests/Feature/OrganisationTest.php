<?php

namespace Tests\Feature;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Organisation;
use Database\Seeders\OrganisationSeeder;

class OrganisationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test navigation to the record creation page.
     *
     * @return void
     */

     public function test_organisation_creation_page_can_be_rendered(): void
     {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user clicks on a button to create a record
        $response = $this
            ->actingAs($user)
            ->get('/organisations/create');
        //The user sees a page with a form to create a record
        $response
            ->assertStatus(200)
            ->assertSee('company_name')
            ->assertSee('email_address')
            ->assertSee('phone_number');
        }

    /**
     * Test the create (store) operation.
     *
     * @return void
     */
 
    public function test_organisation_can_be_created() : void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //When the user submits new data
        $response = $this
            ->actingAs($user)
            ->post(route('organisations.store', [
                'company_name' => 'Moralo Technologies',
                'acronym' => Null,
                'email_address' => 'info@moralo.tech',
                'phone_number' => '+26622312345',
            ]));
        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/organisations');
        //A matching record becomes available in the database
        $this->assertDatabaseHas('organisations', [
            'company_name' => 'Moralo Technologies',
        ]);
    }

    /**
     * Test the read (show) operation.
     *
     * @return void
     */

    public function test_organisation_can_be_read() : void
    {
        //Given a logged in user
        $user = User::factory()->create();    
        //Given a saved record
        $this->seed(OrganisationSeeder::class);
        //When the user clicks on a link to the record
        $organisation = Organisation::first();
        $response = $this
            ->actingAs($user)
            ->get(route('organisations.show', $organisation));
        //The user sees the seleted record on the page displayed
        $response
            ->assertStatus(200)
            ->assertSeeText($organisation->company_name);
    }

    /**
     * Test navigation to the edit page.
     *
     * @return void
     */

    public function test_organisation_editing_page_can_be_rendered(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(OrganisationSeeder::class);
        $organisation = Organisation::first();
        //When the user selects a record for editing
        $response = $this
            ->actingAs($user)
            ->get(route('organisations.edit', $organisation));
        //The user sees a page with a form to edit the record
        $response
            ->assertStatus(200)
            ->assertSee('company_name')
            ->assertSee('email_address')
            ->assertSee('phone_number')
            ->assertViewHas('organisation', $organisation);
    }

    /**
     * Test the update operation.
     *
     * @return void
     */

    public function test_organisation_can_be_updated(): void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(OrganisationSeeder::class);
        $organisation = Organisation::first();
        //When the user submits edited data
        $response = $this
            ->actingAs($user)
            ->put(route('organisations.update', $organisation), [
                'company_name' => $organisation->company_name,
                'acronym' => 'MT',
                'email_address' => $organisation->email_address,
                'phone_number' => $organisation->phone_number,
            ]);
        $response
            ->assertSessionHasNoErrors();
        //The database contains the updated record
        $this->assertDatabaseHas('organisations', [
            'acronym' => 'MT',
        ]);
    }

    /**
     * Test the delete (destroy) operation.
     *
     * @return void
     */

    public function test_organisation_can_be_deleted() : void
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(OrganisationSeeder::class);
        $organisation = Organisation::first();
        //When the user chooses a record to delete  
        $response = $this
            ->actingAs($user)
            ->delete(route('organisations.destroy', $organisation));
        //The database does not contain the deleted record
        $this->assertDatabaseMissing('organisations', [
            'company_name' => $organisation->company_name,
        ]);
    }

    /**
     * Test the list (index) operation.
     *
     * @return void
     */
  
    public function test_organisations_can_be_listed()
    {
        //Given a logged in user
        $user = User::factory()->create();
        //Given a saved record
        $this->seed(OrganisationSeeder::class);
        //When a user visits the index page
        $response = $this->actingAs($user)
            ->get(route('organisations.index', [
                'organisations' => Organisation::all(),
            ]));
        //The user sees a list of records from the database
        $response
            ->assertStatus(200);
    }
}
