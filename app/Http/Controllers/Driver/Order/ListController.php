<?php

namespace App\Http\Controllers\Driver\Order;

use App\Http\Controllers\Controller;
use App\Models\OrderTrip;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = OrderTrip::query()
            ->where(function ($where) use ($request) {
                if ($request->status) {
                    $where->where('status', $request->status);
                }
            })->orderBy('order_date', 'desc');

        /** @var \Illuminate\Pagination\CursorPaginator $model */
        $models = $query->cursorPaginate($request->limit);

        $models = $models->through(fn ($item) => [
            'id'          => $item->id,
            'buyer_name'  => $item->data['customer']['name'],
            'trip'        => collect($item->trip->data)->first()['name'].' - '.collect($item->trip->data)->last()['name'],
            'order_date'  => Carbon::parse($item->order_date)->format('Y-m-d'),
            'total_price' => rupiah_format($item->total_price),
            'status'      => OrderTrip::STATUS[$item->status],
        ]);

        return $this->trueResponse('List Trip', $models->items(), metaPagination($models));
    }
}
