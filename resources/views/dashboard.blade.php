<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="grid grid-cols-3">
        <div class="py-12 col-span-2">
            <div class="ml-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-3 gap-6">
                        @forelse($tickets as $ticket)
                            @php
                                //if ticket is due tomorrow change color
                                    if (!$ticket->due_date)
                                    {
                                        $color = "white";
                                    }elseif ($ticket->due_date < \Carbon\Carbon::today()){
                                        $color = "red-400";
                                    }elseif ($ticket->due_date < \Carbon\Carbon::tomorrow()){
                                        $color = "yellow-500";
                                    }else{
                                        $color = "green-300";
                                    }
                            @endphp
                            <a href="{{route('tickets.show', ['ticket'=>$ticket])}}">
                                <div class="mx-8 flex flex-col md:flex-col md:max-w-4xl max-w-sm mx-auto bg-{{ $color }} border border-green-900 my-5 shadow-2xl rounded-lg transform hover:-translate-y-3 hover:bg-opacity-80">

                                    <div class="p-4 md:w-1/2">
                                        <h2 class="block font-medium text-sm text-gray-700">Name</h2>
                                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                            {{ $ticket->name }}
                                        </h2>
                                    </div>

                                    <div class="p-4 md:w-1/2">
                                        <h2 class="block font-medium text-sm text-gray-700">Type</h2>
                                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                            {{ $ticket->type()->first()->name }}
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
                        @empty
                            No tickets due tomorrow!
                        @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="mr-8 max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h2 class="pb-5 font-semibold text-xl text-gray-800 leading-tight underline">
                            Status:
                        </h2>
                        <div class="p-3 bg-gray-100 overflow-hidden sm:rounded-lg">
                            <h2 class="block font-medium text-sm text-gray-700">Number of your tickets:</h2>
                            <h2 class="pt-1 font-semibold text-xl text-gray-800 leading-tight text-center">
                                {{ $ticket_count }}
                            </h2>
                        </div>
                        <div class="mt-3 p-3 bg-gray-100 overflow-hidden sm:rounded-lg">
                            <h2 class="block font-medium text-sm text-gray-700">Tickets due tomorrow:</h2>
                            <h2 class="pt-1 font-semibold text-xl text-gray-800 leading-tight text-center">
                                {{ $daily_ticket_count }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
