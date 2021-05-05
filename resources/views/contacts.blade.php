<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contacts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($contacts as $contact)
                        <div class="p-4 border-b border-gray-200 flex justify-between">
                            <div class="text-xl font-medium">
                                <a href="contacts/{{ $contact->id }}">{{$contact->first_name}} {{$contact->last_name}}</a>

                            </div>
                            <div>
                                <a href="contacts/{{ $contact->id }}/edit" class="flex items-end inline-flex px-4 py-2 bg-blue-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>
                                <a href="contacts/{{ $contact->id }}/delete" class="flex items-end inline-flex items-center px-4 py-2 bg-red-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Delete</a>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
