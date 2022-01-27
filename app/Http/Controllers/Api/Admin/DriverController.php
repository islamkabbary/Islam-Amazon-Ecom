<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Driver;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Http\Resources\DriverRresource;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return $this->respondWithSuccess(DriverRresource::collection(Driver::all()));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DriverRequest $request)
    {
        try {
            return $this->respondCreated(new DriverRresource(Driver::create($request->all())));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $driver = Driver::findOrFail($id);
            return $this->respondWithSuccess(new DriverRresource($driver));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DriverRequest $request, $id)
    {
        try {
            $driver = Driver::findOrFail($id);
            $driver->update($request->validated());
            return $this->respondWithSuccess(new DriverRresource($driver));
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $driver = Driver::findOrFail($id);
            $driver->delete();
            return $this->respondError('Driver Deleted Successfully');
        } catch (\Throwable $th) {
            return $this->respondError($th->getMessage());
        }
    }
}
