<?php

namespace App\Http\Controllers\Data;

use App\Http\Controllers\Controller;
use App\Models\OrderTrip;

class OrderStatusController extends Controller
{
    public function __invoke()
    {
        $data =  array_values(OrderTrip::STATUS);

        return $this->trueResponse('Dropdown Status Order Trip', $data);
    }
}
