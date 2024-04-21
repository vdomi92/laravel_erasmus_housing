<x-app-layout>
    <x-slot name="header">
        <div class="d-flex">
            <div class="dropdown me-0 me-lg-2">
                <button class="btn btn-secondary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Housings
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Browse listings</a></li>
                    <li><a class="dropdown-item" href="#">Create listing</a></li>
                    <li><a class="dropdown-item" href="#">My listings</a></li>
                </ul>
            </div>
            <div class="dropdown me-0 me-lg-2">
                <button class="btn btn-secondary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Applications
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">My applications</a></li>
                    <li><a class="dropdown-item" href="#">Applied to me</a></li>
                </ul>
            </div>
            <div class="me-0 me-lg-2">
                <button class="btn btn-secondary" type="button" >
                    Messages
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Welcome!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
