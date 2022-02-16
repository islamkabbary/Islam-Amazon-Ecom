<?php

namespace App\Http\Controllers;

use App\Helper\StripeHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserPlanRequest;
use App\Http\Repositories\PlanRepositories;
use App\Models\PricePlan;
use Stripe\Price;

class UserPlanController extends Controller
{
    private $planRepositories;
    private $plan;

    public function __construct(PlanRepositories $planRepositories , StripeHelper $planHelp)
    {
        $this->planRepositories = $planRepositories;
        $this->plan = $planHelp;
    }

    public function subscriptionUserToPlan(UserPlanRequest $request)
    {
        $user = Auth::user();
        if(empty($user->stripe_id)){
            $token = $this->plan->createToken($request->validated());
            $this->plan->createCustomer($token);
        }
        $price = PricePlan::find($request->price_id);
        $pricePlan = $this->plan->addUserPlan($user->stripe_id,$price->stripe_price_id);
        $user->plan_stripe_id = $pricePlan->id;
        $user->price_id = $request->price_id;
        $user->save();
        return $user;
    }
}
