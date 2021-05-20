<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Users') }}
                </h2>
            </div>
            <div>
                <a href="{{route('users.create')}}" class="flex items-end inline-flex px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">New user</a>
            </div>
        </div>


    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="w-auto bg-transparent p-2 rounded-lg border-2 border-gray-600 bg-gray-100">
                        <form class="input-group flex justify-between" action="{{ route('tickets.index') }}" method="GET">
                            <div class="flex justify-content-end">
                                <h2 class="block font-medium text-lg py-0.5 mr-2 ml-1 text-gray-700">Search: </h2>
                                <input type="text" name="search" placeholder="Search" class="form-control h-8 w-52 rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="flex justify-content-end">
                                <h2 class="block font-medium text-lg py-0.5 mx-2 text-gray-700">Search by: </h2>
                                <select class="py-0 px-2 w-40 h-8 form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 text-gray-600 text-left focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="search_option">
                                    <option value="name">Name</option>
                                    <option value="email">Email</option>
                                </select>
                            </div>

                            <div class="flex justify-content-end">
                                <h2 class="block font-medium text-lg py-0.5 mx-2 text-gray-700">Order by: </h2>
                                <select class="py-0 px-2 w-40 h-8 form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 text-gray-600 text-left focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="order">
                                    <option value="name">Name</option>
                                    <option value="email">Email</option>
                                </select>
                            </div>

                            <button type="submit" class="bg-transparent h-6 w-8 border-gray-600">
                                <svg class="h-6 w-8 left-0 my-1 stroke-current text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z">
                                    </path>
                                </svg>
                            </button>

                        </form>
                    </div>
                    @foreach($users as $user)
                        <div class="p-4 border-b border-gray-200 flex justify-between">
                            <div class="text-xl font-medium">
                                <a href="{{ route('users.show', ['user'=>$user]) }}">{{$user->name}}</a>

                            </div>
                            <div>
                                <form action="{{ route('users.destroy',  $user->id ) }}" class="flex items-end px-2 pt-1" onsubmit="return confirm('Are you sure?')" method="POST">
                                    <a href="{{route('users.edit', ['user' => $user->id]) }}" class="flex items-end inline-flex mr-2 px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>

                                    @csrf
                                    @method('DELETE')
                                    <button class="flex items-end px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">Delete</button>

                                </form>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-4 mx-4">
                        {{ $users->onEachSide(2)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
