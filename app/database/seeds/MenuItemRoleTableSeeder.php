<?php

use Baum\Node;

class MenuItemRoleTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('menuitemrole')->truncate();

    DB::table('menu_item_role')->delete();

    $roles=Role::all();

    $root_system_config=MenuItem::where('name', '=', "系统配置")->first();
    $root_network_management=MenuItem::where('name', '=', "网络管理")->first();

    foreach($roles as $n=>$role)
    {
      $roleName=$role->name;
      if($roleName=="admin")
      {
        DB::table('menu_item_role')->insert(array('role_id' => $role->id, 'menu_item_id' => $root_system_config->id));
        $root_system_config_descendants=$root_system_config->getDescendants();
        foreach($root_system_config_descendants as $descendant)
        {
          DB::table('menu_item_role')->insert(array('role_id' => $role->id, 'menu_item_id' => $descendant->id));
        }

        DB::table('menu_item_role')->insert(array('role_id' => $role->id, 'menu_item_id' => $root_network_management->id));
        $root_network_management_descendants=$root_network_management->getDescendants();
        foreach($root_network_management_descendants as $descendant)
        {
          DB::table('menu_item_role')->insert(array('role_id' => $role->id, 'menu_item_id' => $descendant->id));
        }
      }
    }
    // Uncomment the below to run the seeder
		// DB::table('menuitemrole')->insert($menuitemrole);
	}

}
