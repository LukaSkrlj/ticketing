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
                        </div>
                    </div>

                </div>
                <a href="{{route('contacts.edit', ['contact' => $contact->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>
                <a href="{{route('contacts.delete', ['contact' => $contact->id]) }}" class="inline-flex items-center px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Delete</a>

            </div>
        </div>
    </div>
</div>
@endsection
