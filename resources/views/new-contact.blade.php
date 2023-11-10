<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('New Contact') }}
        </h2>
    </x-slot>
    <div class=" flex  justify-center items-center p-6 ">
        <form action="{{route('contacts.store')}} " method="POST" enctype="multipart/form-data" class="  flex flex-col  p-5 gap-y-5 bg-white w-full sm:w-4/5 max-w-xs  sm:max-w-lg rounded-sm">
            @csrf
            <div class="flex flex-col gap-1  ">
                <label for="name" class="text-lg font-normal">Name</label>
                <input type="text" name="name" placeholder="Name" id="name" required value="{{old('name')}}" class="border border-gray-300 rounded-md p-2 w-full sm:w-4/5 placeholder:text-sm">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="flex flex-col gap-1 ">
                <label for="phone_number" class="text-lg font-normal">Phone</label>
                <input type="number" name="phone_number" placeholder="phone number" id="phone_number" required value="{{old('phone_number')}}" class="border border-gray-300 rounded-md p-2 w-full sm:w-4/5 placeholder:text-sm">
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>
            <div class="flex flex-col gap-1 ">
                <label for="photo" class="text-lg font-normal">Photo</label>
                <input type="file" accept="image/*" name="photo" placeholder="Photo" id="photo" value="{{old('photo')}}" class="border border-gray-300 rounded-md p-2 w-full sm:w-4/5 placeholder:text-sm">
                <x-input-error :messages="$errors->get('photo')" class="mt-2" />
            </div>

            <div class="flex flex-col gap-1 ">
                <label for="category" class="text-lg font-normal">Category</label>
                <select name="category" id="category" required value="{{old('category')}}" class="border border-gray-300 rounded-md p-2 w-full sm:w-4/5 placeholder:text-sm">
                    <option value="Family">Family</option>
                    <option value="Friends">Friends</option>
                    <option value="Work">Work</option>
                    <option value="School">School</option>
                    <option value="Church">Church</option>
                    <option value="Business">Business</option>
                    <option value="Others">Others</option>
                </select>

                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>
            <div class="flex flex-col gap-1 ">
                <button type="submit" class="bg-blue-600 w-fit  text-white  py-2 px-4 rounded-md text-md hover:bg-blue-300 hover:text-black">
                    Submit</button>
            </div>
        </form>
    </div>
</x-app-layout>