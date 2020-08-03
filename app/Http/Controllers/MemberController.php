<?php

namespace App\Http\Controllers;

use App\Http\Resources\MemberResource;
use App\Member;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = QueryBuilder::for(Member::class);

        $members = $query
            ->allowedSorts([
                'id',
                'name',
                'gender',
                'birth_date',
                'status',
                'created_at',
            ])
            ->allowedFilters([
                'name',
                AllowedFilter::exact('gender'),
                'birth_date',
                'phone',
                'email',
                'address',
                AllowedFilter::exact('status'),
                'created_at',
            ])
            ->get();

        return MemberResource::collection($members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->update($request, new Member);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        return new MemberResource($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $data = $request->all();

        $member->fill($data)->save();

        return new MemberResource($member);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $member->delete();

        return response()->json(null, 204);
    }
}
