<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ __('Frontend/frontend.invoice', ['invoice_number', $invoice_number]) }}</title>

    <style>
        body {
            font-family: 'XBRiyaz', sans-serif;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            font-size: 9px;
            line-height: 24px;
            font-family: 'XBRiyaz', sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: right;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td {
            text-align: left;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 30px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: 'XBRiyaz', sans-serif;
        }

        .rtl table {
            text-align: right;
        }

        .rtl table tr td {
            text-align: right;
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>

<body>
<div class="invoice-box {{ config('app.locale') == 'ar' ? 'rtl' : '' }}">
    <table cellpadding="0" cellspacing="0">
        <tr class="top">
            <td colspan="6">
                <table>
                    <tr>

                        <td width="65%" class="title">
{{--                            <img src="" style="width:100px; max-width:100px;">--}}
                        </td>


                        <td width="35%">
                            {{ __('Frontend/frontend.serial') }}: {{ $invoice_number }}<br>
                            {{ __('Frontend/frontend.date') }}: {{ $invoice_date }}<br>
                            {{ __('Frontend/frontend.print_date') }}: {{ Carbon\Carbon::now()->format('Y-m-d') }}<br>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center"><h2>{{ __('Frontend/frontend.invoice_title') }}</h2></td>
                    </tr>

                </table>
            </td>
        </tr>

        <tr class="information">
            <td colspan="6">
                <table>
                    <tr>
                        <td width="50%">
                            <h2>{{ __('Frontend/frontend.seller') }}</h2>
                            {{ __('Frontend/frontend.seller_name') }}<br>
                            <span dir="ltr">{{ __('Frontend/frontend.seller_phone') }}</span><br>
                            {{ __('Frontend/frontend.seller_vat') }}<br>
                            {{ __('Frontend/frontend.seller_address') }}
                        </td>

                        <td width="50%">
                            <h2>{{ __('Frontend/frontend.buyer') }}</h2>
                            @foreach($customer as $key => $val)
                                {{ $key }}: {{ $val }}<br>
                            @endforeach
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="heading">
            <td></td>
            <td>{{ __('Frontend/frontend.product_name') }}</td>
            <td>{{ __('Frontend/frontend.unit') }}</td>
            <td>{{ __('Frontend/frontend.quantity') }}</td>
            <td>{{ __('Frontend/frontend.unit_price') }}</td>
            <td>{{ __('Frontend/frontend.sub_total') }}</td>
        </tr>

        @foreach($items as $item)
            <tr class="item {{ $loop->last ? 'last' : '' }}">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item['product_name'] }}</td>
                <td>{{ $item['unit'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ __('Frontend/frontend.sar_with_amount', ['amount' => $item['unit_price']]) }}</td>
                <td>{{ __('Frontend/frontend.sar_with_amount', ['amount' => $item['row_sub_total']]) }}</td>
            </tr>
        @endforeach

        <tr class="total">
            <td colspan="4"></td>
            <td>{{ __('Frontend/frontend.sub_total') }}</td>
            <td>{{ __('Frontend/frontend.sar_with_amount', ['amount' => $sub_total]) }}</td>
        </tr>

        <tr class="total">
            <td colspan="4"></td>
            <td>{{ __('Frontend/frontend.discount') }}</td>
            <td>{{ __('Frontend/frontend.sar_with_amount', ['amount' => $discount]) }}</td>
        </tr>
        <tr class="total">
            <td colspan="4"></td>
            <td>{{ __('Frontend/frontend.vat') }}</td>
            <td>{{ __('Frontend/frontend.sar_with_amount', ['amount' => $vat_value]) }}</td>
        </tr>
        <tr class="total">
            <td colspan="4"></td>
            <td>{{ __('Frontend/frontend.shipping') }}</td>
            <td>{{ __('Frontend/frontend.sar_with_amount', ['amount' => $shipping]) }}</td>
        </tr>
        <tr class="total">
            <td colspan="4"></td>
            <td>{{ __('Frontend/frontend.total_due') }}</td>
            <td>{{ __('Frontend/frontend.sar_with_amount', ['amount' => $total_due]) }}</td>
        </tr>
    </table>
</div>
</body>
</html>


<title>Invoice Template1</title>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <script src="https://kit.fontawesome.com/2a534c533c.js" crossorigin="anonymous"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&family=Quicksand:wght@300&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: sans-serif
        }

        .main {
            display: flex;
        }

        .w-25 {
            width: 25%;
            background-color: #504E4B;
        }

        .w-75 {
            width: 75%;
        }

        .pt-5 {
            padding-top: 5em;
        }

        .ml-4 {
            margin-left: 2em;
        }

        .mt-1 {
            margin-top: 1em;
        }

        .mb-3 {
            margin-bottom: 3em;
        }

        .mx-auto {
            margin-left: 1em;
            margin-right: 1em;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .invoicetitle, .paymenttitle {
            color: #c7b52ea1;
            font-size: 1.3em;
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
        }

        .text-white {
            color: whitesmoke;
        }

        .text-darkgrey {
            color: darkgray;
        }

        .logo {
            margin-bottom: 5em;
        }

        .border-0 {
            border: 0px !important;
        }

        .container {
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .text-end {
            text-align: end;
        }

        .date-info {
            margin-top: 10em;
            margin-bottom: 6em;
            line-height: 1.4;
        }

        .text-grey {
            color: #0e0e0eeb;
        }

        .Main-Title p {
            font-size: 3.5em;
            font-weight: lighter;
            font-family: 'Quicksand', sans-serif;
            color: #0e0e0eeb;
        }

        .Terms p:last-child {
            width: 125px;
        }

        .date-info p:last-child {
            font-weight: 600;
            font-size: 22px;
            font-family: sans-serif;
        }

        #products {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            text-align: left;
            margin-bottom: 6em;

        }

        #products tr:first-child {
            border: 1px solid #ada296;
        }

        #products tr:first-child th {
            padding: 12px 20px;
            font-weight: 500;
        }

        #products tr:last-child {
            border: 2px solid #ada296 !important;
        }

        #products tr td {
            border-bottom: 1px solid;
            padding: 16px;
            color: #0e0e0eeb;
        }

        #products tr:last-child td:first-child {
            border-left: 2px solid #ada296;
        }

        #products tr:last-child td:last-child {
            border-right: 2px solid #ada296;
        }

        .d-flex {
            display: flex;
        }

        .hr-style {
            width: 138px;
            margin-left: auto;
            margin-right: auto;
        }

        footer div {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2em;
        }

        .icon-style {
            color: #c7b52ec9;
            font-size: 1.2em;
        }

        footer div p:first-child, footer div p:nth-child(2) {
            margin-right: 10px;
        }
    </style>


