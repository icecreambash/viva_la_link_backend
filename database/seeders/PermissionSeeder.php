<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $collectionsRoles = [
            'user',
            'admin'
        ];

        foreach($collectionsRoles as $role) {
            if(!Role::where('name',$role)->exists())
            {
                Role::create(
                    [
                        'name' => $role
                    ]
                );
            }
        }
    }
}
