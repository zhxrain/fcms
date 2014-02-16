<?php

use Baum\Node;

class MenuitemTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('menuitem')->truncate();

    DB::table('menuitems')->delete();

    $root_system_config=Menuitem::create(['name' => '系统配置']);

    $menu_sc_item1=Menuitem::create(array(
      'name' => '状态',
      'uri' => 'state'
    ));
    $menu_sc_item1->makeChildOf($root_system_config);

    $menu_sc_item2=Menuitem::create(array(
      'name' => '快捷配置',
      'uri' => 'easy_config'
    ));
    $menu_sc_item2->makeChildOf($root_system_config);

    $menu_sc_item3=Menuitem::create(array(
      'name' => '配置',
      'uri' => 'config'
    ));
    $menu_sc_item3->makeChildOf($root_system_config);

    $menu_sc_item4=Menuitem::create(array(
      'name' => '管理员设置',
      'uri' => 'user'
    ));
    $menu_sc_item4->makeChildOf($root_system_config);

    $menu_sc_item5=Menuitem::create(array(
      'name' => '权限管理',
      'uri' => 'role'
    ));
    $menu_sc_item5->makeChildOf($root_system_config);

    $root_network_management=Menuitem::create(['name' => '网络管理']);

    $menu_nm_item1=Menuitem::create(array(
      'name' => '网络接口',
      'uri' => 'network_interface'
    ));
    $menu_nm_item1->makeChildOf($root_network_management);
		// Uncomment the below to run the seeder
		// DB::table('menuitem')->insert($menuitem);
	}

}
