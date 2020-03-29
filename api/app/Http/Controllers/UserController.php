<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Libraries\Helpers;
use App\Models\User;

class UserController extends Controller {

  /**
   * Show an user
   *
   * @param  Request $request
   * @return Response
   */
  public function show(Request $request) {
    try {
      $id = $request->token->id;
      $user = User::find($id);
      return response()->json($user);
    } catch (Exception $err) {
      return $err;
    }
  }

  /**
   * Register an user
   * 
   * @param Request $request
   * @return Response
   */
  public function register(Request $request) {
    try {

      /**
       * Data Validation
       * 
       */
      $this->validate($request, [
        'name'        => ['required', 'max:80'],
        'login'       => ['required', 'unique:users'],
        'password'    => ['required', 'min:8']
      ]);

      /**
       * Registering user
       * 
       */
      $user = new User;

      $user->name = $request->name;
      $user->login = $request->login;
      $user->password = Helpers::encrypt($request->password);

      $register = $user->save();

      $user = User::where("login", "=", $request->login)->get()->first();
      
      if ($register) {
        return response()->json([
          "success"   => true,
          "user"      => $user
        ]);
      }

      return response()->json([
        "success"   => false,
        "message"   => "error"
      ]);

    } catch (Exception $err) {
      return $err;
    }
  }

  /**
   * Sign In
   *
   * @param  Request $request
   * @return Response
   */
  public function signin(Request $request) {
    try { 

      /**
       * Data Validation
       * 
       */
      $this->validate($request, [
        'login'     => ['required'],
        'password'  => ['required', 'min:8']
      ]);

      $login = User::where([
        ['login', '=', $request->login],
        ['password', '=', Helpers::encrypt($request->password)]
      ])->first();

      if (empty($login)) {
        return response()->json([
          "success"  => false,
          "message"  => "incorrect login or password"
        ]);
      }

      $token = Helpers::generateJWT($login->id, $login->login);

      return response()->json([
        "success"   => true,
        "token"     => $token,
        "user"      => $login,
      ]);

    } catch (Exception $err) {
      return $err;
    }
  }
}
