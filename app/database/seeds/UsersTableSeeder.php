<?php

class UsersTableSeeder extends Seeder {

  public function run()
  {
    // Uncomment the below to wipe the table clean before populating
    DB::table('users')->truncate();

    $users = array(
      array(
        'username'      => 'admin',
        'email'      => 'admin@example.org',
        'password'   => Hash::make('admin'),
        'confirmed'   => 1,
        'confirmation_code' => md5(microtime().Config::get('app.key')),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
      ),
      array(
        'username'      => 'user',
        'email'      => 'user@example.org',
        'password'   => Hash::make('user'),
        'confirmed'   => 1,
        'confirmation_code' => md5(microtime().Config::get('app.key')),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
      )
    );

    // Uncomment the below to run the seeder
    DB::table('users')->insert($users);
  }

}