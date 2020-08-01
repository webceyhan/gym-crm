<?php

namespace App\Http\Controllers;

use App\Http\Resources\PaymentResource;
use App\Payment;
use App\Subscription;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  Subscription $subscription
     * @return \Illuminate\Http\Response
     */
    public function index(?Subscription $subscription = null)
    {
        $query = QueryBuilder::for($subscription->payments ?? Payment::class);

        $payments = $query
            ->allowedSorts([
                'id',
                'amount',
                'method',
                'type',
                'created_at',
            ])
            ->allowedFilters([
                'amount',
                'method',
                'type',
                'created_at',
            ])
            ->get();

        return PaymentResource::collection($payments);
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
        return $this->update($request, $subscription->payments()->make());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show(Payment $payment)
    {
        return new PaymentResource($payment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $data = $request->all();

        $payment->fill($data)->save();

        return new PaymentResource($payment);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json(null, 204);
    }
}
