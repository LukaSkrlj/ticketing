<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('role:admin|user');
    }

    public function index()
    {
        $tickets = Ticket::query()->where('contact_id', '=',auth()->id())->get();
        return view('tickets.index',['tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ticket = new Ticket($this->validateTicket($request));
        $ticket->save();

        return redirect(route('tickets.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return view('tickets.show',['ticket'=>$ticket]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        return view('tickets.edit', compact('ticket'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ticket $ticket)
    {
        $ticket->update($this->validateTicket($request));

        return redirect($ticket->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::query()->findOrFail($id);
        $ticket->delete();
        return redirect('/tickets')->with('success', 'Ticket deleted');
    }

    protected function validateTicket(Request $request): array
    {
        return $request->validate([
            'description' => 'required',
            'contact_id' => 'exists:contacts,id'
        ]);
    }
}
