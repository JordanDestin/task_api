<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name_role' => 'Administrator']);
        $admin->permissions()->attach(Permission::pluck('id'));

        $editor = Role::create(['name_role' => 'Editor']);
        $editor->permissions()->attach(
            Permission::where('name', '!=', 'delete')->pluck('id')
        );
    }
}
