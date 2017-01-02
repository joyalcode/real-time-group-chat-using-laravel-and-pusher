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
		if($request->session()->has('name'))
		{
			return view('chat');
		} 
		else if($request->name)
		{				
			$name = $request->name;
			$request->session()->put('name', $name);
			$request->session()->put('user_id', time());
			return view('chat');			
		}
		else
		{
			return redirect('/');
		}
	}

    public function auth(Request $request)
    {
		if ($request->session()->has('name') && $request->isMethod('post')) 
		{
			$user_data = array('name' => $request->session()->get('name'));
			$user_id = $request->session()->get('user_id');
    		return Pusher::presence_auth($request->channel_name, $request->socket_id, $user_id, $user_data);
    	}
    	else
    	{
    		return redirect('/');	
    	}
    }

    public function logout()
    {
    	Session::flush();
    	return redirect('/');
    }
}
