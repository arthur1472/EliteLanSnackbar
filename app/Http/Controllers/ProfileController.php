<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsappWebhookMessageJob;
use App\Models\PhoneVerification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        return view('profile.index', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $phoneNumber     = $request->phone_number;
        $whatsappMessage = $request->whatsapp_message;
        $discordMention  = $request->discord_mention;
        $name            = $request->name;

        $user = $request->user();

        if ($request->whatsapp_button) {
            if (! empty($phoneNumber) && strlen($phoneNumber) === 8) {
                $newPhoneNumber = '316' . $phoneNumber;

                if ($user->phone_number !== $newPhoneNumber) {
                    $user->phone_number          = $newPhoneNumber;
                    $user->phone_number_verified = false;
                }
            } else {
                $user->phone_number          = null;
                $user->phone_number_verified = false;
            }

            if (! empty($whatsappMessage)) {
                $user->enable_whatsapp = $whatsappMessage === 'on';
            }
        }

        if ($request->discord_button && ! empty($discordMention)) {
            $user->discord_mention = $discordMention === 'on';
        }

        if ($request->personal_info_button && ! empty($name)) {
            $user->name = $name;
        }

        $user->save();

        return response()->redirectToRoute('profile.index');
    }

    public function phoneVerification(Request $request)
    {
        $user = $request->user();

        if ($request->verify) {
            $code = $request->verification_code;

            $phoneVerification = $user->phoneVerification;

            if ($code === $phoneVerification?->code) {
                $phoneVerification->used = 1;
                $phoneVerification->save();

                $phoneVerification->delete();

                $user->phone_number_verified = true;
                $user->save();
            } else {
                return response()->redirectToRoute('profile.index', [
                    'error' => 'invalid-code',
                ]);
            }
        }

        if ($request->send) {
            if ($user->hasValidPhoneVerificationCode()) {
                return response()->redirectToRoute('profile.index');
            }

            $phoneVerification = PhoneVerification::create([
                'number'     => $user->phone_number,
                'code'       => Str::random(6),
                'expires_at' => Carbon::now()->addMinutes(30),
                'user_id'    => $user->getKey(),
            ]);

            SendWhatsappWebhookMessageJob::dispatch($user, "Welkom bij de snackbar bot. Je code is SNACKBAR-{$phoneVerification->code} . Mocht je geen code aangevraagd hebben, negeer dit bericht. Sorry voor het ongemak!");
        }

        return response()->redirectToRoute('profile.index');
    }
}
