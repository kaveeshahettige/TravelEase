<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-reports.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <title>Business Manager Reports</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<?php
$activePage = 'businessmanager/reports'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
    <main>
        <div class="logo-container">
            <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
            <span class="logo-text">TravelEase</span>
        </div>
        <div class="dashboard-content">
            <h1>Reports</h1>
        </div>


        <div class="dashboard-content">
            <div class="filter-option">
                <label for="service-type">Service Type:</label>
                <select id="service-type">
                    <option value="">All</option>
                    <option value="hotel">Hotel</option>
                    <option value="transport">Transport Provider</option>
                    <option value="package">Guide</option>
                </select>
            </div>

            <div class="filter-option">
                <label for="report-type">Report Type:</label>
                <select id="report-type">
                    <option value="money-earned">Bookings</option>
                    <option value="user-activity">Financial</option>
                    <option value="money-earned">Both</option>
                </select>
            </div>

            <div class="filter-option">
                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" name="start-date">
            </div>

            <div class="filter-option">
                <label for="end-date">End Date:</label>
                <input type="date" id="end-date" name="end-date">
            </div>

            <div class="filter-option">
                <button id="generate-report-btn">Generate</button>
            </div>

        </div>

        <script src= "<?php echo URLROOT?>/public/js/businessmanager/report_generator.js"></script>

        <div class="table-content">
            <h2>Previous Reports</h2>
            <table class="booking-table">
                <thead>
                <tr>
                    <th>Time Range</th>
                    <th>Service Type</th>
                    <th>Service Provider Name</th>
                    <th>Report type</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($reports as $report): ?>
                    <tr>
                        <td><?php echo $report['time_range']; ?></td>
                        <td><?php echo $report['service_type']; ?></td>
                        <td><?php echo $report['service_provider_name']; ?></td>
                        <td><?php echo $report['report_type']; ?></td>
                        <td>
                            <button class="view-button">View</button>
                            <button class="download-button">Download</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            </div>


    </main>
</body>
</html>
