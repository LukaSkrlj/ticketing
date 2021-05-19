<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $tickets = Ticket::query();
        $order = $request->query('order');
        $search = $request->query('search');
        $search_option = $request->query('search_option');

        if (!$user->hasRole('admin')){

            $tickets = $tickets->where('user_id', '=', $user->id);

        }

        if ($search){

            if(!$search_option){

                $search_option = 'name';

            }

            if($user->hasRole('admin') && $search_option == 'user_id'){

                $search = User::query()->where('name', 'LIKE', "%{$search}%")->pluck('id')->toArray();

                $tickets = $tickets->whereIn($search_option, $search);

            } else {

                $tickets = $tickets->where($search_option, 'LIKE', "%{$search}%");

            }

        }

        if($order){

            $tickets = $tickets->orderBy($order);

        }
        return view('tickets.index',['tickets' => $tickets->paginate(15)]);
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
        return view('tickets.create', [
            'users'=>$users,
            'contacts'=>$contacts,
            ]);
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
        $users = User::all();
        $contacts = Contact::all();
        return view('tickets.edit',[
            'ticket'=>$ticket,
            'users'=>$users,
            'contacts'=>$contacts,
        ]);
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
            'name' => 'required',
            'description' => 'required',
            'type' => 'required',
            'contact_id' => 'exists:contacts,id',
            'user_id' => 'exists:users,id'
        ]);
    }
}
