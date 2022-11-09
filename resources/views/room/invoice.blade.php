<html lang="en">
<head itemscope="" itemtype="http://schema.org/WebSite"><title itemprop="name">Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="description"
          content="Preview Bootstrap snippets. white invoice. Copy and paste the html, css and js code for save time, build your app faster and responsive">
    <meta name="keywords"
          content="bootdey, bootstrap, theme, templates, snippets, bootstrap framework, bootstrap snippets, free items, html, css, js">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="https://www.bootdey.com/img/favicon.ico">
    <link rel="apple-touch-icon" sizes="135x140" href="https://www.bootdey.com/img/bootdey_135x140.png">
    <link rel="apple-touch-icon" sizes="76x76" href="https://www.bootdey.com/img/bootdey_76x76.png">
    <link rel="canonical" href="https://www.bootdey.com/snippets/preview/white-invoice" itemprop="url">
    <meta property="twitter:account_id" content="2433978487">
    <link rel="alternate" type="application/rss+xml"
          title="Latest snippets resources templates and utilities for bootstrap from bootdey.com:"
          href="http://bootdey.com/rss">
    <link rel="author" href="https://plus.google.com/u/1/106310663276114892188">
    <link rel="publisher" href="https://plus.google.com/+Bootdey-bootstrap/posts">
    <meta name="msvalidate.01" content="23285BE3183727A550D31CAE95A790AB">

