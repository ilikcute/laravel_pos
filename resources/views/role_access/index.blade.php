@extends('layouts.app')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')
    @php
        $assignedRoutes = $data['role_permissions']->pluck('permission.route_name')->toArray();
    @endphp

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
            <h3 class="h3 mb-0 text-gray-800">Role Access</h3>
        </div>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank"
                href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Role Access Data</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('permission_role.update', $data['role_id']) }}">
                    @csrf
                    <div class="row">
                        @foreach ($data['permissions'] as $permission)
                            <div class="col-md-3">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                        value="{{ $permission->id }}" id="check_{{ $permission->id }}"
                                        {{ in_array($permission->route_name, $assignedRoutes) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="check_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">Save Permissions</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
