<?php
include 'header.php';
$emailError = $passwordError = $invalidError = '';
if (isset($_REQUEST['submit'])) {

    $Valid = 1;
    if (empty($_REQUEST['email'])) {
        $emailError = "*  Email is Required";
        $Valid = 0;
    }

    if (empty($_REQUEST['password'])) {
        $passwordError = "*  Password is Required";
        $Valid = 0;
    }

    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];

    if ($Valid == 1) {
        if ($qry = $conn->query("SELECT * FROM users WHERE email='{$email}' AND  password='{$password}'")) {
            if ($_row = $qry->fetch_assoc()) {
                $fname = isset($_row['first_name']) ? $_row['first_name'] : '';
                $lname = isset($_row['last_name']) ? $_row['last_name'] : '';
                $full_name = $fname . ' ' . $lname;
                $_SESSION['id'] = $_row['id'];
                $_SESSION['full_name'] = $full_name;
                $_SESSION['first_name'] = $fname;
                $_SESSION['last_name'] = $lname;
                $_SESSION['email'] = isset($_row['email']) ? $_row['email'] : '';
                $_SESSION['created_at'] = isset($_row['created_at']) ? $_row['created_at'] : '';
                $_SESSION['phone'] = isset($_row['phone']) ? $_row['phone'] : '';
                $_SESSION['profile'] = isset($_row['profile']) ? $_row['profile'] : '1.jpg';

                echo "<script>
                                alert('Welcome back $full_name');
                                window.location.href='index.php';
                        </script>";
            } else {
                $invalidError = 'Invalid details, Please try again';
                $Valid = 0;
//                echo "<script>
//                 alert('Invalid details, Please try again');
//                window.location.href='login.php';
//             </script>";
            }
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
                    <label for="uname"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email">
                    <span class="error-message"><?php echo!empty($emailError) ? $emailError : ''; ?></span><br>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password">
                    <span class="error-message"><?php echo!empty($passwordError) ? $passwordError : ''; ?></span><br>
                    <span class="error-message"><?php echo!empty($invalidError) ? $invalidError : ''; ?></span><br>

                    <button type="submit" name="submit">Login</button>
                    <label>
                        <input type="checkbox" checked="checked" name="remember"> Remember me
                    </label>
                </div>

                <div class="container" style="background-color:#f1f1f1">
                    <!--<button type="button" onclick="document.getElementById('id01').style.display = 'none'" class="cancelbtn">Cancel</button>-->
                    <span class="psw">Forgot <a href="forgot_password.php">password?</a></span>
                </div>
            </form>
        </article>
    </div>
</section>


<?php
include 'footer.php';
?>

