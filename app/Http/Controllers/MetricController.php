<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metric;

class MetricController extends Controller
{
    public function incrementCalls(Request $request)
    {
        // Validate the request
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
        ]);

        // Find or create a metric record for the branch
        $metric = Metric::firstOrCreate(
            ['branch_id' => $request->branch_id],
            ['calls' => 0, 'customer_visited' => 0, 'approved' => 0, 'selected' => 0]
        );

        // Increment the call count
        $metric->increment('calls');

        // Return a success response
        return response()->json([
            'success' => true,
            'calls' => $metric->calls,
        ]);
    }

    public function incrementCustomerVisited(Request $request)
    {
        // Validate the request
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
        ]);

        // Find or create a metric record for the branch
        $metric = Metric::firstOrCreate(
            ['branch_id' => $request->branch_id],
            ['customer_visited' => 0, 'customer_visited' => 0, 'approved' => 0, 'selected' => 0]
        );

        // Increment the call count
        $metric->increment('customer_visited');

        // Return a success response
        return response()->json([
            'success' => true,
            'customer_visited' => $metric->customer_visited,
        ]);
    }

    public function incrementApproved(Request $request)
    {
        // Validate the request
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
        ]);

        // Find or create a metric record for the branch
        $metric = Metric::firstOrCreate(
            ['branch_id' => $request->branch_id],
            ['approved' => 0, 'customer_visited' => 0, 'approved' => 0, 'selected' => 0]
        );

        // Increment the call count
        $metric->increment('approved');

        // Return a success response
        return response()->json([
            'success' => true,
            'approved' => $metric->customer_visited,
        ]);
    }

    public function incrementSelected(Request $request)
    {
        // Validate the request
        $request->validate([
            'branch_id' => 'required|exists:branches,id',
        ]);

        // Find or create a metric record for the branch
        $metric = Metric::firstOrCreate(
            ['branch_id' => $request->branch_id],
            ['approved' => 0, 'customer_visited' => 0, 'approved' => 0, 'selected' => 0]
        );

        // Increment the call count
        $metric->increment('selected');

        // Return a success response
        return response()->json([
            'success' => true,
            'selected' => $metric->selected,
        ]);
    }
}
