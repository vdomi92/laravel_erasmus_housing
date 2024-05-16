@props (['applications'])
<x-app-layout>
    <div class="card w-75 mx-auto full-width-lg min-w-700 mt-4">
        <div class="text-center text-4xl fw-bold min-w-700">
            Review applications
        </div>
        <div class="w-100">
            <table class="table table-striped table-bordered min-w-700" >
                <thead>
                    <tr class="text-center">
                        <th scope="col" class="">#</th>
                        <th scope="col">Applicant</th>
                        <th scope="col">Application date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($applications as $application)
                        <tr>
                            <th scope="row" >
                               {{ $loop->iteration }}
                            </th>
                            <td>
                              {{ $application->applicant->name }}
                            </td>
                            <td>
                                {{ $application->created_at }}
                            </td>
                            <td>
                                @if ($application->is_accepted === true)
                                    Accepted
                                @elseif ($application->is_accepted === false)
                                    Denied
                                @else
                                    Pending
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-between gap-1">
                                    <a class="btn btn-sm> btn-secondary" href="">Review</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
