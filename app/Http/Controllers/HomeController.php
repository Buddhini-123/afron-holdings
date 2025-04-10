<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use Auth;
use App\Models\Metric;

class HomeController extends Controller
{
    public function index()
    {
        // Get the branch ID for the authenticated user
        $branch = Branch::where('user_id', Auth::user()->id)->first();
        if ($branch) {
            // Get the calls for the branch
            $calls = Metric::where('branch_id', $branch->id)->first();
        } else {
            // Handle the case where no branch is found for the user
            $calls = collect();

        }
        if ($calls) {
            $call_metric = $calls->calls;
            $customer_visited_metric = $calls->customer_visited;
            $approved_metric = $calls->approved;
            $selected_metric = $calls->selected;
        }else{
            $call_metric = 0;
            $customer_visited_metric = 0;
            $approved_metric = 0;
            $selected_metric = 0;
        }

        return view('home', compact('selected_metric', 'branch', 'call_metric', 'customer_visited_metric', 'approved_metric'));
    }

    public function overview()
    {
        return view('master-list');
    }

    public function navigation()
    {
        return view('summary-navigation');
    }
}
