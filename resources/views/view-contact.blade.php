<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('View Contact') }}
        </h2>
    </x-slot>
    <div class="py-3 px-16 flex flex-col items-center justify-center w-full   rounded-md">
        <div class="w-1/2 min-w-[25rem] bg-white shadow-md rounded-sm py-5">
            <div class=" mx-auto  ">
                <div class="flex justify-center items-center ">
                    @if($contact->profile_photo_path == null)
                    <img class="w-12 h-12 rounded-full object-cover"
                        src="{{asset('storage/contacts/photos/default.png')}}" alt="profile_pic">
                    @else
                    <img class="w-20 h-20 rounded-full object-cover" src="{{asset($contact->profile_photo_path)}}"
                        alt="profile_pic">
                    @endif
                </div>
                <div class="flex flex-col items-center justify-center pb-5">
                    <h2 class="text-xl font-medium text-gray-800 dark:text-white mt-4">
                        {{$contact->name}}
                    </h2>
                    <p class="text-sm text-gray-500 dark:text-gray-300 mt-2">
                        {{$contact->phone_number}}
                    </p>
                    <p class="text-sm text-gray-400 dark:text-gray-300 mt-2">
                        {{$contact['tag']->name}}
                    </p>
                    <div class="pt-2">
                        <p class="text-sm">Created at: {{$contact->created_at}}</p>
                    </div>
                </div>
            </div>
            <div x-data="{ showModal: false }" class="flex flex-row justify-center items-center  gap-7">
                <div>
                    <button x-show="!showModal" @click="showModal = true"
                        class="px-5 py-2 w-24 bg-red-500 text-white rounded-md hover:bg-red-900">
                        Delete
                    </button>
                    <div x-show="showModal" x-cloak class="gap-7 flex flex-row">
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="px-5 py-2 bg-red-500 text-white rounded-md hover:bg-red-900">
                                Confirm Delete
                            </button>
                        </form>
                        <button @click="showModal = false"
                            class="px-5 py-2  bg-gray-300 text-white rounded-md hover:bg-gray-400">
                            Cancel
                        </button>
                    </div>
                </div>

                <div x-show="!showModal">
                    <a href="{{route('contacts.edit', $contact->id)}}">
                        <button
                            class="px-5 py-2 w-24 bg-green-500 text-white rounded-md hover:bg-green-900">Edit</button>

                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
    [x-cloak] {
        display: none;
    }
    </style>
</x-app-layout>