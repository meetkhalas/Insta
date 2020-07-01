<?php
include 'header.php';
$id = !empty($_SESSION['id']) ? $_SESSION['id'] : '11';
if (isset($id)) {
    $sql = "SELECT * FROM `users` WHERE `id`=$id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

$firstNameError = $lastNameError = $emailError = $phoneError = $profileError = '';

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

    if (empty($_REQUEST["phone"])) {
        $phoneError = "* Phone no is Required";
        $Valid = 1;
    } else {
        if (strlen($_REQUEST["phone"]) != 10) {
            $phoneError = "* Invalid phone number";
            $Valid = 1;
        }
    }

//    if (empty($_FILES["profile"]["name"])) {
//        $avatarError = "* Profile is Required";
//        $Valid = 1;
//    }
    if ($Valid == 0) {
        $firstName = $_REQUEST["first_name"];
        $lastName = $_REQUEST["last_name"];
        $email = $_REQUEST["email"];
        $created_at = date("Y-m-d");
        $phone = $_REQUEST["phone"];

        if (!empty($_FILES["profile"]["name"])) {
            $file_name = $_FILES["profile"]["name"];
            $temp_name = $_FILES["profile"]["tmp_name"];
            $imgtype = $_FILES["profile"]["type"];
            $ext = $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $imagename = date("d-m-Y") . "-" . time() . "." . $ext;
            $target_path = "images/" . $imagename;
            $moveFile = move_uploaded_file($temp_name, $target_path);
            if (!$moveFile) {
                echo "<script>
                alert('Error While uploading image on the server');
                window.location.href='profile.php';
             </script>";
            }
        }
        $imagename = !empty($imagename) ? $imagename : $row["profile"];
        $sql = "UPDATE `users` SET `first_name`='$firstName',`last_name`='$lastName',`email`='$email',`created_at`='$created_at',`phone`='$phone',`profile`='$imagename' WHERE `id`='$id'";
//echo "<pre>";print_r($sql);die;
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                        alert('Profile updated Successfully');
                        window.location.href='profile.php';
                     </script>";
        } else {
            echo "<script>
                alert('Opps something wents wrong...!!!');                
             </script>";
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
//    echo "<pre>";print_r($row);die;
?>
<style>
    .error-message{
        color: red;
        margin-left:4px;
        font-family:Cambria, 'Hoefler Text', 'Liberation Serif'
    }
    .img-center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 25%;
    }
</style>
<!--content -->
<section id="content">
    <div class="">
        <article class="col4">            
            <form class="modal-content animate" method="post" enctype="multipart/form-data">
                <div class="imgcontainer img-center">                        
                    <img src="images/<?php echo!empty($row['profile']) ? $row['profile'] : '' ?>" alt="Avatar" width="200px"  height="200px" class="avatar center-block">
                </div>
                <div class="container">
                    <label for="first_name"><b>First Name *</b></label>
                    <input type="text" placeholder="Enter First Name" name="first_name" value="<?php echo!empty($row['first_name']) ? $row['first_name'] : '' ?>">
                    <span class="error-message"><?php echo!empty($firstNameError) ? $firstNameError : ''; ?></span><br>

                    <label for="last_name"><b>Last Name *</b></label>
                    <input type="text" placeholder="Enter Last Name" name="last_name" value="<?php echo!empty($row['last_name']) ? $row['last_name'] : '' ?>">
                    <span class="error-message"><?php echo!empty($lastNameError) ? $lastNameError : ''; ?></span><br>

                    <label for="email"><b>Email *</b></label>
                    <input type="text" placeholder="Enter Email" name="email" value="<?php echo!empty($row['email']) ? $row['email'] : '' ?>">
                    <span class="error-message"><?php echo!empty($emailError) ? $emailError : ''; ?></span><br>

                    <label for="phone"><b>Contact No *</b></label>
                    <input type="text" placeholder="Enter Contact No" name="phone" value="<?php echo!empty($row['phone']) ? $row['phone'] : '' ?>">
                    <span class="error-message"><?php echo!empty($phoneError) ? $phoneError : ''; ?></span><br>

                    <label for="profile"><b>Profile Image *</b></label>
                    <input type="file" placeholder="Enter Profile Imag" name="profile">
                    <span class="error-message"><?php echo!empty($profileError) ? $profileError : ''; ?></span><br>

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