@extends('admin.layout')
@section('content')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (document.getElementById('success-message')) {
            setTimeout(function() {
                window.location.href = "{{ route('dashboard.orders.index') }}";
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
                <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}">Order</a></li>
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
                        <form action="{{ route('dashboard.orders.update', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">User</label>
                                <div class="col-sm-10">
                                    <input name="user_id" disabled class="form-control" value="{{ $order->user->name }}" type="text" id="formFile">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Code</label>
                                <div class="col-sm-10">
                                    <input name="code" disabled value="{{ $order->code }}" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" class="form-select" aria-label="Default select example">
                                        <option value="" disabled {{ !$order->status ? 'selected' : '' }}>Chọn trạng thái...</option>
                                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }} class="text-warning">Pending</option>
                                        <option value="paid" {{ $order->status === 'paid' ? 'selected' : '' }} class="text-success">Paid</option>
                                        <option value="canceled" {{ $order->status === 'canceled' ? 'selected' : '' }} class="text-danger">Canceled</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-12 text-end">
                                    <a href="{{ route('dashboard.orders.index') }}" class="btn-custom">Cancel</a>
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