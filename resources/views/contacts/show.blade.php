@extends('layout')

@section('contact')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="p-5">
                    <div class="grid grid-cols-2 gap-6">
                        <div class="grid grid-rows-3 gap-6">
                            <div>
                                <h2 class="block font-medium text-sm text-gray-700">First name</h2>
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ $contact->first_name }}
                                </h2>
                            </div>
                            <div>
                                <h2 class="block font-medium text-sm text-gray-700">Email</h2>
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ $contact->email }}
                                </h2>
                            </div>
                            <div>
                                <h2 class="block font-medium text-sm text-gray-700">Address</h2>
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ $contact->address }}
                                </h2>
                            </div>
                        </div>
                        <div class="grid grid-rows-3 gap-6">
                            <div>
                                <h2 class="block font-medium text-sm text-gray-700">Last name</h2>
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{$contact->last_name}}
                                </h2>
                            </div>
                            <div>
                                <h2 class="block font-medium text-sm text-gray-700">Phone number</h2>
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ $contact->phone_number }}
                                </h2>
                            </div>
                            <div>
                                <h2 class="block font-medium text-sm text-gray-700">PID</h2>
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                    {{ $contact->personal_identification_number }}
                                </h2>
                            </div>
                        </div>
                        @role('admin')
                        <div>
                            <h2 class="block font-medium text-sm text-gray-700">Assigned user</h2>
                            <a href="{{ route('users.show', ['user' => $contact->user()->first() ? $contact->user()->first()->id : 1]) }}">
                                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $contact->user()->first()->name }}
                            </h2>
                            </a>
                        </div>
                        @endrole
                    </div>
                </div>

                <form action="{{ route('contacts.destroy',  $contact->id ) }}" class="flex items-end px-2 pt-1" onsubmit="return confirm('Are you sure?')" method="POST">
                    <a href="{{route('contacts.edit', ['contact' => $contact->id]) }}" class="flex items-end inline-flex mr-2 px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>

                    @csrf
                    @method('DELETE')
                    <button class="flex items-end px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">Delete</button>

                </form>

            </div>
        </div>
        <div class="grid grid-cols-5 gap-6">
            @foreach($tickets as $ticket)
                <a href="{{route('tickets.show', ['ticket'=>$ticket])}}">
                    <div class="mx-8 flex flex-col md:flex-col md:max-w-4xl max-w-sm mx-auto bg-white border border-green-900 my-5 shadow-2xl rounded-lg hover:opacity-70">

                        <div class="p-4 md:w-1/2">
                            <h2 class="block font-medium text-sm text-gray-700">Name</h2>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $ticket->name }}
                            </h2>
                        </div>

                        <div class="p-4 md:w-1/2">
                            <h2 class="block font-medium text-sm text-gray-700">Type</h2>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $ticket->type }}
                            </h2>
                        </div>

                        <div class="p-4">
                            <h2 class="block font-medium text-sm text-gray-700">Assigned user</h2>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $ticket->user()->first()->name }}
                            </h2>
                        </div>
                        <div class="p-4 md:w-1/2">
                            <h2 class="block font-medium text-sm text-gray-700">Contact</h2>
                            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                {{ $ticket->contact()->first()->first_name }}
                                {{ $ticket->contact()->first()->last_name }}
                            </h2>
                        </div>

                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
@endsection
