<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-md sm:text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Deleted Contacts
        </h2>
        <div>
            <a href="{{route('contacts.create')}}"><button
                    class="bg-blue-600 text-white  p-2 rounded-md text-sm sm:text-md hover:bg-blue-300 hover:text-black">
                    Add New
                    Contact</button></a>
        </div>
    </x-slot>

    <div class="py-2 px-3 lg:px-16">
        <div class="flex flex-col  justify-center p-4 bg-white">
            @if($totalThrashContacts > 0)
            <h4 class="flex items-center justify-center text-sm sm:text-lg py-2 uppercase shadow-md mb-4 font-bold">
                Select any
                contact
                to
                restore</h4>
            <div class="w-full flex flex-row flex-wrap gap-5">
                @foreach ($contacts as $contact)
                <div x-data="{showModal :false}"
                    class="flex flex-col min-w-[18rem]   shadow-sm  shadow-slate-500 cursor-pointer p-3 mx-auto sm:mx-0  rounded-md hover:bg-slate-100 hover:text-blue-800 hover:font-bold">
                    <div @click="showModal =true" class="flex flex-row items-center gap-3">
                        <div>
                            @if($contact->profile_photo_path == null)
                            <img class="w-12 h-12 rounded-full object-cover"
                                src="{{asset('storage/contacts/photos/default.png')}}" alt="profile_pic">
                            @else
                            <img class="w-12 h-12 rounded-full object-cover"
                                src="{{asset($contact->profile_photo_path)}}" alt="profile_pic">
                            @endif
                        </div>
                        <div class="flex flex-col gap-1 ">
                            <h3 class="text-md sm:text-lg font-bold">{{$contact->name}}</h3>
                            <p class="text-sm font-semibold">
                                {{$contact->phone_number}}
                            </p>
                        </div>
                    </div>
                    <div x-show="showModal" class="flex justify-end items-end">
                        <div x-show="showModal" class="flex justify-end items-end">
                            <div x-show="showModal" class="flex justify-end items-end">
                                <div x-show="showModal" class="flex justify-end items-end">
                                    <form action="{{ route('contacts.restore',  $contact->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-400 text-white text-lg px-3 py-1 rounded-sm hover:bg-green-600">Restore</button>
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>
                </div>

                @endforeach
            </div>
            @else
            <div class="flex flex-col items-center justify-center gap-5">
                <p class="text-lg font-semibold">No deleted contacts</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>