<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Workspace;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $workspace = Workspace::factory()->create(
            [
                'name' => 'JnkConsult',
                'description' => 'This is the default workspace',
                'identifier' => 'jnkconsult'
            ]
        );
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Jean-Marc Strauven',
            'email' => 'jms@grazulex.be',
            'workspace_id' => $workspace->id,
        ]);

        Workspace::factory()->create();
    }
}
