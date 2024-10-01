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
                <li class="breadcrumb-item active">Create</li>
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
                        <h5 class="card-title">Create Form</h5>

                        <!-- General Form Elements -->
                        <form action="{{ route('dashboard.users.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image Upload</label>
                                <div class="col-sm-10">
                                    <input name="thumbnail" class="form-control" type="file" id="formFile">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input name="email" type="email" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input name="password" type="password" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Phone</label>
                                <div class="col-sm-10">
                                    <input name="phone" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">
                                    <select name="role" class="form-select" aria-label="Default select example">
                                        <option value="" disabled selected>Chọn vai trò...</option>
                                        <option value="staff" class="text-warning">Staff</option>
                                        <option value="manager" class="text-danger">Manager</option>
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