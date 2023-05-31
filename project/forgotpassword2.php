<?php
if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $newpassword = md5($_POST['newpassword']);

    // Update the password
    $con = "UPDATE tblusers SET Password=:newpassword WHERE EmailId=:email AND ContactNo=:mobile";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
    $chngpwd1->bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();

    echo "<script>alert('Your password has been successfully changed');</script>";
}

// Send password reset link
if (isset($_POST['sendResetLink'])) {
    $email = $_POST['email'];

    // Generate a password reset token
    $resetToken = generateResetToken();

    // Store the password reset token in the user's record in the database
    $sql = "UPDATE tblusers SET ResetToken=:resetToken WHERE EmailId=:email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':resetToken', $resetToken, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();

    // Send the password reset link to the user's email
    sendResetLinkEmail($email, $resetToken);

    echo "<script>alert('Password reset link has been sent to your email');</script>";
}

// Function to generate a password reset token
function generateResetToken() {
    // Generate a random token
    $resetToken = bin2hex(random_bytes(32));
    return $resetToken;
}

// Function to send password reset link email
function sendResetLinkEmail($email, $resetToken) {
    // Build the reset link URL
    $resetLink = "http://example.com/reset-password.php?token=" . $resetToken;

    // Send the password reset link to the user's email address
    // You can use a library like PHPMailer or the built-in mail() function to send the email
    // Include your email sending code here
}
?>

<script type="text/javascript">
    function valid() {
        if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
            alert("New Password and Confirm Password fields do not match!");
            document.chngpwd.confirmpassword.focus();
            return false;
        }
        return true;
    }
</script>

<style>
    .gray_text {
        color: gray;
    }
</style>

<div class="modal fade" id="forgotpassword">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Password Recovery</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="forgotpassword_wrap">
                        <div class="col-md-12">
                            <form name="chngpwd" method="post" onSubmit="return valid();">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control"
                                           placeholder="Your Email address*" required="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="mobile" class="form-control"
                                           placeholder="Your Reg. Mobile*" required="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="newpassword" class="form-control"
                                           placeholder="New Password*" required="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirmpassword" class="form-control"
                                           placeholder="Confirm Password*" required="">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Reset My Password" name="update"
                                           class="btn btn-block">
                                </div>
                            </form>
                            <div class="text-center">
                                <p class="gray_text">For security reasons, we don't store your password.
                                    Your password will be reset and a new one will be sent.</p>
                                <form method="post">
                                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                                    <button type="submit" name="sendResetLink" class="btn btn-block btn-primary">Send
                                        Reset Link
                                    </button>
                                </form>
                                <p><a href="reg&login.php" data-toggle="modal" data-dismiss="modal"><i
                                                class="fa fa-angle-double-left"
                                                aria-hidden="true"></i> Back to Login</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
