<?php

namespace App\Http\Controllers\Driver\Order;

use App\Http\Controllers\Controller;
use App\Models\OrderTrip;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompletedController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'id' => ['required'],
        ]);

        $model = OrderTrip::where('id', $request->id)->first();

        if ($model->status == OrderTrip::COMPLETED  ) return $this->falseResponse('Order has been completed');

        $model->status = OrderTrip::COMPLETED;

        $model->save();

        return $this->trueResponse('Order completed');
    }
}
