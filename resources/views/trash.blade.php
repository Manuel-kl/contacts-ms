<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Deleted Contacts
        </h2>
        <div>
            <a href="{{route('contacts.create')}}"><button class="bg-blue-600 text-white  p-2 rounded-md text-md hover:bg-blue-300 hover:text-black">
                    Add New
                    Contact</button></a>
        </div>
    </x-slot>

    <div class="py-2 px-16">
        <div class="flex  justify-center p-4 bg-white">
            <div class="w-full flex flex-row flex-wrap gap-5">
                @foreach ($contacts as $contact)
                <div class="flex flex-row items-center min-w-[20rem]  gap-3 shadow-sm  shadow-slate-500 cursor-pointer p-3 rounded-md hover:bg-slate-100 hover:text-blue-800 hover:font-bold">
                    <div>
                        @if($contact->profile_photo_path == null)
                        <img class="w-12 h-12 rounded-full object-cover" src="{{asset('storage/contacts/photos/default.png')}}" alt="profile_pic">
                        @else
                        <img class="w-12 h-12 rounded-full object-cover" src="{{asset($contact->profile_photo_path)}}" alt="profile_pic">
                        @endif
                    </div>
                    <div class="flex flex-col gap-1 ">
                        <h3 class="text-lg font-bold">{{$contact->name}}</h3>
                        <p class="text-sm font-semibold">
                            {{$contact->phone_number}}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>