<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\Http\Resources\HolidayResource;
use App\Member;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class HolidayController extends Controller
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
            ? $member->holidays()->getQuery()
            : Holiday::class
        );

        $holidays = $query
            ->allowedSorts([
                'id',
                'end_date',
                'start_date',
                'created_at',
            ])
            ->allowedFilters([
                'start_date',
                'end_date',
                'created_at',
                AllowedFilter::scope('status', 'ofStatus'),
            ])
            ->get();

        return HolidayResource::collection($holidays);
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
        return $this->update($request, $member->holidays()->make());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        return new HolidayResource($holiday);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        $data = $request->all();

        $holiday->fill($data)->save();

        return new HolidayResource($holiday);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        return response()->json(null, 204);
    }
}
