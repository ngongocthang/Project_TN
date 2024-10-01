@extends('admin.layout')
@section('content')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('success-message')) {
            setTimeout(function() {
                window.location.href = "{{ route('dashboard.users.index') }}";
            }, 7000);
        }
    });
</script>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Show error controller -->
    @if(session('message-success'))
    <div class="" id="success-message">
    </div>
    @endif

    <!-- show error request -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="section">
        <div class="row">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Form</h5>
                        <!-- General Form Elements -->
                        <form action="{{ route('dashboard.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @php
                            $userMeta = $user->userMetas->first();
                            $userAddressMeta = $userMeta ? $userMeta->address : null;
                            $phoneUserMeta = $userMeta->phone;
                            $thumbnailUserMeta = $userMeta->thumbnail;
                            $rolelUserMeta = $userMeta->role;
                            @endphp
                            @if($thumbnailUserMeta)
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <img src="{{ asset('storage/'.$thumbnailUserMeta) }}" style="width: 100px; height: 100px; border-radius: 50%;" alt="">
                                </div>
                            </div>
                            @else
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <img src="{{ url('images/user.jpg') }}"
                                        style="width: 100px; height: 100px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); border: 2px solid #fff; transition: transform 0.2s;"
                                        alt="">
                                </div>
                            </div>
                            @endif

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image Upload</label>
                                <div class="col-sm-10">
                                    <input name="thumbnail" class="form-control" type="file" id="formFile">
                                    <input type="hidden" name="old_thumbnail" value="{{ $thumbnailUserMeta }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" value="{{ $user->name }}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input name="email" value="{{ $user->email }}" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input name="password" value="{{ $user->password }}" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input name="phone" value="{{ $phoneUserMeta }}" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Address</label>
                                <div class="col-sm-10">
                                    <input name="address" value="{{ $userAddressMeta ? $userAddressMeta : "" }}" type="text" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="role" class="form-select" aria-label="Default select example">
                                        <option value="" disabled {{ !$rolelUserMeta ? 'selected' : '' }}>Chọn vai trò...</option>
                                        <option value="staff" {{ $rolelUserMeta === 'staff' ? 'selected' : '' }}>User</option>
                                        <option value="staff" {{ $rolelUserMeta === 'staff' ? 'selected' : '' }} class="text-warning">Staff</option>
                                        <option value="manager" {{ $rolelUserMeta === 'manager' ? 'selected' : '' }} class="text-danger">Manager</option>
                                    </select>
                                </div>
                            </div>
                            


                            <div class="row mb-3">
                                <div class="col-sm-12 text-end">
                                    <a href="{{ route('dashboard.users.index') }}" class="btn-custom">Cancel</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form><!-- End General Form Elements -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->
@endsection