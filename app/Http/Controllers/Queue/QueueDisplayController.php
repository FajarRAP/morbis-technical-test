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
        $query = Queue::query();
        $query->where('date', today());

        return view('queue-display', [
            'currentNumber' => $query->orderBy('number')->first()->number,
            'waitingCount' => $query->where('status', 'waiting')->count(),
        ]);
    }
}
