@extends('admin.layout')
@section('content')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('success-message')) {
            setTimeout(function() {
                window.location.href = "{{ route('dashboard.products.index') }}";
            }, 7000);
        }
    });
</script>
<main id="main" class="main">

    <div class="pagetitle">
        <h1>Form Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.products.index') }}">Product</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <!-- Show controller -->
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
                        <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <img src="{{ asset('storage/'.$product->image) }}" style="width: 100px; height: 100px; border-radius: 50%;" alt="">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Image Upload</label>
                                <div class="col-sm-10">
                                    <input name="image" class="form-control" type="file" value="{{ $product->image }}" id="formFile">
                                    <input type="hidden" name="old_image" value="{{ $product->image }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input name="name" value="{{ $product->name }}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" class="form-control" style="height: 100px">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Price(VND)</label>
                                <div class="col-sm-10">
                                    <input name="price" value="{{ $product->price }}" min="0" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input name="quantity" value="{{ $product->quantity }}" min="1" type="number" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-10">
                                    <select name="category_id" class="form-select" aria-label="Default select example">
                                        <option value="" disabled
                                            {{ !$product->category_id ? 'selected' : '' }}>
                                            {{ $product->category_id ? $product->category->name : 'Chọn danh mục...' }}
                                        </option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 text-end">
                                    <a href="{{ route('dashboard.products.index') }}" class="btn-custom">Cancel</a>
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