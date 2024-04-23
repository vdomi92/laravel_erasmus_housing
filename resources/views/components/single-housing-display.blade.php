@props(['housing'])

<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-4 p-1">
    <div class="card">
        <img src="..." class="card-img-top col-md-6 img-thumbnail ratio ratio-16x9" alt="TODO">
        <div class="d-flex flex-col"  style="min-height: 200px">
            <div class="pl-2 pt-3 mb-2">
                <h5 class="fw-bold ">{{ $housing->city }} - {{ $housing->country }}</h5>
            </div>
            <div class="pl-2 pt-2 mb-1">
                <p class="mb-1">Available places: {{ $housing->accepted_count }}</p>
                <p>{{strlen($housing->description) > 80 ? substr($housing->description, 0,80) . '...' : $housing->description}}</p>
            </div>
            <div class="pb-1 d-flex justify-center mt-auto">
                <a href="{{route('housings.show', ['id' => $housing->id])}}" class="btn btn-primary">View details</a>
            </div>
        </div>
    </div>
</div>
