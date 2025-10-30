<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();
        Permission::truncate();

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        foreach (config('nxxt.permissions') as $group) {
            foreach ($group['set'] as $p) {
                $permission = sprintf('%s:%s', $p, $group['key']);
                Permission::create(['name' => $permission]);
            }
        }

        foreach(config('nxxt.default_roles') as $default_role) {
            $role = Role::create(['name' => $default_role['name']]);
            foreach($default_role['permissions'] as $permission) {
                if(str($permission)->endsWith(':*'))
                {
                    $perm_set = collect(config('nxxt.permissions'))->where('key', str($permission)->before(':'))->first();
                    foreach($perm_set['set'] as $set_p)
                    {
                        $set_perm = sprintf('%s:%s', $set_p, $perm_set['key']);
                        $role->givePermissionTo($set_perm);
                    }
                }else{
                    $role->givePermissionTo($permission);
                }
            }
        }

        // update cache to know about the newly created permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
