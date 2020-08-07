<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubscriptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'plan_id' => $this->plan_id,
            'member_id' => $this->member_id,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'balance' => $this->balance,
            'plan' => $this->plan,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'cancelled_at' => $this->cancelled_at,
        ];
    }
}
