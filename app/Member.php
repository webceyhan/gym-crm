<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'gender' => MemberGender::MALE,
        'birth_place' => null,
        'phone' => null,
        'email' => null,
        'address' => null,
        'photo' => null,
        'notes' => null,
        'status' => MemberStatus::OUTSIDE,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birth_date',
    ];

    // RELATIONS ///////////////////////////////////////////////////////////////////////////////////

    public function subscription()
    {
        return $this->subscriptions()
            ->latest('id')
            ->first();
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Subscription');
    }

    public function attachments()
    {
        return $this->hasMany('App\Attachment');
    }

    public function relatives()
    {
        return $this->belongsToMany('App\Member', 'relatives', 'owner_id')
            ->using('App\Relative')
            ->withPivot(['id', 'type']);
    }

    public function holidays()
    {
        return $this->hasMany('App\Holiday');
    }

    // SCOPES //////////////////////////////////////////////////////////////////////////////////////

    /**
     * Scope a query to only include male members.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeMale(Builder $query): Builder
    {
        return $query->where('gender', MemberGender::MALE);
    }

    /**
     * Scope a query to only include female members.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeFemale(Builder $query): Builder
    {
        return $query->where('gender', MemberGender::FEMALE);
    }

    /**
     * Scope a query to only include adult members.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAdult(Builder $query): Builder
    {
        return $query->whereRaw("TIMESTAMPDIFF(YEAR, birth_date, NOW()) >= 18");
    }

    /**
     * Scope a query to only include child members.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeChild(Builder $query): Builder
    {
        return $query->whereRaw("TIMESTAMPDIFF(YEAR, birth_date, NOW()) < 18");
    }

    /**
     * Scope a query to only include members inside the club.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeInside(Builder $query): Builder
    {
        return $query->where('status', MemberStatus::INSIDE);
    }

    /**
     * Scope a query to only include members outside the club.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeOutside(Builder $query): Builder
    {
        return $query->where('status', MemberStatus::OUTSIDE);
    }

    /**
     * Scope a query to only include members away (on holiday).
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopeAway(Builder $query): Builder
    {
        return $query->where('status', MemberStatus::AWAY);
    }
}
