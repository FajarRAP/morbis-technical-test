<?php

namespace App\Http\Controllers\Queue;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use Illuminate\Http\Request;

class QueueListController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $current = Queue::where('date', $today)
            ->where('status', 'serving')
            ->first();

        $waitingList = Queue::where('date', $today)
            ->where('status', 'waiting')
            ->orderBy('number', 'asc')
            ->get();

        return view('dashboard', [
            'currentNumber' => $current ? $current->number : 0,
            'waitingList' => $waitingList,
            'waitingCount' => $waitingList->count()
        ]);
    }
}
