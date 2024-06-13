<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\OrderTrip;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'trip_id' => ['required'],
            'phone'   => ['required'],
        ]);

        $user = Auth::user();

        if (!$trip = Trip::where('id', $request->trip_id)->first()) return $this->falseResponse('Trip Data Not Found');

        if (OrderTrip::where('trip_id', $request->trip_id)->where('status', '!=', OrderTrip::COMPLETED)->first()) return $this->falseResponse('Order has been placed');

        $customer['name']  = $user->name;
        $customer['email'] = $user->email;
        $customer['phone'] = $request->phone;
        
        $model = new OrderTrip();

        $model->user_id     = $user->id;
        $model->trip_id     = $trip->id;
        $model->data        = ['customer'=> $customer];
        $model->order_date  = Carbon::now();
        $model->total_price = $trip->price;
        $model->status      = OrderTrip::PENDING;

        $model->save();

        return $this->trueResponse('Create Order Trip');
    }
}
