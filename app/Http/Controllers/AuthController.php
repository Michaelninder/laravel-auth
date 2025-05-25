<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
	public function showLoginForm()
	{
	    return view('auth.login');
	}
	
	public function showRegisterForm()
	{
	    return view('auth.register');
	}
	
	public function showPasswordChangeForm()
	{
	    return view('auth.password_change');
	}

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        return response()->json(['message' => __('auth.register_success')]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['error' => __('auth.login_failed')], 401);
        }

        return response()->json(['message' => __('auth.login_success')]);
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json(['error' => __('auth.wrong_password')], 403);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return response()->json(['message' => __('auth.password_changed')]);
    }

    // Discord OAuth Redirect
	public function redirectToDiscord()
	{
	    $query = http_build_query([
	        'client_id'     => config('services.discord.client_id'),
	        'redirect_uri'  => config('services.discord.redirect'),
	        'response_type' => 'code',
	        'scope'         => 'identify email',
	    ]);
	
	    return redirect('https://discord.com/api/oauth2/authorize?' . $query);
	}

    // Discord Callback
	public function handleDiscordCallback(Request $request)
	{
	    $response = Http::asForm()->post('https://discord.com/api/oauth2/token', [
	        'client_id'     => config('services.discord.client_id'),
	        'client_secret' => config('services.discord.client_secret'),
	        'grant_type'    => 'authorization_code',
	        'code'          => $request->get('code'),
	        'redirect_uri'  => config('services.discord.redirect'),
	        'scope'         => 'identify email',
	    ]);
	
	    $accessToken = $response->json()['access_token'] ?? null;
	
	    if (!$accessToken) {
	        return redirect()->route('login')->withErrors(['discord' => 'Failed to get access token.']);
	    }
	
	    $userResponse = Http::withHeaders([
	        'Authorization' => 'Bearer ' . $accessToken,
	    ])->get('https://discord.com/api/users/@me');
	
	    $discordUser = $userResponse->json();
	
	    if (!isset($discordUser['id'])) {
	        return redirect()->route('login')->withErrors(['discord' => 'Failed to get user data.']);
	    }
	
	    $user = \App\Models\User::where('discord_id', $discordUser['id'])->first();
	
	    if (!$user) {
	        $user = \App\Models\User::create([
	            'email'      => $discordUser['email'] ?? $discordUser['id'] . '@discord.local',
	            'password'   => null,
	            'discord_id'=> $discordUser['id'],
	        ]);
	    }
	
	    auth()->login($user, true);
	
	    return redirect()->route('dashboard');
	}
}
