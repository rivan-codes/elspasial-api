<?php

namespace App\Http\Controllers\User\Trip;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function __invoke(Request $request)
    {
        $query = Trip::query()
            ->orderBy('start_date', 'desc');

        /** @var \Illuminate\Pagination\CursorPaginator $model */
        $models = $query->cursorPaginate($request->limit);

        $models = $models->through(fn ($item) => [
            'id'       => $item->id,
            'trip'     => collect($item->data)->first()['name'].' - '.collect($item->data)->last()['name'],
            'datetime' => Carbon::parse($item->start_date)->format('Y-m-d H:i'),
            'price'    => rupiah_format($item->price)
        ]);

        return $this->trueResponse('List Trip', $models->items(), metaPagination($models));
    }
}
