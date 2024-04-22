<?php
$address = $data['delivery_info'];
// show($address);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Report (<?= $data['start_date'] . ' - ' . $data['end_date']  ?>)</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

    <style>
        *,
        ::before,
        ::after {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: #e5e7eb;
        }

        ::before,
        ::after {
            --tw-content: '';
        }

        html {
            line-height: 1.5;
            -webkit-text-size-adjust: 100%;
            -moz-tab-size: 4;
            tab-size: 4;
            font-family: ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
            font-feature-settings: normal;
            font-variation-settings: normal;
        }

        body {
            margin: 0;
            line-height: inherit;
        }

        hr {
            height: 0;
            color: inherit;
            border-top-width: 1px;
        }

        abbr:where([title]) {
            -webkit-text-decoration: underline dotted;
            text-decoration: underline dotted;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-size: inherit;
            font-weight: inherit;
        }

        a {
            color: inherit;
            text-decoration: inherit;
        }

        b,
        strong {
            font-weight: bolder;
        }

        code,
        kbd,
        samp,
        pre {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            font-size: 1em;
        }

        small {
            font-size: 80%;
        }

        sub,
        sup {
            font-size: 75%;
            line-height: 0;
            position: relative;
            vertical-align: baseline;
        }

        sub {
            bottom: -0.25em;
        }

        sup {
            top: -0.5em;
        }

        table {
            text-indent: 0;
            border-color: inherit;
            border-collapse: collapse;
        }

        button,
        input,
        optgroup,
        select,
        textarea {
            font-family: inherit;
            font-feature-settings: inherit;
            font-variation-settings: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0;
        }

        button,
        select {
            text-transform: none;
        }

        button,
        [type='button'],
        [type='reset'],
        [type='submit'] {
            appearance: button;
            -webkit-appearance: button;
            background-color: transparent;
            background-image: none;
        }

        :-moz-focusring {
            outline: auto;
        }

        :-moz-ui-invalid {
            box-shadow: none;
        }

        progress {
            vertical-align: baseline;
        }

        ::-webkit-inner-spin-button,
        ::-webkit-outer-spin-button {
            height: auto;
        }

        [type='search'] {
            appearance: textfield;
            -webkit-appearance: textfield;
            outline-offset: -2px;
        }

        ::-webkit-search-decoration {
            -webkit-appearance: none;
        }

        ::-webkit-file-upload-button {
            -webkit-appearance: button;
            font: inherit;
        }

        summary {
            display: list-item;
        }

        blockquote,
        dl,
        dd,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        hr,
        figure,
        p,
        pre {
            margin: 0;
        }

        fieldset {
            margin: 0;
            padding: 0;
        }

        legend {
            padding: 0;
        }

        ol,
        ul,
        menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        dialog {
            padding: 0;
        }

        textarea {
            resize: vertical;
        }

        input::placeholder,
        textarea::placeholder {
            opacity: 1;
            color: #9ca3af;
        }

        button,
        [role="button"] {
            cursor: pointer;
        }

        :disabled {
            cursor: default;
        }

        img,
        svg,
        video,
        canvas,
        audio,
        iframe,
        embed,
        object {
            display: block;
        }

        img,
        video {
            max-width: 100%;
            height: auto;
        }

        [hidden] {
            display: none;
        }

        .fixed {
            position: fixed;
        }

        .bottom-0 {
            bottom: 0px;
        }

        .left-0 {
            left: 0px;
        }

        .table {
            display: table;
        }

        .h-12 {
            height: 3rem;
        }

        .w-1\/2 {
            width: 50%;
        }

        .w-full {
            width: 100%;
        }

        .border-collapse {
            border-collapse: collapse;
        }

        .border-spacing-0 {
            --tw-border-spacing-x: 0px;
            --tw-border-spacing-y: 0px;
            border-spacing: var(--tw-border-spacing-x) var(--tw-border-spacing-y);
        }

        .whitespace-nowrap {
            white-space: nowrap;
        }

        .border-b {
            border-bottom-width: 1px;
        }

        .border-b-2 {
            border-bottom-width: 2px;
        }

        .border-r {
            border-right-width: 1px;
        }

        .border-main {
            border-color: #6D9886;
        }

        .bg-main {
            background-color: #6D9886;
        }

        .bg-slate-100 {
            background-color: #f1f5f9;
        }

        .p-3 {
            padding: 0.75rem;
        }

        .px-14 {
            padding-left: 3.5rem;
            padding-right: 3.5rem;
        }

        .px-2 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        .py-10 {
            padding-top: 2.5rem;
            padding-bottom: 2.5rem;
        }

        .py-3 {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .py-6 {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .pb-3 {
            padding-bottom: 0.75rem;
        }

        .pl-2 {
            padding-left: 0.5rem;
        }

        .pl-3 {
            padding-left: 0.75rem;
        }

        .pl-4 {
            padding-left: 1rem;
        }

        .pr-3 {
            padding-right: 0.75rem;
        }

        .pr-4 {
            padding-right: 1rem;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .align-top {
            vertical-align: top;
        }

        .text-sm {
            font-size: 0.875rem;
            line-height: 1.25rem;
        }

        .text-xs {
            font-size: 0.75rem;
            line-height: 1rem;
        }

        .font-bold {
            font-weight: 700;
        }

        .italic {
            font-style: italic;
        }

        .text-main {
            color: #6D9886;
        }

        .text-neutral-600 {
            color: #525252;
        }

        .text-neutral-700 {
            color: #404040;
        }

        .text-slate-300 {
            color: #cbd5e1;
        }

        .text-slate-400 {
            color: #94a3b8;
        }

        .text-white {
            color: #fff;
        }

        .sidebar-brand {
            margin-top: 15px;
            font-size: 26px;
            font-weight: 700;
            display: flex;
            align-items: center;
            /* justify-content: center; */
            color: #6D9886;
        }

        /* .sidebar-brand span {
            color: #404040;
        } */

        @page {
            margin: 0;
        }

        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }

        .print-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #212121;
            border: none;
            border-radius: 10px;
            color: white;
            padding: 15px 22px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }
    </style>
</head>


<body>
    <div>
        <div class="py-4">
            <div class="px-14 py-6">
                <table class="w-full border-collapse border-spacing-0">
                    <tbody>
                        <tr>
                            <td class="w-full align-top">
                                <div class="sidebar-brand">
                                    <span class="material-icons-outlined" style="font-size: 36px; padding-right:5px"> living </span> WoodCraft Furnitures
                                </div>
                            </td>

                            <td class="align-top">
                                <div class="text-sm">
                                    <table class="border-collapse border-spacing-0">
                                        <tbody>
                                            <tr>
                                                <td class="border-r pr-4">
                                                    <div>
                                                        <p class="whitespace-nowrap text-slate-400 text-right">Production Report</p>
                                                        <!-- <p class="whitespace-nowrap font-bold text-main text-right">April 26, 2023</p> -->
                                                    </div>
                                                </td>
                                                <td class="pl-4">
                                                    <div>
                                                        <p class="whitespace-nowrap text-slate-400 text-right">Start Date #</p>
                                                        <p class="whitespace-nowrap font-bold text-main text-right"><?= $data['start_date'] ?></p>
                                                    </div>
                                                </td>

                                                <td class="pl-4">
                                                    <div>
                                                        <p class="whitespace-nowrap text-slate-400 text-right">End Date #</p>
                                                        <p class="whitespace-nowrap font-bold text-main text-right"><?= $data['end_date'] ?></p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="bg-slate-100 px-14 py-6 text-sm">
                <table class="w-full border-collapse border-spacing-0">
                    <tbody>
                        <tr>
                            <td class="w-1/2 align-top">
                                <div class="text-sm text-neutral-600">
                                    <p class="font-bold">WoodCraft Furnitures</p>
                                    <p><?= $address->address_line_1.','; ?></p>
                                    <p><?= $address->address_line_2.',';?></p>
                                    <p><?= $address->city.'.'; ?></p>
                                    <p><?= $address->province.' Province'; ?></p>  
                                    <p><?= $address->zip_code; ?></p>                                                                      
                                </div>
                            </td>
                            <td class="w-1/2 align-top text-right">
                                <div class="text-sm text-neutral-600">
                                    <p class="font-bold">No of productions : <?= $data['count'] ?></p>
                                    <!-- <p class="font-bold">Customer Company</p>
                                    <p>Number: 123456789</p>
                                    <p>VAT: 23456789</p>
                                    <p>9552 Vandervort Spurs</p>
                                    <p>Paradise, 43325</p>
                                    <p>United States</p> -->
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="px-14 py-10 text-sm text-neutral-700">
                <table class="w-full border-collapse border-spacing-0">
                    <thead class="py-10">
                        <tr>

                            <!-- [production_id] => 1
                    [product_id] => 1
                    [quantity] => 10
                    [status] => completed
                    [created_at] => 2024-01-28 20:30:39
                    [updated_at] => 2024-01-28 20:47:02
                    [product_name] => MICKE Desk -->
                            <td class="border-b-2 border-main pb-3 pl-3 py-10 font-bold text-main">#</td>
                            <td class="border-b-2 border-main pb-3 pl-2 py-10 text-center font-bold text-main">Production ID</td>
                            <td class="border-b-2 border-main pb-3 pl-2 py-10 text-center font-bold text-main">Product ID</td>
                            <td class="border-b-2 border-main pb-3 pl-2 py-10 text-center font-bold text-main">Product Name
                            <td class="border-b-2 border-main pb-3 pl-2 py-10 text-center font-bold text-main">Quantity</td>
                            <td class="border-b-2 border-main pb-3 pl-2 py-10 text-center font-bold text-main">Started</td>
                            <td class="border-b-2 border-main pb-3 pl-2 py-10 text-center font-bold text-main">Completed</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pxn = $data['pxn'];
                        $i = 1;
                        // show($pxn);

                        foreach ($pxn as $production) : ?>
                            <tr>
                                <td class="border-b py-3 pl-3"><?= $i++ ?></td>
                                <td class="border-b py-3 pl-2 text-center"><?= "PXN-" . str_pad($production['production_id'], 3, '0', STR_PAD_LEFT) ?></td>
                                <td class="border-b py-3 pl-2 text-center"><?= "PRD-" . str_pad($production['product_id'], 3, '0', STR_PAD_LEFT) ?></td>
                                <td class="border-b py-3 pl-2 text-center"><?= $production['product_name'] ?></td>
                                <td class="border-b py-3 pl-2 text-center"><?= $production['quantity'] ?></td>
                                <td class="border-b py-3 pl-2 text-center"><?= $production['created_at'] ?></td>
                                <td class="border-b py-3 pl-2  text-center"><?= $production['updated_at'] ?></td>
                            </tr>

                        <?php endforeach; ?>




                        <!-- <tr>
                            <td colspan="7">
                                <table class="w-full border-collapse border-spacing-0">
                                    <tbody>
                                        <tr>
                                            <td class="w-full"></td>
                                            <td>
                                                <table class="w-full border-collapse border-spacing-0">
                                                    <tbody>
                                                        <tr>
                                                            <td class="border-b p-3">
                                                                <div class="whitespace-nowrap text-slate-400">Net total:</div>
                                                            </td>
                                                            <td class="border-b p-3 text-right">
                                                                <div class="whitespace-nowrap font-bold text-main">$320.00</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="p-3">
                                                                <div class="whitespace-nowrap text-slate-400">VAT total:</div>
                                                            </td>
                                                            <td class="p-3 text-right">
                                                                <div class="whitespace-nowrap font-bold text-main">$64.00</div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="bg-main p-3">
                                                                <div class="whitespace-nowrap font-bold text-white">Total:</div>
                                                            </td>
                                                            <td class="bg-main p-3 text-right">
                                                                <div class="whitespace-nowrap font-bold text-white">$384.00</div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>

            <!-- <div class="px-14 text-sm text-neutral-700">
                <p class="text-main font-bold">PAYMENT DETAILS</p>
                <p>Banks of Banks</p>
                <p>Bank/Sort Code: 1234567</p>
                <p>Account Number: 123456678</p>
                <p>Payment Reference: BRA-00335</p>
            </div> -->

            <!-- <div class="px-14 py-10 text-sm text-neutral-700">
                <p class="text-main font-bold">Notes</p>
                <p class="italic">Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries
                    for previewing layouts and visual mockups.</p>
                </div> -->

                <footer class="fixed bottom-0 left-0 bg-slate-100 w-full text-neutral-600 text-center text-xs py-3">
                    Woodcraft Furnitures
                    <span class="text-slate-300 px-2">|</span>
                    woodcraftfurnitureslk@gmail.com
                    <span class="text-slate-300 px-2">|</span>
                    +(94) 112435200
                </footer>
            </div>
        </div>

        <button id="printButton" class="print-button">Print</button>
</body>

<script>
    document.getElementById('printButton').addEventListener('click', function() {
        printBtn = document.getElementById('printButton');
        printBtn.style.display = 'none';
        window.print();
        printBtn.style.display = 'block';
    });
    
</script>


</html>