</head>
<body>
<div id="snippetContent">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <div class="container">
        <div class="row gutters">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="invoice-container">
                            <div class="invoice-header">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                                        <div class="custom-actions-btns mb-5"><a href="#"
                                                                                 class="btn btn-sm btn-secondary noPrint" onclick="window.print();" >
                                                <i class="icon-printer"></i> In hóa đơn </a></div>
                                    </div>
                                </div>
                                <div class="row gutters">
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6"><a href="index.html"
                                                                                        class="invoice-logo">{{$option->name ??''}}</a>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">

                                    </div>
                                </div>
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="invoice-details d-flex justify-content-between">
                                            <div>
                                                <address>Địa chỉ: {{$option->address ??''}}</address>
                                                <address>Số điện thoại: {{$option->phone ??''}}, Email: {{$option->email ??''}}, Fax: {{$option->fax ??''}}</address>
                                                <address>Hóa đơn sử dụng - #00{{$bookingRoom->id}}</address>
                                                <address>Thời gian: {{\Carbon\Carbon::now()->format('d-m-Y')}}</address>
                                            </div>
                                            <img class="momo-special-code" style="max-width:120px;display:inline-block;" alt="" src="https://chart.googleapis.com/chart?chs=350x350&amp;cht=qr&amp;choe=UTF-8&amp;chl=https://khachsan.sbaygroup.net/booking-room/invoice/{{$bookingRoom->id ?? 0}}">

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-body">
                                <div class="row gutters">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="table-responsive">
                                            <table class="table table-sm custom-table m-0">
                                                <thead>
                                                <tr>
                                                    <th>Dịch vụ</th>
                                                    <th>SL</th>
                                                    <th>Đơn giá</th>
                                                    <th>Tổng tiền</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $total = 0;
                                                @endphp
                                                <tr>
                                                    <td colspan="1">
                                                        <p>Tiền phòng</p>
                                                        <p> {{$bookingRoom->room->name ?? 'Không tồn tại'}}</p>
                                                        @if(!empty($bookingRoom->start_date))<p> Giờ vào: {{$bookingRoom->start_date ?? ''}}</p>@endif
                                                        @if(!empty($bookingRoom->checkout_date))<p> Giờ ra: {{$bookingRoom->checkout_date ?? ''}}</p>@endif
                                                    </td>
                                                    <td><b>{{$bookingRoom->getTime(false)}}</b></td>
                                                    <td><b>{{$bookingRoom->getTime(true)}}</b></td>
                                                    <td><b>{{$bookingRoom->getTotalPrice(false)}}</b></td>
                                                    @php
                                                        $total = $total + $bookingRoom->getTotalPrice(false, false);
                                                    @endphp
                                                </tr>
                                                @foreach($bookingRoom->bookingRoomServices()->get() as $bookingRoomService)
                                                    @php
                                                        $total = $total +  $bookingRoomService->getPrice();
                                                    @endphp
                                                    <tr>
                                                        <td>{{$bookingRoomService->service->name ??'Không tồn tại'}}</td>
                                                        <td>{{$bookingRoomService->getQuantity() ?? ''}} </td>
                                                        <td>{{get_price($bookingRoomService->price ?? 0, 'đ')}}</td>
                                                        <td>{{get_price($bookingRoomService->getPrice() ?? 0, 'đ') }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td>Ghi chú</td>
                                                    <td colspan="3">{{$bookingRoom->note ?? ''}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3">
                                                        <h5 class="text-success"><strong>Tổng tiền dịch vụ</strong>
                                                        </h5>
                                                    </td>
                                                    <td><h5
                                                            class="text-success">
                                                            <strong>{{get_price($total, 'đ')}}</strong></h5></td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-footer"> Xin cảm ơn quý khách! <br /> Hẹn gặp lại.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">body {
            margin-top: 20px;
            color: #2e323c;
            background: #f5f6fa;
            position: relative;
            height: 100%;
        }

        .invoice-container {
            padding: 1rem;
        }

        .invoice-container .invoice-header .invoice-logo {
            margin: 0.8rem 0 0 0;
            display: inline-block;
            font-size: 1.6rem;
            font-weight: 700;
            color: #2e323c;
        }

        .invoice-container .invoice-header .invoice-logo img {
            max-width: 130px;
        }

        .invoice-container .invoice-header address {
            font-size: 0.8rem;
            color: #9fa8b9;
            margin: 0;
        }

        .invoice-container .invoice-details {
            margin: 1rem 0 0 0;
            padding: 1rem;
            line-height: 180%;
            background: #f5f6fa;
        }

        .invoice-container .invoice-details .invoice-num {
            text-align: right;
            font-size: 0.8rem;
        }

        .invoice-container .invoice-body {
            padding: 1rem 0 0 0;
        }

        .invoice-container .invoice-footer {
            text-align: center;
            margin: 20px 0 0 0;
        }

        .invoice-status {
            text-align: center;
            padding: 1rem;
            background: #ffffff;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            margin-bottom: 1rem;
        }

        .invoice-status h2.status {
            margin: 0 0 0.8rem 0;
        }

        .invoice-status h5.status-title {
            margin: 0 0 0.8rem 0;
            color: #9fa8b9;
        }

        .invoice-status p.status-type {
            margin: 0.5rem 0 0 0;
            padding: 0;
            line-height: 150%;
        }

        .invoice-status i {
            font-size: 1.5rem;
            margin: 0 0 1rem 0;
            display: inline-block;
            padding: 1rem;
            background: #f5f6fa;
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            border-radius: 50px;
        }

        .invoice-status .badge {
            text-transform: uppercase;
        }

        @media (max-width: 767px) {
            .invoice-container {
                padding: 1rem;
            }
        }


        .custom-table {
            border: 1px solid #e0e3ec;
        }

        .custom-table thead {
            background: #007ae1;
        }

        .custom-table thead th {
            border: 0;
            color: #ffffff;
        }

        .custom-table > tbody tr:hover {
            background: #fafafa;
        }

        .custom-table > tbody tr:nth-of-type(even) {
            background-color: #ffffff;
        }

        .custom-table > tbody td {
            border: 1px solid #e6e9f0;
        }


        .card {
            background: #ffffff;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;
            border: 0;
            margin-bottom: 1rem;
        }

        .text-success {
            color: #00bb42 !important;
        }

        .text-muted {
            color: #9fa8b9 !important;
        }

        .custom-actions-btns {
            margin: auto;
            display: flex;
            justify-content: flex-end;
        }

        .custom-actions-btns .btn {
            margin: .3rem 0 .3rem .3rem;
        }</style>

    <style>
        @media print {
            .noPrint{
                display:none;
            }
        }
        h1{
            color:#f6f6;
        }
    </style>
</div>
</body>
</html>
