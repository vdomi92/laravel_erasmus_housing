@props(['housings'])

<x-app-layout>
    <div class="card w-75 mx-auto mt-4">
        <div class="card-body">
            <h1 class="text-center mb-3 fw-bold text-decoration-underline fs-1">House listings</h1>
            <hr class="mb-3">
            <div class="d-flex align-items-center ml-3">
                <x-nav-items></x-nav-items>
                <div class="ms-auto">Search icon here</div>
            </div>

        </div>
    </div>
    <div class="card w-75 mx-auto mt-1">
        <div class="card-body d-flex flex-wrap">
            @foreach ($housings as $housing)
                <x-single-housing-display :housing="$housing"></x-single-housing-display>
            @endforeach
        </div>
    </div>
</x-app-layout>
