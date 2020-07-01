<?php
include 'header.php';
$firstNameError = $lastNameError = $emailError = $passwordError = $conformPasswordError = $secret_question_Error = $secret_answer_Error = $phoneError = $profileError = '';

if (isset($_REQUEST['save'])) {

    $Valid = $Check = 0;
    if (empty($_REQUEST["first_name"])) {
        $firstNameError = "*  First Name is Required";
        $Valid = 1;
    } else {
        $first_name = $_REQUEST['first_name'];
        if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
            $firstNameError = "!!! Only Letters & Whitespaces are Allowed";
            $Valid = 1;
        }
    }
    if (empty($_REQUEST["last_name"])) {
        $lastNameError = "*  Last Name is Required";
        $Valid = 1;
    } else {
        $last_name = $_REQUEST['last_name'];
        if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
            $lastNameError = "!!! Only Letters & Whitespaces are Allowed";
            $Valid = 1;
        }
    }
    if (empty($_REQUEST['email'])) {
        $emailError = "*  Email is Required";
        $Valid = 1;
    } else {
        $email = $_REQUEST['email'];
        if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/", $email)) {
            $emailError = "!!! Invalid Email Format";
            $Valid = 1;
        }
    }

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

    if (empty($_REQUEST["secret_question"])) {
        $secret_question_Error = "*  Please Select Secret Question.";
        $Valid = 1;
    }

    if (empty($_REQUEST["secret_answer"])) {
        $secret_answer_Error = "*  Answer is Required.";
        $Valid = 1;
    }
    if (empty($_REQUEST["phone"])) {
        $phoneError = "* Phone no is Required";
        $Valid = 1;
    } else {
        if (strlen($_REQUEST["phone"]) != 10) {
            $phoneError = "* Invalid phone number";
            $Valid = 1;
        }
    }

    if (empty($_FILES["profile"]["name"])) {
        $avatarError = "* Profile is Required";
        $Valid = 1;
    }
    if ($Valid == 0) {
        
        $firstName = $_REQUEST["first_name"];
        $lastName = $_REQUEST["last_name"];
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"];
        $created_at = date("Y-m-d");
        $secret_question = $_REQUEST["secret_question"];
        $secret_answer = $_REQUEST["secret_answer"];
        $phone = $_REQUEST["phone"];

        if (!empty($_FILES["profile"]["name"])) {
            $file_name = $_FILES["profile"]["name"];
            $temp_name = $_FILES["profile"]["tmp_name"];
            $imgtype = $_FILES["profile"]["type"];
            $ext = $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $imagename = date("d-m-Y") . "-" . time() . "." . $ext;
        }
        $target_path = "images/" . $imagename;
        if (move_uploaded_file($temp_name, $target_path)) {
            $sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `password`, `created_at`, `secret_question`, `secret_answer`, `phone`, `profile`) VALUES ('$firstName','$lastName','$email','$password','$created_at','$secret_question','$secret_answer','$phone','$imagename')";
//echo "<pre>";print_r($sql);die;
            if (mysqli_query($conn, $sql)) {
                echo "<script>
                        alert('Registration Successfully successfully');
                        window.location.href='login.php';
                     </script>";
            } else {
                echo "<script>
                alert('Opps something wents wrong...!!!');                
             </script>";
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "<script>
                alert('Error While uploading image on the server');
                window.location.href='registration.php';
             </script>";
        }
    }
}
?>
<style>
    input,textArea,select, input[type="file"] {
        border: none;
        border-bottom: 1px solid #d6cfcf;
        margin-bottom: 20px;
        margin-top: 10px;
        width: 100%;
        outline: 0;
    }
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
    <div class="for_banners1">
        <article class="col2">            
            <form class="modal-content animate" method="post" enctype="multipart/form-data">
                <!--                <div class="imgcontainer">
                                    <span onclick="document.getElementById('id01').style.display = 'none'" class="close" title="Close Modal">&times;</span>
                                    <img src="images/banner1.jpg" alt="Avatar" class="avatar">
                                </div>-->

                <div class="container">
                    <label for="first_name"><b>First Name</b></label>
                    <input type="text" placeholder="Enter First Name" name="first_name">
                    <span class="error-message"><?php echo!empty($firstNameError) ? $firstNameError : ''; ?></span><br>

                    <label for="last_name"><b>Last Name</b></label>
                    <input type="text" placeholder="Enter Last Name" name="last_name">
                    <span class="error-message"><?php echo!empty($lastNameError) ? $lastNameError : ''; ?></span><br>

                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email">
                    <span class="error-message"><?php echo!empty($emailError) ? $emailError : ''; ?></span><br>

                    <label for="password"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password">
                    <span class="error-message"><?php echo!empty($passwordError) ? $passwordError : ''; ?></span><br>

                    <label for="password"><b>Confirm Password</b></label>
                    <input type="password" placeholder="Enter Confirm Password" name="confirm_password">
                    <span class="error-message"><?php echo!empty($conformPasswordError) ? $conformPasswordError : ''; ?></span><br>

                    <label for="phone"><b>Contact No</b></label>
                    <input type="text" placeholder="Enter Contact No" name="phone">
                    <span class="error-message"><?php echo!empty($phoneError) ? $phoneError : ''; ?></span><br>

                    <label for="profile"><b>Profile Image</b></label>
                    <input type="file" placeholder="Enter Profile Imag" name="profile">
                    <span class="error-message"><?php echo!empty($profileError) ? $profileError : ''; ?></span><br>

                    <label for="secret_question"><b>Secret Question</b></label>
                    <select name="secret_question" width="10%" class="form-control"> 
                        <option value="">Please select any secret question.</option>
                        <option value="your nick name">your nick name.</option>
                        <option value="your mother's name">your mother's name.</option> 
                        <option value="name of town where you were born">name of town where you were born.</option> 
                    </select>
                    <span class="error-message"><?php echo!empty($secret_question_Error) ? $secret_question_Error : ''; ?></span><br>

                    <label for="secret_answer"><b>Secret Answer</b></label>
                    <input type="text" placeholder="Enter Secret Answer" name="secret_answer">
                    <span class="error-message"><?php echo!empty($secret_answer_Error) ? $secret_answer_Error : ''; ?></span><br>

                    <button type="submit" name="save">Submit</button>
                </div>                
            </form>
        </article>
    </div>
</section>


<?php
include 'footer.php';
?>

