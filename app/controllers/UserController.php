<?php
/*
|--------------------------------------------------------------------------
| Confide Controller Template
|--------------------------------------------------------------------------
|
| This is the default Confide controller template for controlling user
| authentication. Feel free to change to your needs.
|
*/
use DebugBar\StandardDebugBar;

class UserController extends BaseController {

    /**
     * Displays the form for account creation
     *
     */

    public function index()
    {
        $users = User::orderBy('id', 'ASC')->get();
        if(Auth::check()) {
            $user = Auth::user()->username;
            return View::make('users.index', array('users' => $users, 'current_user' => $user));
        }
        return View::make('users.index', array('users' => $users, 'current_user' => 'guest'));
    }

    public function show($id)
    {
        $roles = Role::all();
        if($id == 0){
            return View::make('users.create', array('roles' => $roles));
        }
        $user = User::find($id);
        return View::make('users.edit', array('user' => $user, 'roles' => $roles));
    }

    public function create()
    {
        $username = Input::get('username');
        $email = Input::get('email');
        $password = Input::get('password');
        $password_again = Input::get('password_again');
        $rolename = Input::get('rolename');

        $roles = Role::all();

        if($password != $password_again){
            $msg_error = "The twice input password is different!";
            return View::make('users.create', array('username' => $username, 'rolename' => $rolename, 'email' => $email, 'msg_error' => $msg_error, 'roles' => $roles));
        }

        if(User::where('username', '=', $username)->count() > 0){
            $msg_error = "The username is exist!";
            return View::make('users.create', array('username' => $username, 'rolename' => $rolename, 'email' => $email, 'msg_error' => $msg_error, 'roles' => $roles));
        }

        $role = Role::where('name', '=', $rolename)->first();

        $user = array(
            array(
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($password),
                'confirmed' => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'created_at' => new DateTime('now'),
                'updated_at' => new DateTime('now'),
            )
        );
        $result = DB::table('users')->insert($user);

        $user_new = User::where('username', '=', $username)->first();

        $user_new->attachRole( $role );

        $users = User::all();

        if($result == 1)
        {
            return View::make('users.index', array('users' => $users));
        }
        else
        {
            $msg_error = "Database error!";
            return View::make('users.create', array('username' => $username, 'rolename' => $rolename, 'email' => $email, 'msg_error' => $msg_error, 'roles' => $roles));
        }
    }

    public function update($id)
    {
        $user = User::find($id);
        if (Input::has('old_password') && Input::has('new_password') && Input::has('new_password_again'))
        {
            $old_password = Input::get('old_password');
            $new_password = Input::get('new_password');
            $new_password_again = Input::get('new_password_again');
            if($new_password_again != $new_password)
            {
              return Response::json("different new password", 404);
            }
            if (Hash::check($old_password, $user->password))
            {
              $input = array(
                'token'=>Input::get( 'token' ),
                'password' => $old_password,
                'password_confirmation' => $new_password_again 
              );
              $result = DB::update('update users set password = ? where id = ?', array(Hash::make($new_password), $id));
              //if( Confide::resetPassword( $input ) )
              //{
              //  $notice_msg = Lang::get('confide::confide.alerts.password_reset');
              //  return Response::json($notice_msg, 200);
              //}
              //else
              //{
              //  $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
              //  return Response::json($error_msg, 500);
              //}
              if($result == 1){
                return Response::json("Update password success", 200);
              }
              return Response::json("Update password failed", 500);
            }
            return Response::json("password error", 500);
        }
        if (Input::has('name'))
        {
          $user->username = Input::get('name');
          $user->email = Input::get('email');
          $role_id = Role::where('name', '=', Input::get('rolename'))->first()->id;
          $success = $user->updateUniques();
          $result = DB::update('update assigned_roles set role_id = ? where user_id = ?', array($role_id, $id));
          if($success && $result == 1)
            return Response::json("Update success!", 200);
          return Response::json("Update failed!", 500);
        }
        return Response::json("Input error!", 500);
    }

