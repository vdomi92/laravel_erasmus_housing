<x-app-layout>
    <div class="card w-50 full-width-md larger-width-lg mx-auto mt-1 p-2">
        <div class="text-center">
            <h2 class="fw-bold">Create new house listing</h2>
        </div>
        <div class="card-body mt-5">
            <form action="{{ route('housings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex align-items-center justify-between flex-wrap">

                    <div class="w-50 full-width-md">
                        <label for="country" class="form-label mt-3">Country</label>
                        <select id="country" class="form-control pb-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" name="country" aria-label="country select input">
                            <option disabled>Select country</option>
                        </select>
                        <x-input-error :messages="$errors->get('country')" class="mt-2" />
                    </div>

                    <div class="w-50 full-width-md pl-1">
                        <x-input-label class="form-label mt-3" for="zip" :value="__('Zip code')" />
                        <x-text-input id="zip" class="form-control pb-1" type="text" name="zip" :value="old('zip')" required autocomplete="zip" />
                        <x-input-error :messages="$errors->get('zip')" class="mt-2" />
                    </div>

                    <div class="w-50 full-width-md pl-1">
                        <x-input-label class="form-label mt-3" for="city" :value="__('City')" />
                        <x-text-input id="city" class="form-control pb-1" type="text" name="city" :value="old('city')" required autocomplete="city" />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>

                    <div class="w-50 full-width-md pl-1">
                        <x-input-label class="form-label mt-3" for="nr_of_slots" :value="__('Available places')" />
                        <x-text-input id="nr_of_slots" class="form-control pb-1" type="number" name="nr_of_slots" :value="old('nr_of_slots')" required autocomplete="nr_of_slots" />
                        <x-input-error :messages="$errors->get('nr_of_slots')" class="mt-2" />
                    </div>

                </div>

                <div class="d-flex align-items-center justify-between flex-wrap">

                    <div class="w-75 full-width-md">
                        <x-input-label class="form-label mt-3" for="street" :value="__('Street')" />
                        <x-text-input id="street" class="form-control pb-1" type="text" name="street" :value="old('street')" required autocomplete="street" />
                        <x-input-error :messages="$errors->get('street')" class="mt-2" />
                    </div>

                    <div class="w-25 full-width-md pl-1">
                        <x-input-label class="form-label mt-3" for="house_nr" :value="__('House number')" />
                        <x-text-input id="house_nr" class="form-control pb-1" type="text" name="house_nr" :value="old('house_nr')" required autocomplete="house_nr" />
                        <x-input-error :messages="$errors->get('house_nr')" class="mt-2" />
                    </div>

                </div>

                <div>
                    <label class="form-label mt-3 block font-medium text-sm text-gray-700" for="description">{{__('Description')}}</label>
                    <textarea id="description" class="form-control pb-1" name="description" required autocomplete="description">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="d-flex flex-col">
                    <label class="form-label mt-3" for="image">{{__('Preview image')}}</label>
                    <input type="file" id="image" class="w-100 pb-1" name="image" placeholder="Upload image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary full-width-md w-25 mt-3">Create</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
@stack('get-countries')

