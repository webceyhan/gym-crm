<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Http\Resources\AttachmentResource;
use App\Member;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Member $member
     * @return \Illuminate\Http\Response
     */
    public function index(?Member $member = null)
    {
        $query = QueryBuilder::for($member->attachments ?? Attachment::class);

        $attachments = $query
            ->allowedSorts([
                'id',
                'file',
                'created_at',
            ])
            ->allowedFilters([
                'file',
                'created_at',
            ])
            ->get();

        return AttachmentResource::collection($attachments);
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
        return $this->update($request, $member->attachments()->make());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function show(Attachment $attachment)
    {
        return new AttachmentResource($attachment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attachment $attachment)
    {
        $data = $request->all();

        $attachment->save($data);

        return new AttachmentResource($attachment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attachment  $attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attachment $attachment)
    {
        $attachment->delete();

        return response()->json(null, 204);
    }
}
