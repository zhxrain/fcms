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
          $user = Auth::user()->username;
          $menu_items = MenuItem::all();
          return View::make('layouts.main', array('users' => $users, 'current_user' => $user, 'menu_items' => $menu_items));
        }
        return Redirect::to('user/login');
	}

}
