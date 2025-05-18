@extends('layouts.app')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <h3 class="h3 mb-0 text-gray-800">Roles</h3>
        </div>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles Data</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-end">
                        <a href="/dashboard/roles/create" class="btn btn-primary mb-3">+ Add Role</a>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <form action="/dashboard/roles" class="w-50" method="GET">
                            <div class="mb-3">
                                <label>Search:</label>
                                <input type="search" name="search" value="{{ request('search') }}"
                                    class="form-control form-control-sm" placeholder="Search">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered" width="100%" cellspacing="0" role="grid"
                                    style="width: 100%;">
                                    <thead>
                                        <tr role="row">
                                            <th>Name</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['roles'] as $role)
                                            <tr class="even">
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->created_at->format('d M Y') }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-start gap-3">
                                                        <a href="/dashboard/roles/{{ $role->id }}/edit"
                                                            class="btn btn-warning">
                                                            Edit
                                                        </a>
                                                        <form action="/dashboard/roles/{{ $role->id }}"
                                                            method="POST" onsubmit="return confirm('Are you sure?');"
                                                            style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">
                                                                Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                    Total Data : {{ $data['roles']->total() }} Data</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="w-100 justify-content-end d-flex">
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($data['roles']->onFirstPage())
                                            <li class="paginate_button page-item previous disabled">
                                                <span class="page-link">Previous</span>
                                            </li>
                                        @else
                                            <li class="paginate_button page-item previous">
                                                <a href="{{ $data['roles']->previousPageUrl() }}"
                                                    class="page-link">Previous</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($data['roles']->getUrlRange(1, $data['roles']->lastPage()) as $page => $url)
                                            @if ($page == $data['roles']->currentPage())
                                                <li class="paginate_button page-item active">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="paginate_button page-item">
                                                    <a href="{{ $url }}"
                                                        class="page-link">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($data['roles']->hasMorePages())
                                            <li class="paginate_button page-item next">
                                                <a href="{{ $data['roles']->nextPageUrl() }}" class="page-link">Next</a>
                                            </li>
                                        @else
                                            <li class="paginate_button page-item next disabled">
                                                <span class="page-link">Next</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
