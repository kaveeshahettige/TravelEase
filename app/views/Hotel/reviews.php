<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/reviews.css">
    <link rel="stylesheet" href="<?php echo URLROOT?>/css/hotel/navigation.css">
    <title>Hotel Reviews</title>
    <link rel="icon" type="<?php echo URLROOT; ?>/images/hotel/x-icon" href="<?php echo URLROOT; ?>/images/hotel/TravelEase.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
<?php
$userData= $data['basicInfo']['userData'];
?>
<?php
$activePage = 'hotel/reviews'; // Set the active page dynamically based on your logic
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
            <div class="box">
                <h2>Total Reviews</h2>
                <p>100</p>
            </div>
        
            <!-- Ongoing Bookings Box -->
            <div class="box">
                <h2>Total Bookings</h2>
                <p>100</p>
            </div>
        
            <!-- Customers Box -->
            <div class="box">
                <h2>Total Customers</h2>
                <p>50</p>
            </div>
        </div>
        </div>

        <div class="search-content">
            <div class="review-search">
                <input type="text" id="review-search" placeholder="Search for Reviews">
                <button onclick="filterReviews()">
                    <i class="bx bx-search"></i> <!-- Using the Boxicons search icon -->
                </button>
            </div>
        </div>


        <script>
            function filterReviews() {
                var input, filter, reviews, reviewBoxes, userName, reviewText, i, txtUserName, txtReviewText;
                input = document.getElementById("review-search");
                filter = input.value.toUpperCase();
                reviews = document.querySelector(".review-content");
                reviewBoxes = reviews.getElementsByClassName("review-box");

                for (i = 0; i < reviewBoxes.length; i++) {
                    userName = reviewBoxes[i].getElementsByTagName("h2")[0];
                    reviewText = reviewBoxes[i].getElementsByClassName("review-text")[0];
                    if (userName && reviewText) {
                        txtUserName = userName.textContent || userName.innerText;
                        txtReviewText = reviewText.textContent || reviewText.innerText;
                        if (txtUserName.toUpperCase().indexOf(filter) > -1 || txtReviewText.toUpperCase().indexOf(filter) > -1) {
                            reviewBoxes[i].style.display = "";
                        } else {
                            reviewBoxes[i].style.display = "none";
                        }
                    }
                }
            }
        </script>




        <div class="review-content">
            <?php
            $reviews = $data["reviews"];
//           var_dump($reviews);
            foreach ($reviews as $review): ?>
                <div class="review-box">
                    <div class="review-sub-content">
                        <div class="review-image">
                            <!-- You may want to display the actual user image if available -->
                            <img src="<?php echo URLROOT; ?>/images/hotel/wikum.jpg" alt="Guest Photo">
                        </div>
                        <h2><?= $review->fname; ?></h2>
<!--                        <p>Date: --><?php //= $review->created_at; ?><!--</p>-->
                        <p class="review-text"><?= $review->comment; ?></p>
                        <button class="read-more-btn" onclick="openModal('<?= $review->fname; ?>', '<?= $review->created_at; ?>', '<?= $review->comment; ?>')">Read More</button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>



        <div class="more-content">
            <button class="next-page-btn">More Reviews <i class='bx bx-chevron-right'></i></button>
        </div>

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
