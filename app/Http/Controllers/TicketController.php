<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        if (!$user->hasRole('admin')) {
            $request->request->add(['user_id' => $user->id]);
        }

        $ticket = new Ticket($this->validateTicket($request));
        $ticket->save();

        return redirect(route('tickets.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        $this->authorize('view', $ticket);
        return view('tickets.show', ['ticket' => $ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        $this->authorize('update', $ticket);
        $users = User::all();//omoguci slanje svih usera samo za admina
        $contacts = Contact::all();
        return view('tickets.edit', [
            'ticket' => $ticket,
            'users' => $users,
            'contacts' => $contacts,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $ticket->update($this->validateUpdatedTicket($request));

        return redirect($ticket->is_done ? route('dashboard') : $ticket->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $this->authorize('delete', $ticket);
        $ticket = Ticket::query()->findOrFail($ticket->id);
        $ticket->delete();
        return redirect('/tickets')->with('success', 'Ticket deleted');
    }

    protected function validateTicket(Request $request): array
    {
        return $request->validate([
            'name' => 'required|alpha_num|max:150',
            'description' => 'required|max:750',
            'type' => 'required',
            'contact_id' => 'exists:contacts,id',
            'user_id' => 'exists:users,id',
            'due_date' => 'nullable|date',
            'is_done' => 'boolean'
        ]);
    }

    protected function validateUpdatedTicket(Request $request): array
    {
        return $request->validate([
            'name' => 'alpha_num|max:150',
            'description' => 'max:750',
            'type' => '',
            'contact_id' => 'exists:contacts,id',
            'user_id' => 'exists:users,id',
            'due_date' => 'nullable|date',
            'is_done' => 'boolean'
        ]);
    }
}
