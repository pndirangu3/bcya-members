<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [

            'totalMembers'     => Member::count(),

            'pendingMembers'   => Member::where('status', 'Pending')->count(),

            'approvedMembers'  => Member::where('status', 'Approved')->count(),

            'rejectedMembers'  => Member::where('status', 'Rejected')->count(),

            'payams'           => Member::distinct('payam')->count(),

            'bomas'            => Member::distinct('boma')->count(),

            'administrators'   => User::count(),

        ]);
    }
}
