<?php

namespace App;

use App\Traits\Relation\HasAttachments;
use App\Traits\Relation\HasHolidays;
use App\Traits\Relation\HasRelatives;
use App\Traits\Relation\HasSubscriptions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasSubscriptions, HasRelatives, HasHolidays, HasAttachments;

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
        'verified_at' => null,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'birth_date',
        'verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'birth_date' => 'date:Y-m-d',
    ];

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
     * Scope a query to only include [not-]adult members.
     *
     * @param boolean $state
     * @param Builder $query
     * @return Builder
     */
    public function scopeAdult(Builder $query, $state = true): Builder
    {
        $ago = now()->subYears(18);
        $operator = !!$state ? '<' : '>=';

        return $query->whereDate('birth_date', $operator, $ago);
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

    /**
     * Scope a query to only include [not-]verified members.
     *
     * @param boolean $state
     * @param Builder $query
     * @return Builder
     */
    public function scopeVerified(Builder $query, $state = true): Builder
    {
        return $query->whereNull('verified_at', 'and', !!$state);
    }
}
