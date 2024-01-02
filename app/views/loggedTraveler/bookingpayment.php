<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT?>css/loggedTraveler/bookingpayment.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <title>Payment</title>
    <link rel="icon" type="image/x-icon" href="<?php echo URLROOT?>/images/TravelEase_logo.png">
</head>
<body>
    <div class="payment-container">
        <div class="payment-box">
            <h2>Payment Information</h2>
            <div class="payment-gateway">
                <h3>Card Payment</h3>
                <form>
                    <label for="cardholderName">Cardholder Name:</label>
                    <input type="text" id="cardholderName" name="cardholderName" placeholder="Kaveesha Hettige" required>

                    <label for="cardNumber">Card Number:</label>
                    <input type="text" id="cardNumber" name="cardNumber" placeholder="XXXX XXXX XXXX XXXX" required>

                    <div class="expiration-date">
                        <label for="expirationMonth">Expiry Month:</label>
                        <input type="number" id="expirationMonth" name="expirationMonth" placeholder="MM" min="1" max="12" required>

                        <label for="expirationYear">Expiry Year:</label>
                        <input type="number" id="expirationYear" name="expirationYear" placeholder="YYYY" min="2023" required>
                    </div>

                    <label for="cvv">CVV:</label>
                    <input type="text" id="cvv" name="cvv" placeholder="XXX" required>

                    <!-- Payment and Cancel buttons added -->
                    <div class="buttons">
                        <button type="submit" class="payment-button">Make Payment</button>
                        <button type="button" class="cancel-button">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="booking-box">
            <h2>Booking Information</h2>
            <div class="hotel-details">
                <img src="<?php echo URLROOT?>/images/hotelroom.jpg" alt="Hotel Image">
                <p class="total">Total: Rs. 15,000</p>
                <div class="guest-info">
                    <p><strong>Full Name:</strong> Kaveesha Hettige</p>
                    <p><strong>Email Address:</strong> user@example.com</p>
                    <p><strong>Phone Number:</strong> +94 701548956</p>
                </div>

                <div class="reservation-details">
                    <p><strong>Check-in Date:</strong> January 1, 2023</p>
                    <p><strong>Check-out Date:</strong> January 5, 2023</p>
                    <p><strong>Number of Rooms:</strong> 1</p>
                    <p><strong>Number of Adults:</strong> 2</p>
                    <p><strong>Number of Children:</strong> 0</p>
                </div>

                <div class="special-requests">
                    <p><strong>Special Requests:</strong> No special requests</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
