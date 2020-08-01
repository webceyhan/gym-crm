<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Http\Resources\ActivityResource;
use App\Subscription;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function index(?Subscription $subscription = null)
    {
        $query = QueryBuilder::for($subscription
            ? $subscription->activities()->getQuery()
            : Activity::class
        );

        $activities = $query
            ->allowedSorts([
                'id',
                'type',
                'created_at',
                'finished_at',
            ])
            ->allowedFilters([
                'type',
                'created_at',
                'finished_at',
                AllowedFilter::scope('status', 'ofStatus'),
            ])
            ->get();

        return ActivityResource::collection($activities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Subscription $subscription)
    {
        return $this->update($request, $subscription->activities()->make());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        return new ActivityResource($activity);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $data = $request->all();

        $activity->fill($data)->save();

        return new ActivityResource($activity);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();

        return response()->json(null, 204);
    }
}
