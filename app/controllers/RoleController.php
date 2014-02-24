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
    $rolename = Input::get('rolename');
    $description = Input::get('description');
    $count = DB::table('roles')->where('name', '=', $rolename)->count();
    if($count > 0)
      return View::make('roles.create', array('rolename' => $rolename, 'description' => $description, 'msg_error' => "The role name is already exist, please change the role name and submit again"));
    $role = new Role;
    $role->name = $rolename;
    $role->description = $description;
    $role->save();
    $roles = Role::all();
    return View::make('roles.index', ['roles' => $roles]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
