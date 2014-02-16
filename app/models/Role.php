<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {
	protected $guarded = array();

	public static $rules = array();

  public function menuitems()
  {
    return $this->belongsToMany('Menuitem', 'menuitem_role');
  }
}
