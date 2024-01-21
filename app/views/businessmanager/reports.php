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
                    <option value="hotel">Hotel</option>
                    <option value="transport">Transport Provider</option>
                    <option value="transport">Packages</option>
                </select>
            </div>

            <div class="filter-option">
                <label for="service-type">Service Provider:</label>
                <select id="service-type">
                    <option value="hotel">Hotel</option>
                    <option value="transport">User Activity</option>
                </select>
            </div>

            <div class="filter-option">
                <label for="service-type">Report Type:</label>
                <select id="service-type">
                    <option value="hotel">Money Earned</option>
                    <option value="transport">User Activity</option>
                </select>
            </div>

            <div class="filter-options">
                <div class="filter-option">
                    <label for="time-range">Time Range:</label>
                    <select id="time-range">
                        <option value="last-week">Last Week</option>
                        <option value="last-month">Last Month</option>
                        <option value="last-year">Last Year</option>
                    </select>
                </div>
            
                

                
                
            </div>
        </div>

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
                            
                        <tr>
                            <td>2023-09-15 to 2023-10-15 </td>
                            <td>Hotels</td>
                            <td>Hotel Name</td>
                            <td>Money Earned</td>
                            <td>
                                <button class="view-button">View</button>
                                <button class="download-button">Download</button>
                            </td>
                        </tr>

                        <tr>
                            <td>2023-09-15 to 2023-10-15 </td>
                            <td>Hotels</td>
                            <td>Hotel Name</td>
                            <td>Money Earned</td>
                            <td>
                                <button class="view-button">View</button>
                                <button class="download-button">Download</button>
                            </td>
                        </tr>

                        <tr>
                            <td>2023-09-15 to 2023-10-15 </td>
                            <td>Hotels</td>
                            <td>Hotel Name</td>
                            <td>Money Earned</td>
                            <td>
                                <button class="view-button">View</button>
                                <button class="download-button">Download</button>
                            </td>
                        </tr>
                          
                    </tbody>
                </table>
            </div>
        

    </main>
</body>
</html>
