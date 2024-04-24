<x-app-layout>
    <div class="card w-50 full-width-md mx-auto mt-1 p-2">
        <div class="text-center">
            <h2 class="fw-bold">Create new house listing</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('housings.store') }}" method="POST">
                @csrf

                <div class="mt-4">
                    <label for="country" class="form-label">Country</label>
                    <select id="country" class="form-select" name="country" aria-label="country select input">
                        <option selected>Select country</option>
                    </select>
                    <x-input-error :messages="$errors->get('country')" class="mt-2" />
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
@stack('get-countries')

