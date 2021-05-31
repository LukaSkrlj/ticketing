
<div>
    <div class="grid xl:grid-cols-{{$display}} md:grid-cols-{{$display-1}} sm:grid-cols-{{$display-2}} gap-6">
        @forelse($tickets as $ticket)

            @php
                //if ticket is due tomorrow change color
                if ($ticket->is_done) {
                    $color = "blue-100";
                    $border_color = "blue-900";
                }elseif ($ticket->due_date < \Carbon\Carbon::now(new DateTimeZone('Europe/Zagreb'))){
                    $color = "red-100";
                    $border_color = "red-900";
                }elseif ($ticket->due_date < \Carbon\Carbon::tomorrow()){
                    $color = "yellow-100";
                    $border_color = "yellow-900";
                }else{
                    $color = "green-100";
                    $border_color = "green-900";
                }
            @endphp

            <a href="{{route('tickets.show', ['ticket'=>$ticket])}}">
                <div class="mx-8 flex flex-col md:flex-col md:max-w-4xl max-w-sm mx-auto bg-{{ $color }} border border-{{ $border_color }} my-5 shadow-2xl rounded-lg transform hover:-translate-y-3 hover:bg-opacity-80">

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

                    <div class="p-4 md:w-1/2">
                        <h2 class="block font-medium text-sm text-gray-700">Contact</h2>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $ticket->contact()->first()->first_name }}
                            {{ $ticket->contact()->first()->last_name }}
                        </h2>
                    </div>

                    @role('admin')
                    <div class="p-4">
                        <h2 class="block font-medium text-sm text-gray-700">Assigned user</h2>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ $ticket->user()->first()->name }}
                        </h2>
                    </div>
                    @endrole

                </div>
            </a>

        @empty

            <div class="pt-8">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    No tickets found!
                </div>
            </div>

        @endforelse
    </div>
</div>
