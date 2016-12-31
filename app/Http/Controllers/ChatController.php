<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Vinkla\Pusher\Facades\Pusher;
use Session;

class ChatController extends Controller
{
	public function index()
	{
		return view('login');
	}

	public function chat(Request $request)
	{
		$name = $request->name;
		$request->session()->put('name', $name);
		return view('chat');
	}

    public function auth(Request $request)
    {
		if ($request->session()->has('name')) 
		{
			$user_id = time();
			$user_data = array('name' => $request->session()->get('name'));
    		return Pusher::presence_auth($request->channel_name, $request->socket_id, $user_id, $user_data);
    	}	
    }
}
