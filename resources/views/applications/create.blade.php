

<x-app-layout>
    <div class="card w-50 full-width-md mx-auto mt-1 p-2">
        <div class="text-center">
            <h2 class="fw-bold">Apply for housing</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('applications.store') }}" method="POST">
                @csrf
                <input type="hidden" name="housing_id" value="{{ $id }}">

                <div class="mt-4">
                    <label for="duration" class="form-label">Duration in months</label>
                    <input id="duration" class="form-control" type="number" name="duration" value="{{old('duration')}}">
                    <x-input-error :messages="$errors->get('duration')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="message" class="form-label">Message</label>
                    <textarea id="message" class="form-control" name="message" rows="3">{{old('message')}}</textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                </div>
                <button type="submit" class="btn btn-primary mt-4">Apply</button>
            </form>
        </div>
    </div>
</x-app-layout>
