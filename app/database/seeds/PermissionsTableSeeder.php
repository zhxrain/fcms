<?php

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('permissions')->delete();


        $permissions = array(
            array(
                'name'      => 'show_users',
                'display_name'      => 'show users',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'edit_users',
                'display_name'      => 'edit posts',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'delete_users',
                'display_name'      => 'delete users',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'show_roles',
                'display_name'      => 'show roles',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'edit_roles',
                'display_name'      => 'manage users',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
            array(
                'name'      => 'delete_roles',
                'display_name'      => 'delete roles',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ),
        );

        DB::table('permissions')->insert( $permissions );

        DB::table('permission_role')->delete();

        $permissions = array(
            array(
                'role_id'      => 1,
                'permission_id' => 1
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 2
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 3
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 4
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 5
            ),
            array(
                'role_id'      => 1,
                'permission_id' => 6
            ),
            array(
                'role_id'      => 2,
                'permission_id' => 1
            ),
        );

        DB::table('permission_role')->insert( $permissions );
    }

}
