<div class="d-flex">
    <div class="dropdown me-0 me-lg-2">
        <button class="btn btn-secondary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Housings
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('housings.list') }}">Browse listings</a></li>
            <li><a class="dropdown-item" href="{{ route('housings.create') }}">Create listing</a></li>
            <li><a class="dropdown-item"
                   href="{{ route('housings.manage', ['id' => \Illuminate\Support\Facades\Auth::user()->id]) }}"
                >My listings</a></li>
        </ul>
    </div>
    <div class="dropdown me-0 me-lg-2">
        <button class="btn btn-secondary" type="button">
            My applications
        </button>
    </div>
    <div class="me-0 me-lg-2">
        <button class="btn btn-secondary" type="button" >
            Messages
        </button>
    </div>
</div>
