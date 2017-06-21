<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

	public function get ()
	{
		$users = User::all();
		return view('getUsers', compact('users'));
	}

	public function update (Request $request)
	{
		$user = User::find($request['user']['id']);
		if($request['field'] == 'name') {
			$user->name = $request['user']['name'];
			$user->save();
			return ['state' => true];
		}
		if($request['field'] == 'email') {
			$user->email = $request['user']['email'];
			$user->save();
			return ['state' => true];
		}
		if($request['field'] == 'password') {
			$user->password = bcrypt($request['user']['password']);
			$user->save();
			return ['state' => true];
		}
		return ['state' => false];
	}

	public function delete (Request $request)
	{
		$user = User::find($request['user_id']);
		$user->delete();
		return ['state' => true];
	}

}
