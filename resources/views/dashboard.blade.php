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
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight underline">
                            Start with these:
                        </h2>
                        <x-ticket-layout :tickets="$tickets" display="3"/>
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
                        <div class="mt-3 p-3 bg-gray-100 overflow-hidden sm:rounded-lg">
                            <h2 class="block font-medium text-sm text-gray-700">Total contacts:</h2>
                            <h2 class="pt-1 font-semibold text-xl text-gray-800 leading-tight text-center">
                                {{ $contact_count }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
