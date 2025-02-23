<x-app-layout>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success mt-2">{{ session('status') }}</div>
                @endif

                <div class="card mt-3 mb-6">
                    <div class="card-header">
                        <h2 class="d-flex justify-content-between align-items-center"><b>Leads</b>
                            @can('create permission')
                                <a href="{{ route('tasks.create') }}" class="btn btn-sm bg-indigo-500 text-white hover:bg-indigo-600 float-end shadow-sm">
                                    <i class="fa-solid fa-plus opacity-75"></i>&nbsp;&nbsp;Add
                                </a>
                            @endcan
                        </h2>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="table-info">
                                <th class="text-center" width="3%">ID</th>
                                <th width="15%">Assigned User</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th width="10%">Status</th>
                                <th width="10%" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($tasks as $task)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $task->user?->name }}</td>
                                    <td>{{ $task->title }}</td>
                                    <td>{{ $task->description }}</td>
                                    <td>{{ \Carbon\Carbon::parse($task->due_date)->format('jS M, Y') }}</td>
                                    <td>{{ $task->status }}</td>
                                    <td class="d-flex justify-content-center gap-1">
                                        @can('update permission')
                                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-success shadow-sm"
                                               data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                                <i class="fa-solid fa-pen-to-square opacity-75"></i>
                                            </a>
                                        @endcan
                                        @can('delete permission')
                                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-sm btn-danger shadow-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                                    <i class="fa-solid fa-trash opacity-75"></i>
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No Data Found!</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
