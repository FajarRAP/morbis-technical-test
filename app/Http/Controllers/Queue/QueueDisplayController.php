<?php

namespace App\Http\Controllers\Queue;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Queue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class QueueDisplayController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        $current = Queue::where('date', $today)
            ->where('status', 'serving')
            ->first();
        $waitingCount = Queue::where('date', $today)
            ->where('status', 'waiting')
            ->count();

        return view('queue-display', [
            'currentNumber' => $current ? $current->number : 0,
            'waitingCount' => $waitingCount,
        ]);
    }
}
