<?php

namespace App\Http\Traits;

use App\Models\Contact;
use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

trait SearchTrait{

    public function search(Request $request){

        $user = Auth::user();
        $tickets = Ticket::query();

        $completed = $request->query('completed'); //$where(ticket, completed)
        $order = $request->query('order');
        $search = $request->query('search');
        $search_option = $request->query('search_option');
        $descending_order = $request->query('descending_order');
        $search_options_array = Schema::getColumnListing($tickets->first()->getTable());
        $query = false;

        if (!$user->hasRole('admin')) {

            $tickets = $tickets->where('user_id', $user->id);

        }

        if ($search) {

            if (!in_array($search_option, $search_options_array)) {

                $search_option = 'name';

            }

            switch ($search_option) {
                case 'contact_id':
                    $query = Contact::all();
                    break;
                case 'type':
                    $query = TicketType::all();
                    break;
                case 'user_id':
                    $query = User::all();
                    break;
                default:
                    $tickets = $tickets->where($search_option, 'LIKE', "%{$search}%");
            }

            if ($query){

                $search_ids = $query
                    ->filter(function ($object) use ($search) {
                        return stripos($object->name, $search) !== false;
                    })->pluck('id'); //->where('name', 'LIKE', "%{$search}%")->pluck('id');

                $tickets = $tickets->whereIn($search_option, $search_ids);

            }

        }

        if (in_array($order, $search_options_array)) { //provjeri unutar requesta inarray

            $tickets = $descending_order ? $tickets->orderByDesc($order) : $tickets->orderBy($order);

        }

        return $tickets->where('is_done', '=', $completed);
    }
}
