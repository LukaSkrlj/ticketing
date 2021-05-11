<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="p-5">
                        <div class="grid grid-cols-2 gap-6">
                            <div class="grid grid-rows-3 gap-6">
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
                                <div>
                                    <h2 class="block font-medium text-sm text-gray-700">Password</h2>
                                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                                        Hiden
                                    </h2>
                                </div>
                            </div>
                        </div>

                    </div>
                    <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="inline-flex items-center px-4 py-2 bg-blue-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Edit</a>
                    <a href="{{ route('users.delete', ['user' => $user->id]) }}" class="inline-flex items-center px-4 py-2 bg-red-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Delete</a>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
