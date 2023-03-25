<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'view-teams']);
        Permission::create(['name' => 'create-team']);
        Permission::create(['name' => 'show-team']);
        Permission::create(['name' => 'edit-team']);
        Permission::create(['name' => 'delete-team']);

        Permission::create(['name' => 'view-projects']);
        Permission::create(['name' => 'create-project']);
        Permission::create(['name' => 'show-project']);
        Permission::create(['name' => 'edit-project']);
        Permission::create(['name' => 'delete-project']);

        Permission::create(['name' => 'view-users']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'show-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);

        Role::create(['name' => 'Admin']);
        $manager = Role::create(['name' => 'Manager']);
        $teamLead = Role::create(['name' => 'TeamLead']);

        $manager->givePermissionTo([
            'view-teams', 'create-team', 'show-team', 'edit-team', 'delete-team',
            'view-users', 'create-user', 'show-user', 'edit-user', 'delete-user',
        ]);

        $teamLead->givePermissionTo([
            'view-users', 'show-user',
            'view-teams', 'create-team', 'show-team', 'edit-team', 'delete-team',
            'view-projects', 'create-project', 'show-project', 'edit-project', 'delete-project',
        ]);
    }
}
