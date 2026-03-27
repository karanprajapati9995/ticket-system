<?php
// namespace App\Http\Controllers;
// use App\Models\Ticket;
// use Illuminate\Http\Request;

// class TicketController extends Controller
// {
//     public function index(Request $request)
//     {
//         $query = Ticket::latest();

//         if ($search = $request->get('search')) {
//             $query->where('title', 'like', "%{$search}%")
//                   ->orWhere('description', 'like', "%{$search}%");
//         }
//         if ($status = $request->get('status')) {
//             $query->where('status', $status);
//         }

//         $tickets = $query->paginate(10)->appends($request->query());

//         if ($request->ajax()) {
//             return response()->json($tickets);
//         }

//         return view('tickets.index', compact('tickets'));
//     }

//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'title' => 'required|string|max:255',
//             'description' => 'required|string',
//             'status' => 'required|in:Open,In Progress,Closed',
//             'priority' => 'nullable|in:Low,Medium,High',
//         ]);

//         $ticket = Ticket::create($validated);

//         if ($request->ajax()) {
//             return response()->json(['success' => true, 'ticket' => $ticket]);
//         }
//         return redirect()->route('tickets.index');
//     }

//     public function update(Request $request, Ticket $ticket)
//     {
//         $validated = $request->validate([
//             'title' => 'required|string|max:255',
//             'description' => 'required|string',
//             'status' => 'required|in:Open,In Progress,Closed',
//             'priority' => 'nullable|in:Low,Medium,High',
//         ]);

//         $ticket->update($validated);

//         if ($request->ajax()) {
//             return response()->json(['success' => true, 'ticket' => $ticket]);
//         }
//         return redirect()->route('tickets.index');
//     }

//     public function destroy(Ticket $ticket)
//     {
//         $ticket->delete();
//         if (request()->ajax()) {
//             return response()->json(['success' => true]);
//         }
//         return redirect()->route('tickets.index');
//     }
// }




namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::where('user_id', Auth::id())->latest();

        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $tickets = $query->paginate(10)->appends($request->query());

        if ($request->ajax()) {
            return response()->json($tickets);
        }

        return view('tickets.index', compact('tickets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:Open,In Progress,Closed',
            'priority'    => 'nullable|in:Low,Medium,High',
        ]);

        $validated['user_id'] = Auth::id();   // ← yeh important line

        $ticket = Ticket::create($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'ticket' => $ticket]);
        }

        return redirect()->route('tickets.index');
    }

    public function update(Request $request, Ticket $ticket)
    {
        // Security: sirf apna ticket edit kar sake
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'status'      => 'required|in:Open,In Progress,Closed',
            'priority'    => 'nullable|in:Low,Medium,High',
        ]);

        $ticket->update($validated);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'ticket' => $ticket]);
        }

        return redirect()->route('tickets.index');
    }

    public function destroy(Ticket $ticket)
    {
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }

        $ticket->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('tickets.index');
    }

    public function show(Ticket $ticket)
{
    if ($ticket->user_id !== Auth::id()) {
        abort(403);
    }

    return response()->json($ticket);
}
}