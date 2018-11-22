<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         // Reset cached roles and permissions
         app()['cache']->forget('spatie.permission.cache');

         // create permissions
         Permission::create(['name' => 'Search all students']);
         Permission::create(['name' => 'Export pdf']);
         Permission::create(['name' => 'Export excel']);
         Permission::create(['name' => 'Summary report']);
         Permission::create(['name' => 'Student single report']);
         Permission::create(['name' => 'View student profile']);
         Permission::create(['name' => 'Update student profile']);


         // create roles and assign created permissions

         $role = Role::create(['name' => 'officer']);
         $role->givePermissionTo(['Search all students','View student profile']);

         $role = Role::create(['name' => 'manager']);
         $role->givePermissionTo(Permission::all());

         // assign users to roles and permissions
         $user_manager = \App\User::find(1);
         $user_officer = \App\User::find(2);

         $user_manager->assignRole('manager');
         $user_officer->assignRole('officer');

         $user_manager->givePermissionTo(Permission::all());
         $user_officer->givePermissionTo(['Search all students','View student profile']);


     }
}
