<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\Airport;
use Carbon\Carbon;

class TicketController extends Controller
{
    public function search(Request $request)
    {
        $validated = $request->validate([
            'source_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|exists:airports,id',
            'date' => 'nullable|date', // optional date
        ]);
    
        $query = Ticket::where('source_airport_id', $request->source_airport_id)
            ->where('destination_airport_id', $request->destination_airport_id)
            ->where('date', '>=', Carbon::now());
    
        if ($request->date) {
            $query->whereDate('date', $request->date);
        }
    
        $tickets = $query->paginate(10);
        $remainingQuantities = [];
    
        if (auth()->check()) {
            $user = auth()->user();
    
            foreach ($tickets as $ticket) {
                $purchasedTickets = $user->tickets()
                    ->where('ticket_id', $ticket->id)
                    ->sum('quantity');
    
                $remainingQuantities[$ticket->id] = max(3 - $purchasedTickets, 0);
            }
        }
    
        $sourceAirport = Airport::find($request->source_airport_id);
        $destinationAirport = Airport::find($request->destination_airport_id);
    
        return view('tickets.searchResults', compact('tickets', 'sourceAirport', 'destinationAirport', 'remainingQuantities'));
    }

        

    public function buy(Request $request)
    {
       
        $validated = $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'quantity' => 'required|integer|min:1|max:3',
        ]);

        $ticket = Ticket::findOrFail($request->ticket_id);
        $user = $request->user();

        $purchasedTickets = $user->tickets()
            ->where('ticket_id', $ticket->id)
            ->sum('quantity');

        if ($purchasedTickets >= 3) {
            return back()->with('error', 'You have already purchased the maximum allowed number of tickets for this flight.');
        }

        $remainingTickets = 3 - $purchasedTickets;

        if ($request->quantity > $remainingTickets) {
            return back()->with('error', "You can only purchase {$remainingTickets} more ticket(s) for this flight.");
        }

        $user->tickets()->syncWithoutDetaching([
            $ticket->id => ['quantity' => $purchasedTickets + $request->quantity]
        ]);

        return back()->with('success', "You have successfully purchased {$request->quantity} ticket(s).");
    }

}