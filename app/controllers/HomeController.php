<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		//return View::make('hello');
		$users = User::all();
        if(Auth::check()) {
          $user = Auth::user();
          $roles=Role::all();
          foreach($roles as $role)
          {
            if(Auth::user()->hasRole($role->name))
            {
              $menu_items = $role->menuitems;

              //Debugbar::info($role->menuitems);
            }
          }
          return View::make('layouts.main', array('users' => $users, 'current_user' => $user, 'menu_items' => $menu_items, 'role' => $role));
        }
        return Redirect::to('user/login');
	}
  public function showSubmenu()
  {
    Debugbar::disable();
    $menu_items = Menuitem::all();
    return View::make('submenu', array('menu_items' => $menu_items));
  }
}
