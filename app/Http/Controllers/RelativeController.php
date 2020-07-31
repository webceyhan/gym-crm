<?php

namespace App\Http\Controllers;

use App\Http\Resources\RelativeResource;
use App\Member;
use App\Relative;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class RelativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Member $member
     * @return \Illuminate\Http\Response
     */
    public function index(?Member $member = null)
    {
        $query = QueryBuilder::for($member->relatives ?? Relative::class);

        $relatives = $query
            ->allowedSorts([
                'id',
                'type',
                'created_at',
            ])
            ->allowedFilters([
                'type',
                'created_at',
            ])
            ->get();

        return RelativeResource::collection($relatives);
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
        return $this->update($request, $member->relatives()->newPivot());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Relative  $relative
     * @return \Illuminate\Http\Response
     */
    public function show(Relative $relative)
    {
        return new RelativeResource($relative);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Relative  $relative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relative $relative)
    {
        $data = $request->all();

        $relative->save($data);

        return new RelativeResource($relative);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Relative  $relative
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relative $relative)
    {
        $relative->delete();

        return response()->json(null, 204);
    }
}
