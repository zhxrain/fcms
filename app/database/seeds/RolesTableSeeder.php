<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('roles')->delete();

        $adminRole = new Role;
        $adminRole->name = 'Administrators';
        $adminRole->description = '安全管理员';
        $adminRole->save();

        $managerRole = new Role;
        $managerRole->name = 'Managers';
        $managerRole->description = '系统管理员';
        $managerRole->save();

        $auditorsRole = new Role;
        $auditorsRole->name = 'Auditors';
        $auditorsRole->description = '审计管理员';
        $auditorsRole->save();

        $user = User::where('username','=','admin')->first();
        $user->attachRole( $adminRole );

        $user = User::where('username','=','user1')->first();
        $user->attachRole( $managerRole);

        $user = User::where('username','=','user')->first();
        $user->attachRole( $auditorsRole);
    }

}
