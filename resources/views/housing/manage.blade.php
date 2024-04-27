@props(['housings'])
<x-app-layout>
    <div class="card w-75 mx-auto full-width-lg min-w-700 mt-4">
        <div class="text-center text-4xl fw-bold min-w-700">
            Manage houses
        </div>
        <div class="w-100">
            <table class="table table-striped table-bordered min-w-700" >
                <thead>
                    <tr class="text-center">
                        <th scope="col" class="">#</th>
                        <th scope="col">Country</th>
                        <th scope="col">City</th>
                        <th scope="col">ZIP</th>
                        <th scope="col">Address</th>
                        <th scope="col">Places</th>
                        <th class="w-20">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($housings as $housing)
                        <tr>
                            <th scope="row" >
                               {{ $loop->iteration }}
                            </th>
                            <td>
                              {{ $housing->country }}
                            </td>
                            <td>
                                {{ $housing->city }}
                            </td>
                            <td>
                                {{ $housing->zip }}
                            </td>
                            <td>
                                {{ $housing->street }} .st {{ $housing->house_nr }}
                            </td>
                            <td>
                                {{ $housing->nr_of_slots }}
                            </td>
                            <td>
                                <div class="d-flex justify-between gap-1">
                                    <a class="btn btn-sm btn-secondary" href="{{ route('housings.show', $housing->id) }}">View</a>
                                    <a class="btn btn-sm btn-secondary" href="{{ route('housings.show', $housing->id) }}">Applications</a>
                                    <a class="btn btn-sm btn-secondary" href="{{ route('housings.show', $housing->id) }}">Gallery</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>

<script>
    const appContainer = document.querySelector('.app-layout-container');
    appContainer.classList.add('min-w-700');
</script>
