<x-app-layout>
    <div class="card w-50 full-width-md mx-auto mt-1 p-2">
        <div class="text-center">
            <h2 class="fw-bold">Apply for housing</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('housings.store') }}" method="POST">
                @csrf
                <p>HALLÓ</p>
            </form>
        </div>
    </div>
</x-app-layout>
