<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketStoreRequest;
use App\Http\Requests\TicketUpdateRequest;
use App\Models\Contact;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Http\Traits\SearchTrait;

class TicketController extends Controller
{
    use SearchTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $tickets = $this->search($request);

        return view('tickets.index', ['tickets' => $tickets->paginate(15)->withQueryString()]);
    }


    public function create()
    {

        $users = User::all();
        $contacts = Contact::all();
        $types = TicketType::all();
        return view('tickets.create', [
            'users' => $users,
            'contacts' => $contacts,
            'types' => $types
        ]);
    }

    public function store(TicketStoreRequest $request)
    {
        $user = Auth::user();
        $validated_request = $request->validated();

        if (!Arr::exists($validated_request,'user_id')) {
            $validated_request['user_id'] = $user->id;
        }

        Ticket::query()->create($validated_request);
        return redirect(route('tickets.index'));
    }

    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        return view('tickets.show', ['ticket' => $ticket]);
    }

    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $users = User::all();
        $contacts = Contact::all();
        return view('tickets.edit', [
            'ticket' => $ticket,
            'users' => $users,
            'contacts' => $contacts,
        ]);
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->update($request->validated());

        return redirect($ticket->is_done ? route('dashboard') : $ticket->path());
    }

    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        $ticket = Ticket::query()->findOrFail($ticket->id);
        $ticket->delete();
        return redirect('/tickets')->with('success', 'Ticket deleted');
    }
}
