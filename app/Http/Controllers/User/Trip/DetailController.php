<?php

namespace App\Http\Controllers\User\Trip;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
    public function __invoke(Request $request)
    {
        $model = Trip::where('id', $request->id)->first();

        if (!$model) return $this->falseResponse('Data Not Found');

        $dataTrip = collect($model->data);

        $data = [
            'id'         => $model->id,
            'price'      => rupiah_format($model->price),
            'start_date' => Carbon::parse($model->start_date)->format('Y-m-d H:i'),
            'end_date'   => Carbon::parse($model->end_date)->format('Y-m-d H:i'),
            'start_trip' => $dataTrip->first(),
            'end_trip'   => $dataTrip->last(),
            'routes'     => $dataTrip,
        ];

        return $this->trueResponse('Detail Trip', $data);
    }
}
