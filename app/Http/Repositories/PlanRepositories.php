<?php

namespace App\Http\Repositories;

use App\Models\Plan;
use App\Models\Category;
use App\Models\PricePlan;
use App\Helper\StripeHelper;
use F9Web\ApiResponseHelpers;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\PlanResource;
use App\Http\Resources\CategoryResource;
use Stripe\Price;

class PlanRepositories
{
    use ApiResponseHelpers;

    private $plan;

    public function __construct(StripeHelper $planHelp)
    {
        $this->plan = $planHelp;
    }

    public function plans($plans)
    {
        try {
            return PlanResource::collection($plans);
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    public function addPlan($info_plan)
    {
        DB::beginTransaction();
        try {
            $stripePlan = $this->plan->createProduct($info_plan['name']);
            $plan = Plan::create([
                'name' => $info_plan['name'],
                'features' => $info_plan['features'],
                'stripe_plan_id' => $stripePlan->id,
            ]);
            foreach ($info_plan['prices'] as $price) {
                $price['plan_id'] = $plan->stripe_plan_id;
                $stripePrice = $this->plan->addPrice($price);
                PricePlan::create([
                    'price' => $price['price'],
                    'duration' => $price['duration'],
                    'plan_id' => $plan->id,
                    'stripe_price_id' => $stripePrice->id,
                ]);
                DB::commit();
            }
            return $this->respondWithSuccess(new PlanResource($plan));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage() . $th->getFile() . $th->getLine();
        }
    }

    public function updatePlan($updatePlan, $plan)
    {
        DB::beginTransaction();
        try {
            Plan::where('id', $plan->id)->update(['name' => $updatePlan['name'], 'features' => $updatePlan['features']]);
            $this->plan->UpdateProduct($plan->stripe_plan_id, $updatePlan['name']);
            foreach ($updatePlan['prices'] as $price) {
                $idPrice = PricePlan::find($price['id']);
                PricePlan::where('id', $idPrice->id)->update(['price' => $price['price'], 'duration' => $price['duration']]);
                $this->plan->UpdatePrice($price, $idPrice->stripe_price_id);
            }
            DB::commit();
            return $this->respondWithSuccess(new PlanResource(Plan::find($plan->id)));
        } catch (\Throwable $th) {
            DB::rollBack();
            return $th->getMessage() . $th->getFile() . $th->getLine();
        }
    }
}
