<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Http\Repositories\PlanRepositories;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;

class PlanController extends Controller
{
    private $planRepositories;

    public function __construct(PlanRepositories $planRepositories)
    {
        $this->planRepositories = $planRepositories;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->planRepositories->plans(Plan::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request)
    {
        return $this->planRepositories->addPlan($request->validated());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request,Plan $plan)
    {
        return $this->planRepositories->updatePlan($request->validated(),$plan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
