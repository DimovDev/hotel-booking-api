<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        $payments = Payment::with(['booking', 'booking.room', 'booking.customer'])->get();
        return PaymentResource::collection($payments);
    }


    /**
     * Store a newly created resource in storage.
     * @param StorePaymentRequest $request
     * @return PaymentResource
     */
    public function store(StorePaymentRequest $request): PaymentResource
    {
        $payment = Payment::create($request->all());
        return new PaymentResource($payment);
    }

    /**
     * Display the specified resource.
     * @param Payment $payment
     * @return PaymentResource
     */
    public function show(Payment $payment): PaymentResource
    {
        $payment->load(['booking', 'booking.room', 'booking.customer']);
        return new PaymentResource($payment);
    }

}
