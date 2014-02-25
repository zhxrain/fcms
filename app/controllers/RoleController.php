<?php

class RoleController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    $roles = Role::all();
    return View::make('roles.index', ['roles' => $roles]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
    //$rolename = input::get('rolename');
    //$description = input::get('description');
    //$count = db::table('roles')->where('name', '=', $rolename)->count();
    //if($count > 0)
      //return view::make('roles.create', array('rolename' => $rolename, 'description' => $description, 'msg_error' => "the role name is already exist, please change the role name and submit again"));
    //$role = new role;
    //$role->name = $rolename;
    //$role->description = $description;
    //$role->save();
    //$roles = Role::all();
    //return View::make('roles.index', ['roles' => $roles]);
    return View::make('roles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
    $rolename = Input::get('rolename');
    $description = Input::get('description');
    $count = DB::table('roles')->where('name', '=', $rolename)->count();
    if($count > 0)
      return View::make('roles.create', array('rolename' => $rolename, 'description' => $description, 'msg_error' => "the role name is already exist, please change the role name and submit again"));
    $role = new Role;
    $role->name = $rolename;
    $role->description = $description;
    $role->save();
    $roles = Role::all();
    return View::make('roles.index', ['roles' => $roles]);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        if($id == 0){
            return View::make('roles.create');
        }
        $role = Role::find($id);
        return View::make('roles.edit', array('role' => $role));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        return View::make('roles.edit');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
    $role = Role::find($id);
    $role->name = Input::get('rolename');
    $role->description = Input::get('description');
    $role->save();
    $roles = Role::all();
    return View::make('roles.index', ['roles' => $roles]);
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
    $role = Role::find($id);
    $count = DB::table('menuitem_role')->where('role_id', '=', $id)->count();
    if($count > 0)
      return Response::json("The role is used by User, please delete or update the user first!", 500);
    $success = $role->delete();
    if($success)
      return '200';
    return '500';
	}

}
