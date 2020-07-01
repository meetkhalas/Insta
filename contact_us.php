<?php
include 'header.php';
$nameError = $subjectError = $emailError = $descriptionError = '';
if (isset($_REQUEST['save'])) {
    $Valid = $Check = 0;
    if (empty($_REQUEST["name"])) {
        $nameError = "*  Name is Required";
        $Valid = 1;
    } else {
        $name = $_REQUEST['name'];
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameError = "!!! Only Letters & Whitespaces are Allowed";
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
    if (empty($_REQUEST['subject'])) {
        $subjectError = "*  Subject is Required";
        $Valid = 1;
    }
    if (empty($_REQUEST['message'])) {
        $descriptionError = "*  Message is Required";
        $Valid = 1;
    }
    if ($Valid == 0) {
        $name = $_REQUEST['name'];
        $subject = $_REQUEST['subject'];
        $email = $_REQUEST['email'];
        $description = $_REQUEST['message'];
        $sql = "INSERT INTO `contact`(`name`, `subject`, `email`, `message`) VALUES ('$name','$subject','$email','$description')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Data sent successfully');
                window.location.href='contact_us.php';
             </script>";
        } else {
            echo "<script>
                alert('Opps something wents wrong...!!!');
                window.location.href='contact_us.php';
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
</style>
<!--content -->
<section id="content">
    <div class="wrapper pad1">
        <article class="col1">
            <div class="box1">
                <h2 class="top">Contact Us</h2>
                <div class="pad">
                    <div class="wrapper pad_bot1">
                        <p class="cols pad_bot2"><strong>Country:<br>
                                City:<br>
                                Address:<br>
                                Email:</strong></p>
                        <p class="color1 pad_bot2">USA<br>
                            San Diego<br>
                            Beach st. 54<br>
                            <a href="#">Railways@mail.com</a></p>
                    </div>
                </div>
                <h2>Miscellaneous Info</h2>
                <div class="pad pad_bot1">
                    <p class="pad_bot2">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inven- tore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolore ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat volup- tatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam.</p>
                </div>
            </div>
        </article>
        <article class="col2">
            <h3 class="pad_top1">Contact Form</h3>
            <form class="modal-content animate" method="post">
                <div class="container">
                    <label for="uname"><b>Name</b></label>
                    <input type="text" placeholder="Enter Name" name="name">
                    <span class="error-message"><?php echo!empty($nameError) ? $nameError : ''; ?></span><br>

                    <label for="uname"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email">
                    <span class="error-message"><?php echo!empty($emailError) ? $emailError : ''; ?></span><br>

                    <label for="uname"><b>Subject</b></label>
                    <input type="text" placeholder="Enter Subject" name="subject">
                    <span class="error-message"><?php echo!empty($subjectError) ? $subjectError : ''; ?></span><br>

                    <label for="uname"><b>Message</b></label>
                    <textarea placeholder="Enter Message" name="message" cols="5" rows="5"></textarea>

                    <span class="error-message"><?php echo!empty($descriptionError) ? $descriptionError : ''; ?></span><br>

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