</head>
<body>
<div class="main">
    <div class="left-bar w-25 pt-5">
        <div class="logo mx-auto">
            <img src="https://via.placeholder.com/100" alt="">
        </div>
        <hr class="hr-style">
        <div class="Invoiceto ml-4 mb-3">
            <p class="invoicetitle text-uppercase">Invoice to</p>
            <address class="mt-1">
                <p class="text-white">{{ __('Frontend/frontend.seller_name') }}</p>
                <p class="text-darkgrey">{{ __('Frontend/frontend.seller_address') }}</p>
                <p class="text-darkgrey"><span class="text-white">P</span>{{ __('Frontend/frontend.seller_phone') }}</p>
                <p class="text-darkgrey"><span class="text-white">H</span>info@email.com</p>
            </address>
        </div>
        <hr class="hr-style">
        <div class="Payment  ml-4 mb-3">
            <p class="paymenttitle text-uppercase">payment</p>
            <address class="mt-1">
                <p class="text-white">Bank Account</p>
                <p class="text-darkgrey">Bank Full Name</p>
                <p class="text-darkgrey">Bank Code</p>
                <p class="text-white">Paypal</p>
                <p class="text-darkgrey">info@email.com</p>
            </address>
        </div>
        <hr class="hr-style">
        <div class="Terms  ml-4 mb-3">
            <p class="paymenttitle text-uppercase">Terms</p>
            <p class="text-darkgrey mt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
        </div>
    </div>
    <div class="right-bar w-75 pt-5">
        <div class="container">
            <div class="Main-Title text-end mb-3">
                <p class="text-uppercase">Invoice</p>
            </div>
            <div class="date-info">
                <p>Date <span class="text-grey">{{ __('Frontend/frontend.date') }}: {{ $invoice_date }}</span></p>
                <p class="text-grey mt-1"> Totla Due</p>
                <p>{{ __('Frontend/frontend.sar_with_amount', ['amount' => $total_due]) }}</p>

            </div>
            <div class="table">
                <table id="products">
                    <tr class="text-uppercase">
                        <th>description</th>
                        <th>price</th>
                        <th>qty</th>
                        <th>total</th>
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur</td>
                        <td>$550</td>
                        <td>2</td>
                        <td>$2000</td>
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur</td>
                        <td>$550</td>
                        <td>2</td>
                        <td>$2000</td>
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur</td>
                        <td>$550</td>
                        <td>2</td>
                        <td>$2000</td>
                    </tr>
                    <tr>
                        <td>Lorem ipsum dolor sit amet consectetur</td>
                        <td>$550</td>
                        <td>2</td>
                        <td>$2000</td>
                    </tr>
                    <br><br><br>
                    <tr class="mt-1">
                        <td rowspan="2" class="border-0">

                            <img src="https://via.placeholder.com/100" alt="">

                        </td>
                        <td class="border-0">
                            <p>SubTotal</p>
                            <p class="mt-1">$854545</p>
                        </td>
                        <td class="border-0">
                            <p>Tax 10%</p>
                            <p class="mt-1">$854545</p>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-uppercase ">Total</td>
                        <td>$854545</td>

                    </tr>
                </table>
            </div>
            <br>
            <hr>
            <footer>
                <p class="text-grey mt-1"><span style="color: black;">on Touch</span>Lorem ipsum dolor sit amet
                    consectetur adipisicing elit</p>
                <div class="mt-1">
                    <p class="phone d-flex" style="margin-right:10px"><span><i class="fas fa-phone-alt icon-style"></i></span>
                        +972597195562</p>
                    <p class="email d-flex" style="margin-right:10px"><span><i
                                class="fas fa-envelope icon-style"></i></span> info@email.com</p>
                    <p class="website d-flex"><span><i class="fas fa-globe-americas icon-style"></i></span>
                        website@gmail.com</p>
                </div>
            </footer>
        </div>
    </div>
</div>

</body>
</html>
