<?php

use Baum\Node;

class MenuItemTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('menuitem')->truncate();

    DB::table('menu_items')->delete();

    $root_system_config=MenuItem::create(['name' => '系统配置']);

    $menu_sc_item1=MenuItem::create(array(
      'name' => '状态',
      'uri' => 'state'
    ));
    $menu_sc_item1->makeChildOf($root_system_config);

    $root_network_management=MenuItem::create(['name' => '网络管理']);

    $menu_nm_item1=MenuItem::create(array(
      'name' => '网络接口',
      'uri' => 'network_interface'
    ));
    $menu_nm_item1->makeChildOf($root_network_management);
		// Uncomment the below to run the seeder
		// DB::table('menuitem')->insert($menuitem);
	}

}
