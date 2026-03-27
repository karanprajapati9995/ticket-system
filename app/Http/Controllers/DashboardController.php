<?php
// namespace App\Http\Controllers;
// use App\Models\Ticket;
// use Illuminate\Http\Request;

// class DashboardController extends Controller
// {
//     public function index()
//     {
//         $total = Ticket::count();
//         $open = Ticket::where('status', 'Open')->count();
//         $inProgress = Ticket::where('status', 'In Progress')->count();
//         $closed = Ticket::where('status', 'Closed')->count();

//         return view('dashboard', compact('total', 'open', 'inProgress', 'closed'));
//     }
// }




namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $total       = Ticket::where('user_id', $userId)->count();
        $open        = Ticket::where('user_id', $userId)->where('status', 'Open')->count();
        $inProgress  = Ticket::where('user_id', $userId)->where('status', 'In Progress')->count();
        $closed      = Ticket::where('user_id', $userId)->where('status', 'Closed')->count();

        return view('dashboard', compact('total', 'open', 'inProgress', 'closed'));
    }
}