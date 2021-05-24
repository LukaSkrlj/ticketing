<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function display(){
        $tickets = Ticket::query();
        if (!Auth::user()->hasRole('admin')){
            $tickets = $tickets->where('user_id', Auth::user()->id);
        }

        return view('dashboard', [
            'tickets' => $tickets->orderBy('due_date')->limit(6)->get(),
            'ticket_count' => $tickets->count(),
            'daily_ticket_count' => $tickets->whereDate('due_date','<', Carbon::tomorrow())->count(),
        ]);
    }
}
