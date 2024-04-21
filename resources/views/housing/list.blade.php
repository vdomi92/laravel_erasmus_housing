<x-app-layout>
    <div class="card w-75 mx-auto mt-4">
        <div class="card-body">
            <h1 class="text-center mb-3 fw-bold text-decoration-underline fs-1">House listings</h1>
            <hr class="mb-3">
            <div class="d-flex align-items-center ml-3">
                <x-nav-items></x-nav-items>
                <div class="ms-auto">Search icon here</div>
            </div>
                    @foreach ($housings as $housing)

                    @endforeach

        </div>
    </div>
    <div class="card w-75 mx-auto mt-1">
        <div class="card-body">



            @foreach ($housings as $housing)

            @endforeach

        </div>
    </div>
</x-app-layout>
