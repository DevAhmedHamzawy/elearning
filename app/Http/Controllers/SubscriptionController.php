<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function showSubscriptionForm() {
        return view('user.student.subscribe');
    }
    
    public function subscribe() {
        return auth()->user()
                ->newSubscription(
                    request('plan'), request('plan')
                )
                ->trialDays(request('trial'))
                ->create(
                    request('stripeToken')
                );
    }

    public function change() {
        $this->validate(request(), [
            'plan' => 'required'
        ]);
        $user = auth()->user();
        $userPlan = $user->subscriptions->first()->stripe_plan;

        if (request('plan') === $userPlan) {
            return redirect()->back();
        }

        $user->subscription($userPlan)->swap(request('plan'));

        return redirect()->back();
    }

    public function updateCard() {
        $this->validate(request(), [
        //    'stripeToken' => 'required'
        ]);
        $token = request('stripeToken');
        $user = auth()->user();

        $user->updateDefaultPaymentMethod($token);
        return response()->json('ok');
    }
}