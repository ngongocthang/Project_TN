@extends('admin.layout')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Blog Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Blog</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Blogs</h5>
                            <a href="{{ route('dashboard.blogs.create') }}" class="btn btn-primary btn-sm" title="plus">
                                <i class="bi bi-patch-plus"></i> Create
                            </a>
                        </div>

                        <!-- Default Table -->
                        <table class="table table-bordered" style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Content</th>
                                    <th scope="col">Author</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blogs as $blog)
                                <tr>
                                    <th scope="row">{{ $blogs->firstItem() + $loop->index }}</th>
                                    <td><img src="{{ asset('storage/'.$blog->image) }}" style="width: 50px; height: 50px;" alt="">
                                    </td>
                                    <td>
                                        {{ $blog->title ? Str::limit($blog->title, 20, '...') : "" }}
                                    </td>
                                    <td>
                                        {{ $blog->description ? Str::limit($blog->description, 40, '...') : "" }}
                                    </td>
                                    <td>
                                        {{ $blog->content ? Str::limit($blog->content, 70, '...') : "" }}
                                    </td>
                                    <td>{{ $blog->user->name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('dashboard.blogs.show', $blog->id) }}" class="btn btn-success btn-sm" title="View"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('dashboard.blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm mx-2" title="Edit"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('dashboard.blogs.destroy', $blog->id) }}" method="POST" style="display: inline;">
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
                            {{ $blogs->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    <!-- end pagination  -->
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection