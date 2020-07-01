<?php
include 'header.php';
$emailError = $ansError = $invalidError = '';
if (isset($_REQUEST['submit'])) {
    $Valid = 1;
    if (empty($_REQUEST['email'])) {
        $emailError = "*  Email is Required";
        $Valid = 0;
    }

    if (empty($_REQUEST['ans'])) {
        $ansError = "*  Seq Answer is Required";
        $Valid = 0;
    }

    $email = $_REQUEST['email'];
    $ans = $_REQUEST['ans'];

    if ($Valid == 1) {
        $ansRequest = !empty($_POST['ans']) ? $_POST['ans'] : "";
        $email = !empty($_POST['email']) ? $_POST['email'] : "";
        $modified = date('Y-m-d h:i:s');
        $user = "select * from users where email='$email'";
        $result = mysqli_query($conn, $user);
        $row_count = mysqli_num_rows($result);
        
        if ($row_count > 0) {
            while ($row = mysqli_fetch_array($result)) {
                $mail = $row['email'];
                $ans = $row['secret_answer'];
                $id = $row['id'];
            }
            if ($ansRequest == $ans) {
                echo "<script>
                alert('Authorize please update you password');                
             </script>";
                echo "<script>                
                window.location.href='reset_password.php?id=$id';
             </script>";
//            header("location:reset_password.php?id=$id");
            } else {
                echo "<script>
                alert('Opps something wents wrong...!!!');                
             </script>";
            }
        } else {
            echo "<script>
                alert('Opps something wents wrong...!!!');                
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
                    <label for="uname"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email">
                    <span class="error-message"><?php echo!empty($emailError) ? $emailError : ''; ?></span><br>

                    <label for="psw"><b>Seq Answer</b></label>
                    <input type="text" placeholder="Who is your favourite actor?" name="ans">
                    <span class="error-message"><?php echo!empty($ansError) ? $ansError : ''; ?></span><br>
                    <span class="error-message"><?php echo!empty($invalidError) ? $invalidError : ''; ?></span><br>
                    <button type="submit" name="submit">Sumit</button>
                </div>
            </form>
        </article>
    </div>
</section>


<?php
include 'footer.php';
?>

