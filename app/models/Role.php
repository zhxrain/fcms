<?php

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole {
	protected $guarded = array();

	public static $rules = array();

  public function menu_items()
  {
    return $this->belongsToMany('MenuItem');
  }
}
