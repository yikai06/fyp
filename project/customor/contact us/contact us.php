<?php

include 'database.php';
session_start();
if(isset($_POST['contactus']))
  {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $phone_number = $_POST['Phone_Number'];
    $help = $_POST['Help'];
    
    $sql = "INSERT INTO contact_form (name, email, contactnum, message) VALUES ('$name', '$email', '$phone_number', '$help')";
    
    if (mysqli_query($conn, $sql))
    {
        
        $msg="Query Sent. We will contact you shortly";
    }
    else 
    {
        $error="Something went wrong. Please try again";
    }

}
?>
<!DOCTYPE html>
<head>
    <title>Contact Form</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    <h1>Contact Us</h1>
    <form id="fcf-form-id" class="fcf-form-class" method="post" action="">
            <label for="Name" class="fcf-label">Name</label>
            <div class="fcf-input-group">
                <input type="text" id="Name" name="Name" class="fcf-form-control" required>
            </div>
        <p></p>
        <div class="fcf-form-group">
            <label for="Email" class="fcf-label">Email</label>
            <div class="fcf-input-group">
                <input type="text" id="Email" name="Email" class="fcf-form-control" required>
            </div>
        <p></p>
        <div class="fcf-form-group">
            <label for="Phone Number"class="fcf-label">Your Phone Number</label>
            <div class="fcf-input-group">
                <input type="number" id="Phone Number" name="Phone Number" class="fcf-form-control" required>
            </div>
            <p></p>
        <div class="fcf-form-group">
            <label for="Help" class="fcf-label">How Can We Help You?</label>
            <div class="fcf-input-group">
                <textarea id="Help" name="Help" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
            </div>
        </div>
        <p></p>
        <div class="fcf-form-group">
            <button type="submit" name="contactus" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Send</button>
        </div><?php if (isset($msg)) { echo $msg; } ?><?php if (isset($error)) { echo $error; } ?>
</form>   
    <h2>Contact Epic Car Rentals</h2>
    <p>At Epic Car Rentals, your questions and concerns are very important to us.</p>
    <p>For immediate assistance, please contact us during normal business hours or use the form to send us electronic mail.</p>
    <p>Jalan Merdeka Raya 23, Hatten City, Elements Mall, Ground Floor, 75000 Melaka.</p>
    
    <h3>Our Working Hours</h3>
    <p>Everyday (Monday to Sunday)</p>
    <p>10am-10pm</p>
    
</body>
</html>