@extends('admin.app')
@section('admin_content')

    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order List</a></li>
                        <li class="breadcrumb-item active">Order List!</li>
                    </ol>
                </div>
                <h4 class="page-title">Order List!</h4>
            </div>
        </div>
    </div>



    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h3>All Order</h3>
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>User Name</th>
                        <th>Name</th>
                        <th>Order Qty</th>
                        <th>Price</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key=>$ordersData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$key+1}}</td>
                            <td>{{$ordersData->item->name}}</td>
                            <td>{{$ordersData->item->qty}}</td>
                            <td>{{$ordersData->item->price}}</td>
                            <td>{{ $ordersData->created_at->format('d M Y') }}</td>

                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    <a type="button" href="{{route('invoice.show',$ordersData->id)}}" class="btn btn-info">Invoice</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
