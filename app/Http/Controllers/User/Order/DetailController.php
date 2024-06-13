<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Models\OrderTrip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function __invoke(Request $request)
    {
        $model = OrderTrip::where('id', $request->id)->first();

        if (!$model) return $this->falseResponse('Data Not Found');

        $dataTrip = collect($model->trip->data);

        $trip = [
            'price'      => rupiah_format($model->trip->price),
            'start_date' => Carbon::parse($model->trip->start_date)->format('Y-m-d H:i'),
            'end_date'   => Carbon::parse($model->trip->end_date)->format('Y-m-d H:i'),
            'start_trip' => $dataTrip->first(),
            'end_trip'   => $dataTrip->last(),
            'routes'     => $dataTrip,
        ];

        $data = [
            'id'          => $model->id,
            'order_date'  => Carbon::parse($model->order_date)->format('Y-m-d'),
            'total_price' => rupiah_format($model->total_price),
            'buyer_name'  => $model->data['customer']['name'],
            'buyer_phone' => $model->data['customer']['phone'],
            'buyer_email' => $model->data['customer']['email'],
            'status'      => OrderTrip::STATUS[$model->status],
            'trip'        => $trip,
        ];

        return $this->trueResponse('Detail Order', $data);
    }
}
