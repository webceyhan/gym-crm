<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionResource;
use App\Member;
use App\Subscription;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public function index(?Member $member = null)
    {
        $query = QueryBuilder::for($member
            ? $member->subscriptions()->getQuery()
            : Subscription::class
        );

        // preload relation
        $query->with('plan');

        $subscriptions = $query
            ->defaultSort('-id')
            ->allowedSorts([
                'id',
                'start_date',
                'end_date',
                'balance',
                'created_at',
                'cancelled_at',
            ])
            ->allowedFilters([
                'start_date',
                'end_date',
                'balance',
                'created_at',
                AllowedFilter::scope('status', 'ofStatus'),
            ])
            ->get();

        return SubscriptionResource::collection($subscriptions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Member $member)
    {
        return $this->update($request, $member->subscriptions()->make());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        return new SubscriptionResource($subscription);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        $data = $request->all();

        $subscription->fill($data)->save();

        return new SubscriptionResource($subscription);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return response()->json(null, 204);
    }
}
