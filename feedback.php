<?php
include 'header.php';
$titleError = $descriptionError = '';
if (isset($_REQUEST['save'])) {
    $Valid = $Check = 0;
    if (empty($_REQUEST['title'])) {
        $titleError = "*  Title is Required";
        $Valid = 1;
    }
    if (empty($_REQUEST['message'])) {
        $descriptionError = "*  Description is Required";
        $Valid = 1;
    }
    if ($Valid == 0) {
        $userID = !empty($_SESSION['id']) ? $_SESSION['id'] : 0;
        $title = $_REQUEST['title'];
        $description = $_REQUEST['message'];
        $sql = "INSERT INTO `feedback`(`user_id`, `title`, `message`) VALUES ('$userID','$title','$description')";

        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Feedback sent successfully');
                window.location.href='feedback.php';
             </script>";
        } else {
            echo "<script>
                alert('Opps something wents wrong...!!!');
                window.location.href='feedback.php';
             </script>";
//            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//            die;
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
        <article class="col2">
            <h3 class="pad_top1">Feedback Form</h3>
            <form class="modal-content animate center-block" method="post">
                <div class="container">
                    <label for="uname"><b>Title</b></label>
                    <input type="text" placeholder="Enter Title" name="title">
                    <span class="error-message"><?php echo!empty($titleError) ? $titleError : ''; ?></span><br>

                    <label for="uname"><b>Description</b></label>
                    <textarea placeholder="Enter Description" name="message" cols="5" rows="5"></textarea>

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
