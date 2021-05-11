<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('role:admin|user');
    }
    public function index(){
        $contacts = Contact::query()->where('user_id', '=',auth()->id())->get();

        return view('contacts.index', ['contacts'=>$contacts]);
    }

    public function show(Contact $contact){
        return view('contacts.show',['contact'=>$contact]);
    }

    public function create(){
        return view('contacts.create');
    }

    public function store(Request $request){


        $contact = new Contact($this->validateContact($request));
        $contact->user_id = auth()->id();
        $contact->save();

        return redirect(route('contacts.index'));

    }

    public function edit(Contact $contact){
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact){
        $contact->update($this->validateContact($request));

        return redirect($contact->path());
    }

    public function destroy($id){
        $contact = Contact::query()->findOrFail($id);
        $contact->delete();
        return redirect('/contacts')->with('success', 'Contact deleted');
    }

    protected function validateContact(Request $request): array
    {
        return $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'user_id' => 'exists:users,id'
        ]);
    }
}
