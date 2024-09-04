@extends('admin.app')
@section('admin_content')

    {{-- CKEditor CDN --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Admin</a></li>
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Invoice</a></li>
                        <li class="breadcrumb-item active">Invoice!</li>
                    </ol>
                </div>
                <h4 class="page-title">Invoice!</h4>
            </div>
        </div>
    </div>

    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <!-- Invoice Logo-->
                <div class="clearfix">
                    <div class="float-start mb-3">
                        <img src="{{URL::to('backend/images/etl_logo.png')}}" alt="dark logo" height="22">
                    </div>
                    <div class="float-end">
                        <h4 class="m-0 d-print-none">Invoice</h4>
                    </div>
                </div>

                <!-- Invoice Detail-->
                <div class="row">
                    <div class="col-sm-6">
                        <div class="float-end mt-3">
                            <p><b>Hello, {{$invoice->user->name}}</b></p>
                            <p class="text-muted fs-13">Please find below a cost-breakdown for the recent work completed. Please make payment at your earliest convenience, and do not hesitate to contact me with any questions.</p>
                        </div>

                    </div><!-- end col -->
                    <div class="col-sm-4 offset-sm-2">
                        <div class="mt-3 float-sm-end">
                            <p class="fs-13"><strong>Order Date: </strong> &nbsp;&nbsp;&nbsp; {{ $invoice->created_at->format('d M Y') }}</p>
                            <p class="fs-13"><strong>Order ID: </strong> <span class="float-end"> {!! DNS1D::getBarcodeHTML($invoice->item->barcode, 'C128') !!}</span></p>
                        </div>
                    </div><!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table table-sm table-centered table-hover table-borderless mb-0 mt-3">
                                <thead class="border-top border-bottom bg-light-subtle border-light">
                                <tr><th>#</th>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Unit Cost</th>
                                    <th class="text-end">Total</th>
                                </tr></thead>
                                <tbody>
                                <tr>
                                    <td class="">1</td>
                                    <td>
                                        <b>{{$invoice->item->name}}</b> <br/>
                                    </td>
                                    <td>{{$invoice->qty}}</td>
                                    <td>${{$invoice->item->price}}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-sm-6">
                        <div class="clearfix pt-3">
                            <h6 class="text-muted fs-14">Notes:</h6>
                            <small>
                                All accounts are to be paid within 7 days from receipt of
                                invoice. To be paid by cheque or credit card or direct payment
                                online. If account is not paid within 7 days the credits details
                                supplied as confirmation of work undertaken will be charged the
                                agreed quoted fee noted above.
                            </small>
                        </div>
                    </div> <!-- end col -->
                    <div class="col-sm-6">
                        <div class="float-end mt-3 mt-sm-0">
                            <p><b>Sub-total:</b> <span class="float-end">${{$invoice->qty*$invoice->item->price}}</span></p>
                            <h3>${{$invoice->qty*$invoice->item->price}} USD</h3>
                        </div>
                        <div class="clearfix"></div>
                    </div> <!-- end col -->
                </div>
                <!-- end row-->

                <div class="d-print-none mt-4">
                    <div class="text-center">
                        <a href="javascript:window.print()" class="btn btn-primary"><i class="ri-printer-line"></i> Print</a>
                        <a href="javascript: void(0);" class="btn btn-info">Submit</a>
                    </div>
                </div>
                <!-- end buttons -->

            </div> <!-- end card-body-->
        </div> <!-- end card -->
    </div> <!-- end col-->
</div>
@endsection
