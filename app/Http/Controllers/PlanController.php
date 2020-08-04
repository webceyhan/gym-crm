<?php

namespace App\Http\Controllers;

use App\Http\Resources\PlanResource;
use App\Plan;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = QueryBuilder::for(Plan::class);

        $plans = $query
            ->allowedSorts([
                'id',
                'name',
                'duration',
                'price',
                'monthly_fee',
                'created_at',
            ])
            ->allowedFilters([
                'name',
                'duration',
                'price',
                'monthly_fee',
                'created_at',
            ])
            ->get();

        return PlanResource::collection($plans);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->update($request, new Plan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return new PlanResource($plan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        $data = $request->all();

        $plan->fill($data)->save();

        return new PlanResource($plan);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        $plan->delete();

        return response()->json(null, 204);
    }
}
