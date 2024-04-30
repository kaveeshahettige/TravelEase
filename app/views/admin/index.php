<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add CSS files -->
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/admin/index.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/popup.css">
    <!-- Add Chart.js script -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Add title and favicon -->
    <title>TravelEase</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/admin/x-icon" href="<?php echo URLROOT; ?>/images/admin/TravelEase.png">
    <!-- Add Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <!-- Add Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<!-- Navigation -->
<nav class="left-menu">
    <!-- User profile -->
    <div class="user-profile">
        <img src="<?php echo URLROOT; ?>/images/admin/wikum.jpg" alt="User Profile Photo">
        <span class="user-name"><?php echo ucfirst($data['fname'])?></span>
    </div>

    <!-- Search bar -->
    <div class="search-bar">
        <form action="#" method="GET">
            <input type="text" placeholder="Find a Setting">
            <button type="submit">Search</button>
        </form>
    </div>

    <!-- Navigation links -->
    <ul>
        <li><a href="<?php echo URLROOT; ?>admin/index"class="active" ><i class='bx bxs-dashboard bx-sm'></i> Overview</a></li>
        <li><a href="<?php echo URLROOT; ?>admin/request" ><i class='bx bxs-book bx-sm'></i> Requests</a></li>
        <li><a href="<?php echo URLROOT; ?>admin/traveler" ><i class='bx bx-child bx-sm'></i></i> Travelers</a></li>
        <li><a href="<?php echo URLROOT; ?>admin/hotel"><i class='bx bxs-hotel bx-sm'></i></i> Hotels</a></li>
        <li><a href="<?php echo URLROOT; ?>admin/agency"><i class='bx bxs-car bx-sm'></i> Travel Agencies </a></li>
        <li><a href="<?php echo URLROOT; ?>admin/package"><i class='bx bx-package bx-sm'></i>Guide</a></li>
        <li><a href="<?php echo URLROOT; ?>admin/settings"><i class='bx bxs-cog bx-sm'></i> Settings</a></li>
    </ul>

    <!-- Logout button -->
    <div class="logout">
        <a href="#" class="nav-button active" onclick="confirmLogout(event)"><i class='bx bxs-log-out bx-sm bx-fw'></i> Logout</a>
    </div>
</nav>

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
                <img src="<?php echo URLROOT?>/images/p.jpg" alt="hotel Image">
            </div>
            <!-- Boxes with data -->
            <div class="box">
                <h2>Total Requests</h2>
                <p><?php echo $data['nore']?></p>
            </div>
            <div class="box">
                <h2>Total Complete Bookings</h2>
                <p><?php echo $data['nocb']?></p>
            </div>
            <div class="box">
                <h2>Ongoing Bookings</h2>
                <p><?php echo $data['nob'];?></p>
            </div>
        </div>
    </div>

    <!-- Chart wrapper -->
    <div class="dashboard-sub-content">

        <div class="chart-wrapper">

            <div class="chart-container">
                <canvas id="totalDataPieChart" width="400" height="400"></canvas>
                <p>Total Data Overview (Pie Chart)</p>
            </div>
        </div>

        <script>
            // Total Data Pie Chart
            const totalDataPieLabels = ['Total Travelers', 'Total Hotels', 'Total Transport Providers', 'Total Guides'];
            const totalDataPieValues = [
                <?php echo $data['not']; ?>,
                <?php echo $data['noh']; ?>,
                <?php echo $data['noa']; ?>,
                <?php echo $data['nop']; ?>
            ];

            const ctxTotalDataPie = document.getElementById('totalDataPieChart').getContext('2d');
            const totalDataPieChart = new Chart(ctxTotalDataPie, {
                type: 'pie',
                data: {
                    labels: totalDataPieLabels,
                    datasets: [{
                        label: 'Total Data Overview',
                        data: totalDataPieValues,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)'
                        ],
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

    <!-- JavaScript for Chart -->

</main>
</body>
</html>
