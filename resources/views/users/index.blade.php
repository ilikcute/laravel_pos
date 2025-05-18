@extends('layouts.app')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <h3 class="h3 mb-0 text-gray-800">Users</h3>
        </div>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users Data</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-end"></div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <form action="/dashboard/users" class="w-50" method="GET">
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
                                            <th>Role</th>
                                            <th>Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['users'] as $user)
                                            <tr class="even">
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->role->name }}</td>
                                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-5">
                                <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                    Total Data : {{ $data['users']->total() }} Data</div>
                            </div>
                            <div class="col-sm-12 col-md-7">
                                <div class="w-100 justify-content-end d-flex">
                                    <ul class="pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($data['users']->onFirstPage())
                                            <li class="paginate_button page-item previous disabled">
                                                <span class="page-link">Previous</span>
                                            </li>
                                        @else
                                            <li class="paginate_button page-item previous">
                                                <a href="{{ $data['users']->previousPageUrl() }}"
                                                    class="page-link">Previous</a>
                                            </li>
                                        @endif

                                        {{-- Pagination Elements --}}
                                        @foreach ($data['users']->getUrlRange(1, $data['users']->lastPage()) as $page => $url)
                                            @if ($page == $data['users']->currentPage())
                                                <li class="paginate_button page-item active">
                                                    <span class="page-link">{{ $page }}</span>
                                                </li>
                                            @else
                                                <li class="paginate_button page-item">
                                                    <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                                </li>
                                            @endif
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($data['users']->hasMorePages())
                                            <li class="paginate_button page-item next">
                                                <a href="{{ $data['users']->nextPageUrl() }}" class="page-link">Next</a>
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
