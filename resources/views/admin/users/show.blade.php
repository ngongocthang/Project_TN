@extends('admin.layout')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>User Show</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">User</a></li>
                <li class="breadcrumb-item">Show</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <!-- Default Table -->
                        <table class="table" style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Role</th>
                                    <th scope="col">Create At</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        @php
                                        $userMeta = $user->userMetas->first();
                                        $userAddressMeta = $userMeta ? $userMeta->address : null;
                                        $userRoleMeta = $userMeta->role;
                                        $userPhoneMeta = $userMeta->phone;
                                        @endphp
                                        @if($userMeta)
                                        <img src="{{ asset('storage/'.$userMeta->thumbnail) }}" style="width: 50px; height: 50px;" alt="">
                                        @else
                                        <img src="{{ url('images/user.jpg') }}" style="width: 50px; height: 50px;" alt="">
                                        @endif

                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $userPhoneMeta }}</td>
                                    <td>
                                    {{ $userAddressMeta ? Str::limit($userAddressMeta, 30, '...') : "" }}
                                    </td>
                                    <td>{{ $userRoleMeta }}</td>
                                    <td>{{ $user->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-warning btn-sm mx-2" title="Edit"><i class="bi bi-pencil"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                        <div class="row mb-3">
                            <div class="col-sm-12 text-end">
                                <a href="{{ route('dashboard.users.index') }}" class="btn-custom">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection