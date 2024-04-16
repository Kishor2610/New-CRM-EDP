<!DOCTYPE html>
<html>
<head>
    <title>Your Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .billing-info {
            width: 50%;
            float: left;
        }
        .no-border td {
            border: none;
        }
        .no-border-top {
            border-top: none;
        }
        .no-border-side {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <p>Dear <strong> {{ $invoice->customer->name }}, </strong></p>

    <p>Thank you for your recent purchase with EDHAAS DIGISOFT PRIVATE LIMITED. 
        <br>We appreciate your business. Please find below the details of your invoice:</p>


      <!-- Billing Information -->
      <table class="billing-info no-border no-border-top no-border-side ">

        <tr>
           <td><strong>Invoice Id:    </strong>#{{ 1000+$invoice->id }} </td>
       </tr>
       <td><strong>To:</strong></td>
       <tr>
           <td>{{ $invoice->customer->name }}  <br>
            Address: {{ $invoice->customer->address}} <br>
               Email: {{ $invoice->customer->email }}
           </td>
       </tr>
   </table>
   
   <table class="billing-info no-border no-border-top no-border-side ">

        <tr>
           <td><strong>Date:   </strong>{{ $invoice->created_at->format('Y-m-d') }}</td>
       </tr>
       <td><strong>From:</strong></td>
       <tr>
           <td>
            Address: EDHAAS DIGISOFT PRIVATE LIMITED <br>
               Pune, Maharastra<br>
       
               Email: <a href="mailto:contact@edhaasdigisoft.com"> contact@edhaasdigisoft.com
       </tr>
   </table>


    <!-- Order Details -->
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->price }}</td>
                    <td>{{ $sale->qty }}</td>
                    <td>{{ $sale->amount }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>

                <td></td>
                <td></td>
                <td><b>Tax</b></td>
                <td><b class="tax_id">{{ $invoice->tax }}%</b></td>
            </tr>
            <tr>

                <td></td>
                <td></td>
                <td><b>Total</b></td>
                <td><b class="total">{{ $totalAmount}}</b></td>
            </tr>

        </tfoot>

    </table>



    <p>If you have any questions or concerns regarding this invoice, feel free to contact us at <a href="mailto:contact@edhaasdigisoft.com">contact@edhaasdigisoft.com</a>.</p>

    <p>Thank you for choosing EDHAAS DIGISOFT PRIVATE LIMITED.</p>

</body>
</html>
