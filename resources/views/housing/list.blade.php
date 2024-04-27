@props(['housings'])
<x-app-layout>
    <div class="card w-75 mx-auto mt-4 full-width-md">
        <div class="card-body">
            <h1 class="text-center mb-3 fw-bold text-decoration-underline fs-1">House listings</h1>
            <hr class="mb-3">
            <div class="d-flex align-items-center ml-3">
{{--             TODO replace placeholders query filters + pagination--}}
                <div class="d-flex">placeholder search filters</div>
                <div class="ms-auto">Search icon here</div>
            </div>

        </div>
    </div>
    <div class="card w-75 mx-auto mt-1">
        <div class="card-body d-flex flex-wrap">
            @foreach ($housings as $housing)
                <x-single-housing-display-listed :housing="$housing"></x-single-housing-display-listed>
            @endforeach
        </div>
    </div>
</x-app-layout>
