<?php

namespace App\Http\Controllers\Queue;

use App\Http\Controllers\Controller;
use App\Models\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QueueActionController extends Controller
{
    public function next()
    {
        Queue::where('date', today())
            ->where('status', 'serving')
            ->update(['status' => 'completed', 'completed_at' => now()]);

        $nextQueue = Queue::where('date', today())
            ->where('status', 'waiting')
            ->orderBy('number', 'asc')
            ->first();

        if ($nextQueue) {
            $nextQueue->status = 'serving';
            $nextQueue->served_at = now();
            $nextQueue->save();
        }

        return response()->json($nextQueue);
    }

    public function take(Request $request)
    {
        return DB::transaction(function () {
            $today = today()->toDateString();
            $lastQueue = Queue::where('date', $today)
                ->lockForUpdate()->max('number');

            $nextNumber = $lastQueue ? $lastQueue + 1 : 1;

            $newQueue = Queue::create([
                'number' => $nextNumber,
                'date' => $today,
                'status' => 'waiting',
            ]);

            return response()->json($newQueue);
        });
    }
}
