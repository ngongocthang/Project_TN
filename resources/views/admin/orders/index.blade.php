@extends('admin.layout')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Order Tables</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item">Order</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card pt-5">
                    <div class="card-body">
                        <!-- Default Table -->
                        <table class="table table-bordered" style="vertical-align: middle;">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Order_date</th>
                                    <th scope="col">Update_date</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $orders->firstItem() + $loop->index }}</th>
                                    <td> <a href="{{ route('dashboard.order-items.show', $order->id) }}">{{ $order->code }}</a> </td>
                                    <td>{{ Str::limit($order->user->name, 20, '...') }}</td>
                                    <td>
                                        <span class="badge {{ $order->status === 'pending' ? 'bg-warning' : ($order->status === 'paid' ? 'bg-success' : 'bg-danger') }}">
                                            {{ ($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>{{ $order->updated_at }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('dashboard.orders.show', $order->id) }}" class="btn btn-success btn-sm me-2" title="View"><i class="bi bi-eye"></i></a>
                                            <a href="{{ route('dashboard.orders.edit', $order->id) }}" class="btn btn-warning btn-sm me-2" title="Edit"><i class="bi bi-pencil"></i></a>
                                            <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="POST" style="display: inline;">
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
                            {{ $orders->links('pagination::bootstrap-4') }}
                        </nav>
                    </div>
                    <!-- end pagination  -->
                </div>
            </div>
        </div>
    </section>

</main><!-- End #main -->

@endsection