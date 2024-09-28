@extends('admin.layout')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Product Sold Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Product</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title">Product Solds</h5>
                        </div>

                        <!-- Default Table -->
                        <table class="table table-bordered" style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Price (VND)</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>
                                    <th scope="col">Category</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{ $products->firstItem() + $loop->index }}</th>
                                    <td><img src="{{ asset('storage/'.$product->image) }}" style="width: 50px; height: 50px;" alt=""></td>
                                    <td>{{ Str::limit($product->name, 20, '...') }}</td>
                                    <td>{{ Str::limit($product->description, 30, '...') }}</td>
                                    <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td class="text-center align-middle">
                                        <span class="badge {{ $product->status === 'sale' ? 'bg-warning' : ($product->status === 'sold' ? 'bg-danger' : 'bg-success') }}">
                                            {{ ($product->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $product->view }}</td>
                                    <td>
                                        {{ $product->category ? Str::limit($product->category->name, 10, '...') : 'null' }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('dashboard.product-solds.show', $product->id) }}" class="btn btn-success btn-sm" title="View"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('dashboard.product-solds.edit', $product->id) }}" class="btn btn-warning btn-sm mx-2" title="Edit"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('dashboard.product-solds.destroy', $product->id) }}" method="POST" style="display: inline;">
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
                            {{ $products->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    <!-- end pagination  -->
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection