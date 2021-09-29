<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class DiscordController extends Controller
{
    public function returnUrl(Request $request)
    {
        try {
            $discordUser = Socialite::driver('discord')->user();
        } catch (\Exception $exception) {
            return response()->redirectToRoute('login');
        }

        if ($request->user()) {
            $user             = $request->user();
            $user->discord_id = $discordUser->getId();
            $user->save();

            return response()->redirectToRoute('orders.index');
        }

        $user = User::where('email', $discordUser->email)->first();

        if (! $user) {
            $newUser = User::create([
                'name'       => $discordUser->getName(),
                'email'      => $discordUser->getEmail(),
                'discord_id' => $discordUser->getId(),
            ]);

            return $this->loginAndRedirect($newUser);
        }

        $user->discord_id = $discordUser->getId();
        $user->save();

        return $this->loginAndRedirect($user);
    }

    private function loginAndRedirect(User $user)
    {
        Auth::login($user, true);

        return response()->redirectToRoute('orders.index');
    }
}
