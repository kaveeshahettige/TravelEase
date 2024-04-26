<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager-reports.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/bookings.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <title>Business Financial Management</title>
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
        <h1>Business Reports</h1>
    </div>

    <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT?>/images/dashboard.jpg" alt="hotel Image">
            </div>


            <?php
            $bookingsCount = $data["bookingsCount"]; ?>
            <div class="box">
                <h2>Total Bookings</h2>
                <p><?php echo $bookingsCount ?></p>
            </div>


            <!-- Ongoing Bookings Box -->
            <?php
            $OngoingCount = $data["OngoingCount"]; ?>
            <div class="box">
                <h2>Ongoing Bookings</h2>
                <p><?php echo $OngoingCount ?></p>
            </div>

            <!-- Customers Box -->
            <?php
            $guestCount = $data["guestCount"]; ?>
            <div class="box">
                <h2>Total Customers</h2>
                <p><?php echo $guestCount ?></p>
            </div>
        </div>

        <div class="report-content">
            <form id="report-form">
                <div class="filter-options">
                    <div class="filter-option">
                        <label for="report-type">Report Type:</label>
                        <select name="report-type" id="report-type">
                            <option value="booking">Booking</option>
                            <option value="guest">Guest</option>
                            <option value="hotel">Hotel</option>
                            <option value="transport">Transport provider</option>
                            <option value="guide">Tour Guide</option>
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

                    <div>
                        <button type="button" id="generate-report-btn">Generate Report</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <div class="table-content">
        <h2>Previous Reports</h2>
        <table class="booking-table">
            <thead>
            <tr>
                <th>No</th>
                <th>Report Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $reports = $data["reports"];
            foreach ($reports as $key => $report):
                ?>
                <tr>
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $report->report_type; ?></td>
                    <td><?php echo $report->start_date; ?></td>
                    <td><?php echo $report->end_date; ?></td>
                    <td><?php echo $report->created_date; ?></td>
                    <td>
                        <a href="../public/report/<?php echo $report->filename; ?>" target="_blank" class="view-button" title="View Document">
                            <i class="bx bx-show"></i>
                        </a>
                        <a href="../public/report/<?php echo $report->filename; ?>" download="<?php echo $report->filename; ?>" class="download-button" title="Download Document">
                            <i class="bx bx-download"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>





</main>
</body>
<script src= "<?php echo URLROOT?>/public/js/businessmanager/script.js"></script>
</html>
