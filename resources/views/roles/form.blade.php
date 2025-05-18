@extends('layouts.app')

@section('title')
    {{ $data['title'] }}
@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <h3 class="h3 mb-0 text-gray-800">{{ $data['title'] }}</h3>
        </div>
        <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below.
            For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official
                DataTables documentation</a>.</p>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">{{ $data['title'] }} Data</h6>
            </div>
            <div class="card-body">
                <form action="{{ isset($data['role']) ? '/dashboard/roles/' . $data['role']->id : '/dashboard/roles' }}"
                    method="POST">
                    @csrf
                    @if (!empty($data['role']->id))
                        @method('PUT')
                    @endif

                    <div class="form-group mb-3">
                        <label for="name">Role Name</label>
                        <input type="text" id="name" name="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $data['role']->name ?? '') }}" placeholder="Role Name">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Save Data</button>
                </form>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection
