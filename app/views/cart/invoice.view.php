<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <style>

body, h1, h2, h3, h4, h5, h6, p, ul, ol, li, figure, figcaption, blockquote, dl, dd {
            margin: 0;
            padding: 0;
        }

        /* Box-sizing border-box for all elements */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        /* Body styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }

        /* Container styles */
        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        /* Card styles */
        .card {
            background-color: #fff;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.25rem;
            margin-bottom: 20px;
            border: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-body {
            padding: 1.25rem;
        }

        /* Button styles */
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            user-select: none;
            background-color: #007bff;
            border: 1px solid transparent;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            color: #fff;
        }

        .btn-dark {
            background-color: #343a40;
            border-color: #343a40;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        /* Table styles */
        table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        th, td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            color: #495057;
            border-bottom: 2px solid #dee2e6;
        }

        /* Badge styles */
        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .bg-success {
            background-color: #28a745;
        }

        /* Utility classes */
        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: end;
        }

        .text-gray-light {
            color: #6c757d;
        }

        .font-size-12 {
            font-size: 12px;
        }
        
    #invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .status-badge{
    color: white
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
  </style>
</head>
<body>




<div class="container" style="padding-top: 20px; padding-bottom: 100px;">
    <div class="toolbar hidden-print">
        <div class="card-body text-end">
            <button type="button" class="btn btn-dark" id="printInvoice"><i class="fa fa-print"></i> Print</button>
            <button type="button" class="btn btn-danger" id="exportPdf"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div id="invoice">
                <div class="invoice overflow-auto">
                    <!-- <h1 class="text-center">Invoice</h1> -->
                    <div style="min-width: 600px">
                        <header>
                            <div class="row">
                                <div class="col">
                                    <a target="_blank" href="https://lobianijs.com">
                                    <img id="logo" src="images/logo-udemy.png" data-holder-rendered="true" height="120" style="width: auto;" />
                                    </a>
                                </div>
                                <div class="col company-details">
                                    <h2 class="name">
                                        <a target="_blank" href="https://GeniZap.com">
                                        GeniZap
                                        </a>
                                    </h2>
                                    <div>455 Foggy Heights, AZ 85004, US</div>
                                    <div>(123) 456-789</div>
                                    <div>GeniZap.services@gmail.com</div>
                                </div>
                            </div>
                        </header>
                        <main>
                            <div class="row contacts">
                                <div class="col invoice-to">
                                    <div class="text-gray-light">INVOICE TO:</div>
                                    <h2 class="to"><?= $transaction['name']; ?></h2>
                                    <div class="address"><?= $transaction['address']; ?></div>
                                    <div class="email"><a href="mailto:".<?= $transaction['email']; ?>><?= $transaction['email']; ?></a></div>
                                </div>
                                <div class="col invoice-details">
                                    <h1 class="invoice-id">Invoice #DS0204 </h1>
                                    <h4 class="status-badge"><span class="badge bg-success font-size-12 ms-2">Paid</span></h4>
                                    <div class="date">Date of Invoice: <?= date('Y-m-d', strtotime($transaction['createdOn'])); ?></div>
                                    <div class="date">Due Date: <?= date('Y-m-d', strtotime($transaction['createdOn'] . ' +1 month')); ?></div>
                                </div>
                            </div>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-left">DESCRIPTION</th>
                                        <th class="text-right">HOUR PRICE</th>
                                        <th class="text-right">HOURS</th>
                                        <th class="text-right">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $subTotal   = 0;
                                    $quantity   = 0;
                                    $tax        = 10;
                                      
                                      foreach ($Wseats as $key => $Wseat) { 
                                        $subTotal += $Wseat['price'];
                                        $quantity += $Wseat['quantity'];
                                        ?>
                                        <tr>
                                            <td class="no"><?= $key + 1; ?></td>
                                            <td class="text-left">
                                                <h3><?= $Wseat['title']; ?></h3>
                                                <?= $Wseat['description']; ?>
                                            </td>
                                            <td class="unit">$<?= $Wseat['price']; ?></td>
                                            <td class="qty"><?= $Wseat['quantity']; ?></td>
                                            <td class="total">$<?= $Wseat['price'] * $Wseat['quantity']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">SUBTOTAL</td>
                                        <td>$<?= number_format( $subTotal, 2 ); ?>.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">TAX (+$10)</td>
                                        <td>$<?= number_format( $tax * $quantity, 2 ); ?>.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">GRAND TOTAL</td>
                                        <td>$<?= number_format( $subTotal+($tax * $quantity), 2 ); ?>.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="thanks">Thank you!</div>
                            <div class="notices">
                                <div>NOTICE:</div>
                                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                            </div>
                        </main>
                        <footer>
                            Invoice was created on a computer and is valid without the signature and seal.
                        </footer>
                    </div>
                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                    <div></div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>

<script>
    $(document).ready(function () {
        $('#printInvoice').click(function () {
            // Use html2canvas to capture the content of the container
            html2canvas($('.invoice')[0], { scale: 2 }).then(function (canvas) {
                var imgData = canvas.toDataURL('image/png');

                // Initialize jsPDF
                var pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                
                // Add the image to the PDF
                pdf.addImage(imgData, 'PNG', 10, 20, 190, 200);
                pdf.setFont('helvetica');
                pdf.setFontSize(12);

                // Save or open the PDF
                pdf.save('invoice.pdf');
            });
        });
    });
</script>



</body>
</html>



