<?php

namespace App\Http\Controllers;

use App\Models\OrederItems;
use App\Http\Requests\StoreOrederItemsRequest;
use App\Http\Requests\UpdateOrederItemsRequest;

class OrederItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrederItemsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrederItemsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrederItems  $orederItems
     * @return \Illuminate\Http\Response
     */
    public function show(OrederItems $orederItems)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrederItems  $orederItems
     * @return \Illuminate\Http\Response
     */
    public function edit(OrederItems $orederItems)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrederItemsRequest  $request
     * @param  \App\Models\OrederItems  $orederItems
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrederItemsRequest $request, OrederItems $orederItems)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrederItems  $orederItems
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrederItems $orederItems)
    {
        //
    }
}
