<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Tickets') }}
                </h2>
            </div>
            <div>
                <a href="{{route('tickets.create')}}" class="flex items-end inline-flex px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">New ticket</a>
            </div>
        </div>
    </x-slot>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-5 gap-6">
                        @foreach($tickets as $ticket)

                            <div class="flex flex-col md:flex-col md:max-w-4xl max-w-sm mx-auto bg-white border border-green-900 my-5 shadow-2xl rounded-lg">
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
                        @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>

</x-app-layout>
