<div class="d-flex">
    <div class="dropdown me-0 me-lg-2">
        <button class="btn btn-secondary  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Housings
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('housings.list') }}">Browse listings</a></li>
            <li><a class="dropdown-item" href="{{ route('housings.create') }}">Create listing</a></li>
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
