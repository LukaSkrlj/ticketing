<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Illuminate\Http\Request;


class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $contacts = Contact::query();
        $order = $request->query('order');
        $search = $request->query('search');
        $search_option = $request->query('search_option');
        $descending_order = $request->query('descending_order');

        if (!$user->hasRole('admin')) {

            $contacts = $contacts->where('user_id', '=', $user->id);

        }

        if ($search) {

            if (!$search_option) {

                $search_option = 'first_name';

            }

            if ($user->hasRole('admin') && $search_option == 'user_id') {

                $search = User::query()->where('name', 'LIKE', "%{$search}%")->pluck('id')->toArray();

                $contacts = $contacts->whereIn($search_option, $search);

            } else {

                $contacts = $contacts->where($search_option, 'LIKE', "%{$search}%");

            }

        }

        if ($order) {

            $contacts = $descending_order ? $contacts->orderByDesc($order) : $contacts->orderBy($order);

        }

        return view('contacts.index', [
            'contacts' => $contacts->paginate(15)->withQueryString(),
        ]);
    }

    public function show(Contact $contact)
    {

        $this->authorize('view', $contact);

        $tickets = Ticket::query()->where('contact_id', $contact->id)->get();

        return view('contacts.show', [
            'contact' => $contact,
            'tickets' => $tickets
        ]);
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function store(ContactRequest $request)
    {
        $validated_request = $request->validated();

        if (!Arr::exists($validated_request,'user_id')){
            $validated_request['user_id'] = Auth::user()->id;
        }

        Contact::query()->create($validated_request);

        return redirect(route('contacts.index'));

    }

    public function edit(Contact $contact)
    {
        $this->authorize('update', $contact);

        return view('contacts.edit', compact('contact'));
    }

    public function update(ContactRequest $request, Contact $contact)
    {
        $this->authorize('update', $contact);

        $contact->update($request->validated());

        return redirect($contact->path());
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);
        $contact = Contact::query()->findOrFail($contact->id);
        $contact->delete();
        return redirect('/contacts')->with('success', 'Contact deleted');
    }
}
