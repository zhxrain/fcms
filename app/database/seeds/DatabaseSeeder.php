<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		// $this->call('UserTableSeeder');
		$this->call('UsersTableSeeder');
    $this->command->info('User table seeded!');

		$this->call('RolesTableSeeder');
    $this->command->info('Role table seeded!');

		$this->call('PermissionsTableSeeder');
    $this->command->info('Permissions table seeded!');

		$this->call('MenuItemTableSeeder');
    $this->command->info('MenuItem table seeded!');
	}

}
