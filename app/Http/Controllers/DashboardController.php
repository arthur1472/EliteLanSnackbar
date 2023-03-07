<?php

namespace App\Http\Controllers;

use App\Models\User;
use Cknow\Money\Money;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user   = $request->user();
        $wallet = $user->wallet;

        $lastFiveActivities = collect();

        $allActivities = $user->audits()->orderBy('created_at', 'desc')->where('old_values', 'like', '%wallet%')->limit(10)->get();

        foreach ($allActivities as $activity) {
            $activityUserId = $activity->user_id;
            $activityType   = $activity->user_type;
            $isUser         = false;
            $activityUser   = false;

            if ($activityType) {
                $isUser = new $activityType() instanceof User;
            }

            if ($isUser) {
                $activityUser = User::find($activityUserId);
            }

            $oldWalletAmount = Money::parse($activity->old_values['wallet'] ?? 0);
            $newWalletAmount = Money::parse($activity->new_values['wallet'] ?? 0);
            $difference      = $newWalletAmount->subtract($oldWalletAmount);

            $lastFiveActivities->add([
                'self'            => $activityUserId === $user->getKey() && $isUser && $difference->isNegative(),
                'oldWalletAmount' => Money::parse($activity->old_values['wallet'] ?? 0),
                'newWalletAmount' => Money::parse($activity->new_values['wallet'] ?? 0),
                'difference'      => $difference,
                'date'            => $activity->created_at,
                'activityUser'    => $activityUser,
            ]);
        }

        return view('dashboard', [
            'wallet'             => $wallet,
            'lastFiveActivities' => $lastFiveActivities,
        ]);
    }
}
