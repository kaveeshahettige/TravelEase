<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/manager- dashboard style.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/businessmanager/navigation.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Business Manager Dashboard</title>
    <link rel="icon" type="<?php echo URLROOT?>/images/x-icon" href="<?php echo URLROOT?>/images/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$activePage = 'businessmanager/index'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT?>/images/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>
    
    <div class="dashboard-content">
        <h1>Overview</h1>
    </div>

    <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT?>/images/dashboard.jpg" alt="hotel Image">
            </div>
           

            <!-- Total Bookings Box -->
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
        </div>

    <div class="dashboard-subcontent">
        <?php
        $monthlyData = $data["monthlyData"];
        $monthsBooking = array_keys($monthlyData);
        $bookingCounts = array_values($monthlyData);
        ?>

        <?php
        $revenueData = $data["revenueData"];
        $monthsRevenue = array_keys($revenueData);
        $revenue = array_values($revenueData);
        ?>

        <!-- Add the canvas for the bar graph -->
        <div class="chart-container">
            <canvas id="monthlyChart" width="600" height="300"></canvas>
            <p>Bookings in each month</p>
        </div>

        <div class="chart-container">
            <canvas id="revenueChart" width="600" height="300"></canvas>
            <p>Total Revenue by Month</p>
        </div>

        <script>
            // Extracting data from the PHP arrays for booking chart
            const monthsBooking = <?php echo json_encode($monthsBooking); ?>;
            const bookingCounts = <?php echo json_encode($bookingCounts); ?>;

            // Sort the data based on months
            const bookingChartData = monthsBooking.map((month, index) => ({ month, count: bookingCounts[index] }))
                .sort((a, b) => new Date(a.month) - new Date(b.month));

            const sortedMonthsBooking = bookingChartData.map(data => data.month);
            const sortedBookingCounts = bookingChartData.map(data => data.count);

            // Monthly Chart
            const ctxMonthly = document.getElementById('monthlyChart').getContext('2d');
            const monthlyChart = new Chart(ctxMonthly, {
                type: 'bar',
                data: {
                    labels: sortedMonthsBooking,
                    datasets: [{
                        label: 'Number of Bookings in each Month',
                        data: sortedBookingCounts,
                        backgroundColor: 'rgb(255,236,179)',
                        borderColor: 'rgb(255,193,102)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>

        <script>
            // Extracting data from the PHP arrays for revenue chart
            const monthsRevenue = <?php echo json_encode($monthsRevenue); ?>;
            const revenue = <?php echo json_encode($revenue); ?>;

            // Sort the data based on months
            const revenueChartData = monthsRevenue.map((month, index) => ({ month, revenue: revenue[index] }))
                .sort((a, b) => new Date(a.month) - new Date(b.month));

            const sortedMonthsRevenue = revenueChartData.map(data => data.month);
            const sortedRevenue = revenueChartData.map(data => data.revenue);

            // Revenue Chart
            const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(ctxRevenue, {
                type: 'line', // Change the type to 'line'
                data: {
                    labels: sortedMonthsRevenue,
                    datasets: [{
                        label: 'Total Revenue',
                        data: sortedRevenue,
                        backgroundColor: 'rgb(255,236,179)',
                        borderColor: 'rgb(255,193,102)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        </script>


    </div>



    <!-- Add the PHP script to pass monthly data to JavaScript -->





</main>
</body>
</html>