    public function destroy($id)
    {
      $user = User::find($id);
      $success = $user->delete();
      $result = DB::delete('delete from assigned_roles where user_id = ?', array($id));
      if($success && $result == 1)
        return '200';
      return '500';
    }

    public function getCreate()
    {
      return View::make(Config::get('confide::signup_form'));
    }

    /**
     * Stores new account
     *
     */
    public function postIndex()
    {
      $user = new User;

      $user->username = Input::get( 'username' );
      $user->email = Input::get( 'email' );
      $user->password = Input::get( 'password' );

      // The password confirmation will be removed from model
      // before saving. This field will be used in Ardent's
      // auto validation.
      $user->password_confirmation = Input::get( 'password_confirmation' );

      // Save if valid. Password field will be hashed before save
      $user->save();

      if ( $user->id )
      {
        // Redirect with success message, You may replace "Lang::get(..." for your custom message.
        return Redirect::to('user/login')
          ->with( 'notice', Lang::get('confide::confide.alerts.account_created') );
      }
      else
      {
        // Get validation errors (see Ardent package)
        $error = $user->errors()->all(':message');

        return Redirect::to('user/create')
          ->withInput(Input::except('password'))
          ->with( 'error', $error );
      }
    }

    /**
     * Displays the login form
     *
     */
    public function login()
    {
      if( Confide::user() )
      {
        // If user is logged, redirect to internal 
            // page, change it to '/admin', '/dashboard' or something
            return Redirect::to('/');
        }
        else
        {
            //return View::make(Config::get('confide::login_form'));
            return View::make('login');
        }
    }

    /**
     * Attempt to do login
     *
     */
    public function postLogin()
    {
        $input = array(
            'email'    => Input::get( 'username' ), // May be the username too
            'username' => Input::get( 'username' ), // so we have to pass both
            'password' => Input::get( 'password' ),
            'remember' => Input::get( 'remember' ),
        );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        // Get the value from the config file instead of changing the controller
        if ( Confide::logAttempt( $input)) 
        {
            // Redirect the user to the URL they were trying to access before
            // caught by the authentication filter IE Redirect::guest('user/login').
            // Otherwise fallback to '/'
            // Fix pull #145
            return Redirect::intended('/'); // change it to '/admin', '/dashboard' or something
        }
        else
        {
            $user = new User;

            // Check if there was too many login attempts
            if( Confide::isThrottled( $input ) )
            {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            }
            elseif( $user->checkUserExists( $input ) and ! $user->isConfirmed( $input ) )
            {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            }
            else
            {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::to('user/login')
                ->with('error', $err_msg);
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function getConfirm( $code )
    {
        if ( Confide::confirm( $code ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.confirmation');
                        return Redirect::to('user/login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_confirmation');
                        return Redirect::to('user/login')
                            ->with( 'error', $error_msg );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function getForgot()
    {
        return View::make(Config::get('confide::forgot_password_form'));
    }

    /**
     * Attempt to send change password link to the given email
     *
     */
    public function postForgot()
    {
        if( Confide::forgotPassword( Input::get( 'email' ) ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_forgot');
                        return Redirect::to('user/login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_forgot');
                        return Redirect::to('user/forgot')
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function getReset( $token )
    {
        return View::make(Config::get('confide::reset_password_form'))
                ->with('token', $token);
    }

    /**
     * Attempt change password of the user
     *
     */
    public function postReset()
    {
        $input = array(
            'token'=>Input::get( 'token' ),
            'password'=>Input::get( 'password' ),
            'password_confirmation'=>Input::get( 'password_confirmation' ),
        );

        // By passing an array with the token, password and confirmation
        if( Confide::resetPassword( $input ) )
        {
            $notice_msg = Lang::get('confide::confide.alerts.password_reset');
                        return Redirect::to('user/login')
                            ->with( 'notice', $notice_msg );
        }
        else
        {
            $error_msg = Lang::get('confide::confide.alerts.wrong_password_reset');
                        return Redirect::to('user/reset/'.$input['token'])
                            ->withInput()
                ->with( 'error', $error_msg );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function getLogout()
    {
        Confide::logout();

        return Redirect::to('/user/login');
    }

}
