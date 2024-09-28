@extends('admin.layout')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>User Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Users</h5>
                            <a href="{{ route('dashboard.users.create') }}" class="btn btn-primary btn-sm" title="plus">
                                <i class="bi bi-patch-plus"></i> Create
                            </a>
                        </div>

                        <!-- Default Table -->
                        <table class="table table-bordered" style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Role</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $users->firstItem() + $loop->index }}</th>
                                    <td>
                                        @php
                                        $userMeta = $user->userMetas->first();
                                        $userAddressMeta = $userMeta ? $userMeta->address : null;
                                        $userRoleMeta = $userMeta->role;
                                        @endphp
                                        @if($userMeta)
                                        <img src="{{ asset('storage/'.$userMeta->thumbnail) }}" style="width: 50px; height: 50px;" alt="">
                                       @else
                                       <img src="{{ url('images/user.jpg') }}" style="width: 50px; height: 50px;" alt="">
                                        @endif
                                        
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                    {{ $userAddressMeta ? Str::limit($userAddressMeta, 30, '...') : "" }}
                                    </td>
                                    <td>{{ $userRoleMeta }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('dashboard.users.show', $user->id) }}" class="btn btn-success btn-sm" title="View"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('dashboard.users.edit', $user->id) }}" class="btn btn-warning btn-sm mx-2" title="Edit"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="confirmation(event, this.form)" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                    </div>
                    <!-- pagination  -->
                    <div class="col-12 d-flex justify-content-center mt-3">
                        <nav>
                            {{ $users->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    <!-- end pagination  -->
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection