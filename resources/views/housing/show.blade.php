@props(['housing' => '\App\Models\Housing', 'user'])

<x-app-layout>

    <div class="card w-50 full-width-md mx-auto mt-1 p-2">
        <div class="card-body d-flex flex-col flex-wrap">
            <img src="..." class="card-img-top col-md-6 img-thumbnail ratio ratio-16x9 w-100 mx-auto" alt="TODO">
            <div class="d-flex flex-col">
                <div class="pl-2 pt-3 mb-2">
                    <h5 class="fw-bold ">{{ $housing->country }}</h5>
                    <p class="mb-1">{{ $housing->zip }} {{ $housing->city }} {{ $housing->street }} {{ $housing->house_nr  }}</p>
                </div>
                <div class="pl-2 pt-2 mb-1">
                    <p class="mb-1">Provider: {{ $housing->owner->name }} ( {{$housing->owner->age}} )</p>
                    <p class="mb-1">Total places: {{ $housing->nr_of_slots }}</p>
                    <p class="mb-1">Places remaining: {{ $housing->accepted_count }}</p>
                    <p class="mb-1">{{ $housing->description }}</p>
                </div>
                <div class="pb-1 d-flex flex-wrap justify-center mt-auto gap-3">
                    <a href="{{route('applications.create', $housing->id)}}" class="btn btn-primary w-40 full-width-md">Apply</a>
                    {{--    TODO: change route to message.create, $housing->owner->id              --}}
                    <a href="{{route('housings.list')}}" class="btn btn-primary w-40 full-width-md">Send a message</a>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
