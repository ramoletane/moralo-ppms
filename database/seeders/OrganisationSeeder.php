<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Organisation::factory()->create([
            'company_name' => 'Moralo Technologies',
            'email_address' => 'test@example.com',
            'phone_number' => '+26622312345',
        ]);
    }
}
