<?php
include 'header.php';
$passwordError = $conformPasswordError = '';
if (isset($_REQUEST['save'])) {
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
        $conformPasswordError = "*  Confirm Password is Required";
        $Valid = 1;
    } else {
        $confirmPassword = $_REQUEST['confirm_password'];
        if ($password != $confirmPassword) {
            $conformPasswordError = "*  Password Not Matched";
            $Valid = 1;
        }
    }

    if ($Valid == 0) {
        $id = !empty($_SESSION['id']) ? $_SESSION['id'] : '';
        $password = $_REQUEST['password'];
        $sql = "UPDATE users SET password='$password' WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Password change sucessfully');
                window.location.href='change_password.php';
             </script>";
        } else {
            echo "<script>
                alert('Invalid details, Please again');
                window.location.href='change_password.php';
             </script>";
        }
    }
}
?>

<style>
    .error-message{
        color: red;
        margin-left:4px;
        font-family:Cambria, 'Hoefler Text', 'Liberation Serif'
    }
    form{
        align: center !important;
    }
</style>
<!--content -->
<section id="content">
    <div class="wrapper pad1">

        <article class="col2">
            <h3 class="pad_top1">Change Password Form</h3>
            <form class="modal-content animate center-block" method="post">
                <div class="container">
                    <label for="uname"><b>Password *</b></label>
                    <input type="password" placeholder="Enter Password" name="password">
                    <span class="error-message"><?php echo!empty($passwordError) ? $passwordError : ''; ?></span><br>

                    <label for="uname"><b>Confirm Password *</b></label>
                    <input type="password" placeholder="Enter Confirm Password" name="confirm_password">
                    <span class="error-message"><?php echo!empty($conformPasswordError) ? $conformPasswordError : ''; ?></span><br>

                    <button type="submit" name="save">Submit</button>

                </div>                
            </form>
        </article>
    </div>
</section>
<!--content end-->
<?php
include 'footer.php';
?>