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

        Permission::create(['name' => 'create-team']);
        Permission::create(['name' => 'view-team']);
        Permission::create(['name' => 'edit-team']);
        Permission::create(['name' => 'delete-team']);

        Permission::create(['name' => 'create-project']);
        Permission::create(['name' => 'view-project']);
        Permission::create(['name' => 'edit-project']);
        Permission::create(['name' => 'delete-project']);

        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);

        Role::create(['name' => 'Admin']);
        $manager = Role::create(['name' => 'Manager']);
        $teamLead = Role::create(['name' => 'TeamLead']);

        $manager->givePermissionTo([
            'create-team', 'view-team', 'edit-team', 'delete-team',
            'create-user', 'view-user', 'edit-user', 'delete-user',
        ]);

        $teamLead->givePermissionTo([
            'create-team', 'view-team', 'edit-team', 'delete-team',
            'create-project', 'view-project', 'edit-project', 'delete-project',
        ]);
    }
}
