@extends('admin.app')
@section('admin_content')

    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                        <li class="breadcrumb-item active">Order!</li>
                    </ol>
                </div>
                <h4 class="page-title">Order!</h4>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-end">
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Available Stock</th>
                        <th>Price</th>
                        <th>Barcode</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($item as $key=>$itemData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$itemData->category->name}}</td>
                            <td>{{$itemData->name}}</td>
                            <td>{{$itemData->qty}}</td>
                            <td>{{$itemData->price}}</td>
                            <td>
                                {!! DNS1D::getBarcodeHTML($itemData->barcode, 'C128') !!}
                            </td>
                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#editNewModalId{{$itemData->id}}">Order</button>
                                </div>
                            </td>
                            <!-- Edit Modal -->
                            <div class="modal fade" id="editNewModalId{{$itemData->id}}" data-bs-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="editNewModalLabel{{$itemData->id}}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="editNewModalLabel{{$itemData->id}}">Order Item</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            <form method="post" action="{{route('order.store',$itemData->id)}}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-12">
                                                        <input hidden="" type="text"  name="item_id" value="{{$itemData->id}}">
                                                        <input hidden="" type="text"  name="stock" value="{{$itemData->qty}}">
                                                        <div class="mb-2">
                                                            <label for="name" class="form-label">Name</label>
                                                            <input type="text" id="name" name="name" value="{{$itemData->name}}"
                                                                   class="form-control" placeholder="Enter Product Name" required>
                                                        </div>
                                                        <div class="mb-2">
                                                            <label for="qty" class="form-label">Qty</label>
                                                            <input type="text" id="qty" name="qty"
                                                                   class="form-control" placeholder="Enter Qty" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-end">
                                                    <button class="btn btn-primary" type="submit">Order Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <h3>My Order</h3>
                </div>
            </div>
            <div class="card-body">
                <table id="basic-datatable" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Name</th>
                        <th>Order Qty</th>
                        <th>Price</th>
                        <th>Order Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($myOrders as $key=>$myOrdersData)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$myOrdersData->item->name}}</td>
                            <td>{{$myOrdersData->item->qty}}</td>
                            <td>{{$myOrdersData->item->price}}</td>
                            <td>{{ $myOrdersData->created_at->format('d M Y') }}</td>

                            <td style="width: 100px;">
                                <div class="d-flex justify-content-end gap-1">
                                    <a type="button" href="{{route('invoice.show',$myOrdersData->id)}}" class="btn btn-info">Invoice</a>
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
