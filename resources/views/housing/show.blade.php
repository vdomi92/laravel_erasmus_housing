@props(['housing', 'user'])
<x-app-layout>
    <div class="card w-50 full-width-md mx-auto mt-1 p-2">
        <div class="card-body d-flex flex-col flex-wrap">
            <img src="{{
                    $housing->preview_image == null ?
                     asset('storage/house-placeholder.png') :
                      asset('storage/'. $housing->preview_image)
                    }}"
                 class="card-img-top col-md-6 img-thumbnail ratio ratio-16x9 w-100 mx-auto p-0"
                 alt="TODO">
            <div class="d-flex flex-col">

                <div class="pl-2 pt-3 mb-2">
                    <h5 class="fw-bold ">{{ $housing->country }}</h5>
                    <p class="mb-1">{{ $housing->zip }} {{ $housing->city }}, {{ $housing->street }} st. {{ $housing->house_nr  }}</p>
                </div>

                <div class="pl-2 pt-2 mb-1">
                    <p class="mb-1">Provider: {{ $housing->owner->name }} ( {{$housing->owner->age}} )</p>
                    <p class="mb-1">Total places: {{ $housing->nr_of_slots }}</p>
                    <p class="mb-1">Places remaining: {{ $housing->nr_of_slots - $housing->accepted_count }}</p>
                    <p class="mb-1">{{ $housing->description }}</p>
                </div>

                <div class="pb-1 d-flex flex-wrap justify-center mt-auto gap-3">
                    @can('create', [\App\Models\Application::class, $housing->id])
                        <a href="{{route('applications.create', $housing->id)}}"
                           class="btn btn-primary w-40 full-width-md">Apply</a>
                    @endcan

                    @if($housing->owner->id == $user->id)
                        <a href="{{route('housings.edit', $housing->id)}}"
                           class="btn btn-primary w-40 full-width-md">Edit</a>

                        <div class="w-40 full-width-md">
                                <button id="delete"
                                        class="btn btn-danger w-100"
                                        data-bs-toggle="modal"
                                        data-bs-target="#confirm-modal">Delete</button>
                        </div>
                    @else
                            {{--    TODO: change route to message.create, $housing->owner->id              --}}
                        <a href="{{route('housings.list')}}"
                           class="btn btn-primary w-40 full-width-md">Send a message</a>
                    @endif

                </div>
            </div>
        </div>
    </div>

    @if($housing->owner->id == $user->id)
        <x-modal-confirm title="Delete listing" message="Are you sure you want to delete this house listing?">
            <form action="{{route('housings.destroy', $housing->id)}}" method="POST"  class="hidden">
                @csrf
                @method('DELETE')
                <button id="delete-confirmed" type="submit" class="hidden"></button>
            </form>
        </x-modal-confirm>

        <script>
            $modalConfirmButton = document.querySelector('#modal-confirm-button');
            $modalConfirmButton.addEventListener('click', function () {
                const clickEvent = new MouseEvent('click');
                document.querySelector('#delete-confirmed').dispatchEvent(clickEvent);
            });
        </script>
    @endif

</x-app-layout>
