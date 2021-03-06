<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create tickets') }}
            </h2>
        </div>
    </x-slot>
    <div class="container mx-auto">
        <div class="block">
            <div class="flex flex-col md:flex-col md:max-w-4xl max-w-sm mx-auto bg-white border border-green-900 my-5 shadow-2xl rounded-lg">
                <x-auth-validation-errors class="pl-8 pt-8" :errors="$errors" />
                <form method="POST" action="{{ route('tickets.store') }}" class="p-3">
                    @csrf
                    <div class="p-5 md:w-1/2">
                        <h2 class="block font-medium text-sm text-gray-700">Name</h2>
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus />
                    </div>

                    <div class="p-5 md:w-1/2">
                        <div class="form-group">
                            <h2 class="block font-medium text-sm text-gray-700">Type</h2>
                            <select class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="ticket_type_id">
                                @foreach($types as $type)
                                    <option value="{{$type->id}}">{{$type->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="p-5 md:w-1/2">
                        <h2 class="block font-medium text-sm text-gray-700">Description</h2>
                        <textarea id="description" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="description" :value="old('name')" autofocus /></textarea>
                    </div>

                    <div class="p-5 md:w-1/2">
                        <div class="form-group">
                            <h2 class="block font-medium text-sm text-gray-700">Contacts name</h2>
                            <select class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="contact_id">
                                @foreach($contacts as $contact)
                                    <option value="{{$contact->id}}">{{$contact->first_name}} {{$contact->last_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @role('admin')
                    <div class="p-5 md:w-1/2">
                        <div class="form-group">
                            <h2 class="block font-medium text-sm text-gray-700">Users name</h2>
                            <select class="form-control rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="user_id">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endrole

                    <div class="flex items-center justify-end mt-4 p-5">
                        <x-button class="ml-3">
                            {{ __('Save changes') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
