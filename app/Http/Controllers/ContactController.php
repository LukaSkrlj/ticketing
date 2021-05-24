<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){

        $user = Auth::user();
        $contacts = Contact::query();
        $order = $request->query('order');
        $search = $request->query('search');
        $search_option = $request->query('search_option');

        if (!$user->hasRole('admin')){

            $contacts = $contacts->where('user_id', '=', $user->id);

        }

        if ($search){

            if(!$search_option){

                $search_option = 'first_name';

            }

            if($user->hasRole('admin') && $search_option == 'user_id'){

                $search = User::query()->where('name', 'LIKE', "%{$search}%")->pluck('id')->toArray();

                $contacts = $contacts->whereIn($search_option, $search);

            } else {

                $contacts = $contacts->where($search_option, 'LIKE', "%{$search}%");

            }

        }

        if($order){

            $contacts = $contacts->orderBy($order);

        }

        return view('contacts.index', [
            'contacts'=>$contacts->paginate(15),
        ]);
    }

    public function show(Contact $contact){

        $this->authorize('view', $contact);

        $tickets = Ticket::query()->where('contact_id', $contact->id)->get();

        return view('contacts.show', [
            'contact'=>$contact,
            'tickets'=>$tickets
        ]);
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
        $this->authorize('update', $contact);

        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact){
        $this->authorize('update', $contact);

        $contact->update($this->validateContact($request));

        return redirect($contact->path());
    }

    public function destroy(Contact $contact){
        $this->authorize('delete', $contact);
        $contact = Contact::query()->findOrFail($contact->id);
        $contact->delete();
        return redirect('/contacts')->with('success', 'Contact deleted');
    }

    protected function validateContact(Request $request): array
    {
        return $request->validate([
            'first_name' => 'required|alpha|max:30',
            'last_name' => 'required|alpha|max:30',
            'email' => 'required|email',
            'phone_number' => 'required',
            'address' => 'required',
            'user_id' => 'exists:users,id',
            'personal_identification_number'=>'required|unique'
        ]);
    }
}
