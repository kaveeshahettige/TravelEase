<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/reviews.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Guide Reviews</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$userData = $data['userData'];
?>
<?php
$activePage = 'packages/review'; // Set the active page dynamically based on your logic
include 'navigation.php';
?>
<main>
    <div class="logo-container">
        <img src="<?php echo URLROOT; ?>/images/hotel/TravelEase.png" alt="TravelEase Logo">
        <span class="logo-text">TravelEase</span>
    </div>

    <div class="dashboard-content">
        <h1>Reviews</h1>
    </div>

    <div class="dashboard-sub-content">
        <div class="top-boxes">
            <!-- Small Image Boxes -->
            <div class="img-box">
                <img src="<?php echo URLROOT; ?>/images/hotel/dashboard.jpg" alt="hotel Image">
            </div>


            <!-- Total Bookings Box -->
            <?php
            $bookingCount = $data["bookingCount"];
            ?>
            <div class="box">
                <h2>Total Bookings</h2>
                <p><?php echo $bookingCount;?></p>
            </div>

            <!-- Ongoing Bookings Box -->
            <?php
            $totalRevenue = $data["totalRevenue"];
            ?>
            <div class="box">
                <h2>Total Revenue</h2>
                <p><?php echo $totalRevenue;?> LKR</p>
            </div>

            <!-- Customers Box -->
            <?php
            $guestCount = $data["guestCount"];
            ?>
            <div class="box">
                <h2>Total Customers</h2>
                <p><?php echo $guestCount; ?></p>
            </div>
        </div>
    </div>

    <div class="review-content">
        <h2>Review Details</h2>
        <?php
        $reviews = $data["reviews"];
        if (!empty($reviews)) {
            foreach ($reviews as $review): ?>
                <div class="review-box">
                    <div class="review-image">
                        <?php if (!empty($review->profile_picture)): ?>
                            <img src="<?php echo URLROOT; ?>/images/hotel/<?php echo $review->profile_picture; ?>" alt="Guest Photo">
                        <?php else: ?>
                            <img src="<?php echo URLROOT; ?>/images/profile.png" alt="Default Profile Photo">
                        <?php endif; ?>
                    </div>
                    <div class="review-sub-content">
                        <h2><?php echo $review->fname; ?></h2>
                        <p>Date: <?php echo $review->time; ?></p>
                        <?php if (!empty($review->feedback)): ?>
                            <p class="review-text"><?php echo $review->feedback; ?></p>
                        <?php endif; ?>
                        <p>Rating: <?= getStarRating(!empty($review->rating) ? $review->rating : 0); ?></p>
                        <p>Date: <?= !empty($review->time) ? $review->time : "N/A"; ?></p>
                    </div>
                </div>
            <?php endforeach;
        } else {
            echo "<p>No reviews available.</p>";
        }
        ?>
    </div>



    <?php
    function getStarRating($rating) {
        $stars = '';
        for ($i = 0; $i < $rating; $i++) {
            $stars .= '<i class="bx bxs-star"></i>';
        }
        return $stars;
    }
    ?>


</main>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="modal-title"></h2>
        <p id="modal-date"></p>
        <p id="modal-review"></p>
    </div>
</div>
<script src= "<?php echo URLROOT?>/public/js/hotel/reviews.js"></script>
</body>
</html>
