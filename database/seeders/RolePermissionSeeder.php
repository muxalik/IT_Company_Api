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

        Permission::create(['name' => 'view-employees']);
        Permission::create(['name' => 'create-employee']);
        Permission::create(['name' => 'show-employee']);
        Permission::create(['name' => 'edit-employee']);
        Permission::create(['name' => 'delete-employee']);

        Permission::create(['name' => 'view-skills']);
        Permission::create(['name' => 'create-skill']);
        Permission::create(['name' => 'show-skill']);
        Permission::create(['name' => 'edit-skill']);
        Permission::create(['name' => 'delete-skill']);

        Role::create(['name' => 'Admin']);
        $manager = Role::create(['name' => 'Manager']);
        $teamLead = Role::create(['name' => 'TeamLead']);
        $default = Role::create(['name' => 'Default']);

        $manager->givePermissionTo([
            'view-teams', 'create-team', 'show-team', 'edit-team', 'delete-team',
            'view-employees', 'create-employee', 'show-employee', 'edit-employee', 'delete-employee',
            'view-skills', 'create-skill', 'show-skill', 'edit-skill', 'delete-skill',
        ]);

        $teamLead->givePermissionTo([
            'view-employees', 'show-employee',
            'view-teams', 'create-team', 'show-team', 'edit-team', 'delete-team',
            'view-projects', 'create-project', 'show-project', 'edit-project', 'delete-project',
            'view-skills', 'create-skill', 'show-skill', 'edit-skill', 'delete-skill',
        ]);

        $default->givePermissionTo([
            'view-teams', 'show-team', 
            'view-skills', 'show-skill', 
            'view-projects', 'show-project',
        ]);
    }
}
