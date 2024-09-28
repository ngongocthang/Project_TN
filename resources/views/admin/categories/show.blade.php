@extends('admin.layout')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Category Show</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Category</a></li>
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
                                    <th scope="col">Description</th>
                                    <th scope="col">Create At</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <td><img src="{{ asset('storage/'.$category->image) }}" alt="" class="img-fluid" style="width: 50px; height: 50px;"></td>
                                
                                <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-warning btn-sm mx-3" title="Edit"><i class="bi bi-pencil"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                        <div class="row mb-3">
                            <div class="col-sm-12 text-end">
                            <a href="{{ route('dashboard.categories.index') }}" class="btn-custom">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection