@extends('admin.layout')
@section('content')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('success-message')) {
            setTimeout(function() {
                window.location.href = "{{ route('dashboard.blogs.index') }}";
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
                <li class="breadcrumb-item"><a href="{{ route('dashboard.blogs.index') }}">Blogs</a></li>
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
                        <form action="{{ route('dashboard.blogs.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image Upload</label>
                                <div class="col-sm-10">
                                    <input name="image" class="form-control" type="file" id="formFile">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <textarea name="title" id="title" class="form-control" style="width: 100%;"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" id="description" class="form-control" style="height: 70px; width: 100%;"></textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Content</label>
                                <div class="col-sm-10">
                                    <textarea name="content" id="content" class="form-control" style="height: 150px; width: 100%;"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Author</label>
                                <div class="col-sm-10">
                                    <select name="user_id" class="form-select" aria-label="Default select example">
                                        <option value="" disabled selected>Chọn tác giả...</option>
                                        @foreach( $users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 text-end">
                                    <a href="{{ route('dashboard.blogs.index') }}" class="btn-custom">Cancel</a>
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