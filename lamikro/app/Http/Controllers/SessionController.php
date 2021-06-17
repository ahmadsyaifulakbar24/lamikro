<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
	public function createSession(Request $request) {
		$request->session()->put('token',$request->token);
	}

	public function deleteSession(Request $request) {
		$request->session()->forget('token');
	}
}