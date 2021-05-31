<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function display(){
        $user = Auth::user();
        $tickets = Ticket::query();
        $contacts = Contact::query();

        if (!$user->hasRole('admin')){
            $tickets = $tickets->where(['user_id' => $user->id, 'is_done' => false]);
            $contacts = $contacts->where('user_id', $user->id);
        }

        return view('dashboard', [
            'tickets' => $tickets->orderBy('due_date')->limit(6)->get(),
            'ticket_count' => $tickets->count(),
            'daily_ticket_count' => $tickets->whereDate('due_date','<', Carbon::tomorrow())->count(),
            'contact_count' => $contacts->count(),
        ]);
    }
}
