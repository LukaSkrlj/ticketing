@extends('layout')

@section('contact')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="/dashboard/contacts/{{ $contact->id }}">
                        @method('PUT')
                        @csrf
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-3 gap-6">
                                <div>
                                    <h2 class="block font-medium text-sm text-gray-700">Ime</h2>
                                    <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" value="{{ $contact->first_name }}" autofocus />
                                </div>
                                <div>
                                    <h2 class="block font-medium text-sm text-gray-700">Email</h2>
                                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $contact->email }}" autofocus />
                                </div>
                                <div>
                                    <h2 class="block font-medium text-sm text-gray-700">Adresa</h2>
                                    <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ $contact->address }}" autofocus />
                                </div>
                            </div>
                            <div class="grid grid-rows-3 gap-6">
                                <div>
                                    <h2 class="block font-medium text-sm text-gray-700">Prezime</h2>
                                    <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" value="{{ $contact->last_name }}" autofocus />
                                </div>
                                <div>
                                    <h2 class="block font-medium text-sm text-gray-700">Phone number</h2>
                                    <x-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" value="{{ $contact->phone_number }}" autofocus />
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-3">
                                {{ __('Spremi promjene') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
