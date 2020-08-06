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
        $query = QueryBuilder::for($member
            ? $member->attachments()->getQuery()
            : Attachment::class
        );

        $attachments = $query
            ->allowedSorts([
                'id',
                'name',
                'created_at',
            ])
            ->allowedFilters([
                'name',
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
        $data = $request->only(['name']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $directory = public_path('uploads/attachments');

            // move file to uploads folder
            $file->move($directory, $filename);

            // override existing filename
            $data['filename'] = $filename;

            try {
                // remove previous file if exists
                unlink("{$directory}/{$attachment->filename}");
            } catch (\Throwable $th) {}

        }

        $attachment->fill($data)->save();

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
