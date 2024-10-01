@extends('admin.layout')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order Show</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.orders.index') }}">Order</a></li>
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
                        <table class="table mt-5" style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th scope="col">User</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order_date</th>
                                    <th scope="col">Update_date</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $order->user->name }}</td>
                                    <td>
                                        <span class="badge {{ $order->status === 'pending' ? 'bg-warning' : ($order->status === 'paid' ? 'bg-success' : 'bg-danger') }}">
                                            {{ ($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('dashboard.orders.edit', $order->id) }}" class="btn btn-warning btn-sm mx-2" title="Edit"><i class="bi bi-pencil"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- End Default Table Example -->
                        <div class="row mb-3">
                            <div class="col-sm-12 text-end">
                                <a href="{{ route('dashboard.orders.index') }}" class="btn-custom">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection