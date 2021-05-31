<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create user') }}
        </h2>
    </x-slot>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm md:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf

                            <!-- Name -->
                            <div>
                                <x-label for="name" :value="__('Name')" />

                                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            </div>

                            <!-- Email Address -->
                            <div class="mt-4">
                                <x-label for="email" :value="__('Email')" />

                                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            </div>



                            <!-- Password -->
                            <div class="mt-4">
                                <x-label for="password" :value="__('Password')" />

                                <x-input id="password" class="block mt-1 w-full"
                                         type="password"
                                         name="password"
                                         required autocomplete="new-password" />
                            </div>

                            <!-- Confirm Password -->
                            <div class="mt-4">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                                <x-input id="password_confirmation" class="block mt-1 w-full"
                                         type="password"
                                         name="password_confirmation" required />
                            </div>

                            <!-- Image -->
                            <div class="mt-4">
                                <x-label for="image" :value="__('Image')" />
                                <div class="bg-grey-lighter">
                                    <label class="w-64 flex flex-col items-center px-4 py-6 bg-white text-gray-600 rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-gray-600 hover:text-white">
                                        <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                        </svg>
                                        <span class="mt-2 text-base leading-normal">Select a file</span>
                                        <input id="image" name="image" type="file" class="hidden" />
                                    </label>
                                </div>

                            </div>

                            <!-- Roles -->
                            <div class="block mt-4">
                                @foreach($roles as $role)
                                    <div class="form-check">

                                        <input id="{{$role->name}}" type="checkbox" value="{{$role->id}}" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="roles[]">
                                        <label for="{{$role->name}}" class="inline-flex items-center block font-medium text-sm text-gray-700">
                                            Give <strong> {!! "&nbsp;" !!}{!! $role->name !!}{!! "&nbsp;" !!} </strong> privileges
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <x-button class="ml-3">
                                    {{ __('Save') }}
                                </x-button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
