<?php
include 'header.php';
$emailError = $passwordError = $invalidError = '';
$passwordError = $confirmPasswordError = '';
$id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : 0;
if (isset($_REQUEST['submit'])) {
    $Valid = $Check = 0;
    if (empty($_REQUEST['password'])) {
        $passwordError = "*  Password is Required";
        $Valid = 1;
    } else {
        $password = $_REQUEST['password'];
        $len = strlen($_REQUEST['password']);
        if ($len < 6) {
            $passwordError = "!!! Insert at least Six Characters";
            $Valid = 1;
        }
        if (!preg_match("/^[a-zA-Z0-9]*$/", $password)) {
            $passwordError = "!!! Invalid Password Format";
            $Valid = 1;
        }
    }
    if (empty($_REQUEST['confirm_password'])) {
        $confirmPasswordError = "*  Confirm Password is Required";
        $Valid = 1;
    } else {
        $confirmPassword = $_REQUEST['confirm_password'];
        if ($password != $confirmPassword) {
            $confirmPasswordError = "*  Password Not Matched";
            $Valid = 1;
        }
    }
    if ($Valid == 0) {
        $password = $_REQUEST['password'];
        $confirm_password = $_REQUEST['confirm_password'];
        $sql = "UPDATE `users` SET `password` ='$password' WHERE `id`='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Your password is reset sucessfully,Please login to continue');
                window.location.href='login.php';
             </script>";
        } else {
            echo "<script>
                alert('Invalid details, Please again');
                window.location.href='reset_password.php?id=$id';
             </script>";
        }
    }
}
?>
<style>
    .col2 {
        padding-left: 192px !important;

    }
    .error-message{
        color: red;
        margin-left:4px;
        font-family:Cambria, 'Hoefler Text', 'Liberation Serif'
    }
</style>
<section id="content">
    <div class="for_banners">
        <article class="col2">            
            <form class="modal-content animate" method="post">
                <!--                <div class="imgcontainer">
                                    <span onclick="document.getElementById('id01').style.display = 'none'" class="close" title="Close Modal">&times;</span>
                                    <img src="img_avatar2.png" alt="Avatar" class="avatar">
                                </div>-->

                <div class="container">
                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password">
                    <span class="error-message"><?php echo!empty($passwordError) ? $passwordError : ''; ?></span><br>

                    <label for="psw"><b>Confirm Password</b></label>
                    <input type="password" placeholder="Enter Confirm Password" name="confirm_password">
                    <span class="error-message"><?php echo!empty($confirmPasswordError) ? $confirmPasswordError : ''; ?></span><br>
                    <button type="submit" name="submit">Submit</button>
                </div>                
            </form>
        </article>
    </div>
</section>


<?php
include 'footer.php';
?>

