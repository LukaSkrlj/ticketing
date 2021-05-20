<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Ticket') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
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
                    <div class="p-4 md:w-1/2">
                        <h2 class="block font-medium text-sm text-gray-700">Description</h2>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $ticket->description }}
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
                    <form action="{{ route('tickets.destroy',  $ticket->id ) }}" class="flex items-end px-2 pt-1" onsubmit="return confirm('Are you sure?')" method="POST">
                        <a href="{{route('tickets.edit', ['ticket' => $ticket->id]) }}" class="flex items-end inline-flex mr-2 px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>

                        @csrf
                        @method('DELETE')
                        <button class="flex items-end px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">Delete</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
