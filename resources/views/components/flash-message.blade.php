@if(session('success'))
    <div class="alert alert-success w-75 text-center mx-auto">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger w-75 text-center mx-auto">
        {{ session('error') }}
    </div>
@endif
