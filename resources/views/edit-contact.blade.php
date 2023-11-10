<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Contact') }}
        </h2>
    </x-slot>
    <div class=" flex  justify-center items-center p-6  ">
        <form action="{{route('contacts.update', $contact->id)}} " method="POST" enctype="multipart/form-data"
            class="  flex flex-col  p-5 gap-y-5 bg-white w-full sm:w-4/5 max-w-xs  sm:max-w-lg rounded-sm">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-1  ">
                <label for="name" class="text-lg font-normal">Name</label>
                <input type="text" name="name" placeholder="Name" id="name" required value="{{$contact->name}}"
                    class="border border-gray-300 rounded-md p-2 w-full sm:w-4/5 placeholder:text-sm">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="flex flex-col gap-1 ">
                <label for="phone_number" class="text-lg font-normal">Phone</label>
                <input type="number" name="phone_number" placeholder="phone number" id="phone_number" required
                    value="{{$contact->phone_number}}"
                    class="border border-gray-300 rounded-md p-2 w-full sm:w-4/5 placeholder:text-sm">
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>
            <div class="flex flex-col gap-1 ">
                <label for="photo" class="text-lg font-normal">Change photo</label>
                <input type="file" accept="image/*" name="photo" placeholder="Photo" id="photo"
                    value="{{$contact->profile_photo_path}}"
                    class="border border-gray-300 rounded-md p-2 w-full sm:w-4/5 placeholder:text-sm">
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            </div>
            @if($contact->profile_photo_path != null)
            <div>
                <p>Current Photo</p>
                <img class="w-20 h-20 rounded-full object-cover" src="{{asset($contact->profile_photo_path)}}"
                    alt="profile_pic">
            </div>
            @else
            <p>No current photo</p>
            @endif

            <div class="flex flex-col gap-1 ">
                <label for="category" class="text-lg font-normal">Category</label>
                <select name="category" id="category" required
                    class="border border-gray-300 rounded-md p-2 w-full sm:w-4/5 placeholder:text-sm">
                    <option value="Family" @if($contact['tag']->name == 'Family') selected @endif>Family</option>
                    <option value="Friends" @if($contact['tag']->name == 'Friends') selected @endif>Friends</option>
                    <option value="Work" @if($contact['tag']->name == 'Work') selected @endif>Work</option>
                    <option value="School" @if($contact['tag']->name == 'School') selected @endif>School</option>
                    <option value="Church" @if($contact['tag']->name == 'Church') selected @endif>Church</option>
                    <option value="Business" @if($contact['tag']->name == 'Business') selected @endif>Business</option>
                    <option value="Others" @if($contact['tag']->name == 'Others') selected @endif>Others</option>
                </select>


                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>
            <!-- submit -->
            <div class="flex flex-col gap-1 ">
                <button type="submit"
                    class="bg-blue-600 w-fit  text-white  py-2 px-4 rounded-md text-md hover:bg-blue-300 hover:text-black">
                    Update</button>
            </div>
        </form>
    </div>
</x-app-layout>