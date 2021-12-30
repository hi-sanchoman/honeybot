<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use DB;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->middleware('auth');
        // dd(Auth::user());

        $channel = DB::table('questions_channel')->where('channel_name', Auth::user()->nickname)->first();

        $channelIsConnected = $channel == null ? false : true;

        return view('home', compact('channelIsConnected'));
    }

    public function twitchLogin()
    {
        return Socialite::driver('twitch')->redirect();
    }


    public function twitchAuth(Request $request)
    {
        $twitchUser = Socialite::driver('twitch')->stateless()->user();
        // dd($twitchUser);

        $user = User::where('nickname', $twitchUser->nickname)->first();

        if (!$user) {
            $user = User::create([
                'name' => $twitchUser->name,
                'email' => $twitchUser->email,
                'nickname' => $twitchUser->nickname,
                'password' => md5($twitchUser->nickname),
            ]);
        } else {
            $user->nickname = $twitchUser->nickname;
            $user->save();
        }

        Auth::login($user);

        return redirect('/home');
    }


    public function join() 
    {
        $this->middleware('auth');

        $channel = DB::table('questions_channel')->where('channel_name', Auth::user()->nickname)->first();
        
        if ($channel == null) {
            // dd('add channel');
            DB::table('questions_channel')->insert([
                'channel_name' => Auth::user()->nickname,
            ]);

            // restart bot
            $this->_restartBot(5);
        }

        return redirect('/home');
    }


    public function part() 
    {
        $this->middleware('auth');

        $channel = DB::table('questions_channel')->where('channel_name', Auth::user()->nickname)->first();
        
        if ($channel != null) {
            // dd('remove channel');
            DB::table('questions_askedquestion')->where('channel_id', $channel->id)->delete();
            DB::table('questions_channel')->where('channel_name', Auth::user()->nickname)->delete();

            // restart bot
            $this->_restartBot(5);
        }

        return redirect('/home');
    }


    private function _restartBot($seconds) {
        system('/sbin/stop_bot');
        sleep($seconds);
        system('/sbin/start_bot');
    }
}
