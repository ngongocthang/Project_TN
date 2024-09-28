@extends('admin.layout')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product Sold Show</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.product-solds.index') }}">Product Sold</a></li>
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
                        <table class="table " style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price(VND)</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Create At</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="{{ asset('storage/'.$product->image) }}" alt="" class="img-fluid" style="width: 50px; height: 50px;"></td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ Str::limit(number_format($product->price, 0, ',', '.'), 3, '...') }} đ</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>
                                        <span class="badge bg-danger">
                                            {{ ($product->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $product->view }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('dashboard.product-solds.edit', $product->id) }}" class="btn btn-warning btn-sm mx-2" title="Edit"><i class="bi bi-pencil"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                        <div class="row mb-3">
                            <div class="col-sm-12 text-end">
                                <a href="{{ route('dashboard.product-solds.index') }}" class="btn-custom">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection