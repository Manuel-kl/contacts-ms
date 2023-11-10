<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col-reverse  w-full ">
            <div class="pt-5 items-center flex flex-col gap-5 justify-center ">
                <form action="{{route('contacts.search')}}" method="POST" class="flex flex-row gap-2 sm:gap-4 items-center justify-center sm:justify-start">
                    @csrf
                    <input type="text" class="border border-gray-300 rounded-md p-2 w-full max-w-xs sm:w-4/5 placeholder:text-sm" required placeholder="Search Contacts" id="search" name="search">
                    <button type="submit" class="bg-blue-300 text-white  p-2 rounded-md text-sm sm:text-md hover:bg-blue-400 " id="searchBtn">Search</button>
                </form>
                <h2 class="font-semibold pt-5 sm:pt-0 text-center sm:text-left text-sm sm:text-md text-gray-800 dark:text-gray-200 leading-tight">
                    Total Contacts ({{$totalCount}})
                </h2>

            </div>
            <div class="flex flex-row justify-between w-full sm:w-auto sm:relative ">
                <div>
                    <a href="{{route('contacts.create')}}"><button class="bg-blue-600 text-white  p-2 rounded-md text-sm sm:text-md hover:bg-blue-300 hover:text-black">
                            Add New
                            Contact</button></a>
                </div>
                <div>
                    <a href="{{route('contacts.trash')}}">
                        <button class="bg-red-400 w-32  text-white p-2 rounded-md text-sm sm:text-md hover:bg-red-500">View
                            Trash</button>
                    </a>
                </div>
            </div>
        </div>

    </x-slot>

    <div class="py-2 px-5 md:px-16">
        <div class="bg-white border-b text-sm sm:text-md font-bold flex flex-col sm:flex-row gap-2 sm:gap-4 p-4 rounded-sm items-center justify-center">
            <div class="md:hidden mb-2">
                <div x-data="{ open: false }">
                    <div class="flex flex-row gap-5 items-center">
                        <button @click="open = !open" class="bg-blue-500 px-3 py-1 rounded-sm text-white hover:bg-blue-400 cursor-pointer">
                            Filter
                        </button>
                        <a href="{{ route('contacts.index') }}" class="{{ request()->is('contacts*') ? 'text-blue-500 block' : 'hidden' }}">
                            All({{ $totalCount }})
                        </a>
                        @foreach ($tags as $tag)
                        <a href="{{ url('filter-contacts/'.$tag->id) }}" class="{{ request()->is('filter-contacts/'.$tag->id) ? 'text-blue-500 block' : 'hidden' }}">
                            {{ $tag->name }} ({{ $tag->count }})
                        </a>
                        @endforeach
                    </div>
                    <div x-show="open" @click.away="open = false" class="absolute mt-2 w-40 bg-white border rounded-md shadow-md">
                        <a href="{{ route('contacts.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white {{ request()->is('filter-contacts/'.$tag->id) ? 'bg-blue-600 text-white' : '' }}">
                            All({{ $totalCount }})
                        </a>
                        @foreach ($tags as $tag)
                        <a href="{{ url('filter-contacts/'.$tag->id) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-500 hover:text-white {{ request()->is('filter-contacts/'.$tag->id) ? 'bg-blue-600 text-white' : '' }}">
                            {{ $tag->name }} ({{ $tag->count }})
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <a href="{{ route('contacts.index') }}" class="hidden md:block {{ request()->is('contacts*') ? 'text-blue-600' : '' }} hover:text-blue-500 cursor-pointer">
                All({{ $totalCount }})
            </a>

            @foreach ($tags as $tag)
            <a href="{{ url('filter-contacts/'.$tag->id) }}" class="hidden md:block {{ request()->is('filter-contacts/'.$tag->id) ? 'text-blue-600' : '' }} hover:text-blue-500 cursor-pointer">
                {{ $tag->name }} ({{ $tag->count }})
            </a>
            @endforeach
        </div>

        <div class="flex  justify-center p-4 bg-white">
            @if($totalCount > 0 )
            <div class="w-full flex flex-row flex-wrap gap-5">
                @foreach ($contacts as $contact)
                <div x-data="{ redirectTo: '{{ route('contacts.show', $contact->id) }}' }" x-on:click="window.location.href = redirectTo" class="flex flex-row items-center mx-auto md:mx-0 min-w-[18rem] lg:min-w-[20rem]  gap-3 shadow-sm  shadow-slate-500 cursor-pointer p-3 rounded-md hover:bg-slate-100 hover:text-blue-800 hover:font-bold">
                    <div>
                        @if($contact->profile_photo_path == null)
                        <img class="w-12 h-12 rounded-full object-cover" src="{{asset('default.png')}}" alt="profile_pic">
                        @else
                        <img class="w-12 h-12 rounded-full object-cover" src="{{asset($contact->profile_photo_path)}}" alt="profile_pic">
                        @endif
                    </div>
                    <div class="flex flex-col gap-1 ">
                        <h3 class="text-md sm:text-lg font-bold">{{$contact->name}}</h3>
                        <p class="text-sm font-semibold">
                            {{$contact->phone_number}}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex flex-col items-center justify-center gap-5">
                <p class="text-lg font-semibold">No contacts</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>