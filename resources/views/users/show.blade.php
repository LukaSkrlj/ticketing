<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="bg-white border-b border-gray-200">
                    <div class="p-10">
                        <div class="grid lg:grid-cols-4 sm:grid-cols-3">
                            <div class="grid grid-rows-2 pb-11">
                               <img class="w-44 h-44 row-span-2 border-4 border-gray-300 rounded" src="{{ asset('images\\' . ($user->image_path ?? 'default_img.png'))  }}" alt="">
                            </div>
                            <div class="grid grid-rows-2 col-span-3 gap-0 py-5">
                                <div>
                                    <h2 class="block font-medium text-sm text-gray-700">Name</h2>
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                        {{ $user->name }}
                                    </h2>
                                </div>
                                <div>
                                    <h2 class="block font-medium text-sm text-gray-700">Email</h2>
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                        {{ $user->email }}
                                    </h2>
                                </div>
                            </div>
                        </div>
                        <div>
                            <form action="{{ route('users.destroy',  $user->id ) }}" class="flex items-end" onsubmit="return confirm('Are you sure?')" method="POST">
                                <a href="{{route('users.edit', ['user' => $user->id]) }}" class="flex items-end inline-flex mr-2 px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>

                                @role('admin')
                                @csrf
                                @method('DELETE')
                                    <button class="flex items-end px-4 py-2 bg-gray-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit">Delete</button>
                                @endrole

                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
