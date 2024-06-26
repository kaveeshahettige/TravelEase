<?php
$bookingDetails = $data['bookingDetails'];
$totalAmount = $data['totalAmount'];
$invoice_number = $data['invoice_number'];
$current_date = date('Y-m-d');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            background-color: #ffffff;
        }
        .header {
            text-align: center;
        }
        .logo {
            max-width: 120px;
        }
        h1 {
            font-size: 32px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        th {
            font-weight: bold;
        }
        .total-section {
            margin-top: 30px;
            padding-top: 10px;
            border-top: 2px solid #ddd;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="header">
    <img src="http://localhost/TravelEase/public/images/TravelEase.png" alt="TravelEase Logo" class="logo">
    <h1>Invoice</h1>
</div>
<div class="invoice-details">
    <p><strong>Invoice Number:</strong><?=$invoice_number?> </p>
    <p><strong>Billed To:</strong> <?=$bookingDetails[0]->serviceprovider_name?></p>
    <p><strong>Date:</strong><?=$current_date?></p>
</div>
<table>
    <thead>
    <tr>
        <th>Traveler Name</th>
        <th>Booking Type</th>
        <th>Booking Date</th>
        <th>Check-in Date</th>
        <th>Check-out Date</th>
        <th>Service Detail</th>
        <th>Amount</th>
    </tr>
    </thead>
    <tbody>';
    <?php
    foreach ($bookingDetails as $bookingDetail){?>
    $html .= '<tr>
        <td><?=$bookingDetail->traveler_name?></td>
        <td><?=$bookingDetail->booking_type?></td>
        <td><?=$bookingDetail->bookingDate?></td>
        <td><?=$bookingDetail->startDate?></td>
        <td><?=$bookingDetail->endDate?></td>
        <td><?=$bookingDetail->service_detail?></td>
        <td>Rs<?= $bookingDetail->payment_amount?></td>
    </tr>';
    <?php } ?>
    }
    $html .= '</tbody>
</table>
<div class="total-section">
    <p><strong>Total Amount:</strong> Rs<?= $totalAmount?> </p>
    <p><strong>Commission Fee (10%):</strong> Rs<?= ($totalAmount * 0.1)?> </p>
    <p><strong>Final Payment:</strong> Rs<?=($totalAmount * 0.9)?> </p>
</div>
<div class="footer">
    <p>Thank you for your business!</p>
    <p>For any inquiries regarding this invoice, please contact TravelEase at 0701184956 or traveease@gmail.com.</p>
</div>
</body>
</html>