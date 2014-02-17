<?php

use Baum\Node;

class MenuitemTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('menuitem')->truncate();

    DB::table('menuitems')->delete();

    $root_system_config=Menuitem::create(array(
      'name' => '系统配置',
      'submenu_flag' => 0
    ));

    $menu_sc_item1=Menuitem::create(array(
      'name' => '状态',
      'uri' => 'state',
      'submenu_flag' => 0
    ));

    $menu_sc_item1_1=Menuitem::create(array(
      'name' => '主页',
      'uri' => 'user',
      'submenu_flag' => 1
    ));
    $menu_sc_item1_1->makeChildOf($menu_sc_item1);

    $menu_sc_item1->makeChildOf($root_system_config);

    $menu_sc_item2=Menuitem::create(array(
      'name' => '快捷配置',
      'uri' => 'easy_config',
      'submenu_flag' => 0
    ));
    $menu_sc_item2->makeChildOf($root_system_config);

    $menu_sc_item3=Menuitem::create(array(
      'name' => '配置',
      'uri' => 'config',
      'submenu_flag' => 0
    ));
    $menu_sc_item3->makeChildOf($root_system_config);

    $menu_sc_item4=Menuitem::create(array(
      'name' => '管理员设置',
      'uri' => 'user',
      'submenu_flag' => 0
    ));
    $menu_sc_item4->makeChildOf($root_system_config);

    $menu_sc_item4_1=Menuitem::create(array(
      'name' => '管理员账号',
      'uri' => 'user',
      'submenu_flag' => 1
    ));
    $menu_sc_item4_1->makeChildOf($menu_sc_item4);

    $menu_sc_item4_2=Menuitem::create(array(
      'name' => '权限管理',
      'uri' => 'user',
      'submenu_flag' => 1
    ));
    $menu_sc_item4_2->makeChildOf($menu_sc_item4);

    $root_network_management=Menuitem::create(array(
      'name' => '网络管理',
      'submenu_flag' => 0
    ));

    $menu_nm_item1=Menuitem::create(array(
      'name' => '网络接口',
      'uri' => 'network_interface',
      'submenu_flag' => 0
    ));
    $menu_nm_item1->makeChildOf($root_network_management);
		// Uncomment the below to run the seeder
		// DB::table('menuitem')->insert($menuitem);
	}

}
