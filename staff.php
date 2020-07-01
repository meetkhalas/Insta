<?php
include 'header.php';
?>

<section id="content">
    <div class="wrapper pad1">
        <?php include 'search_railway.php'; ?>
        <article class="col2">
            <h3 class="pad_top1">About Staff</h3>
            <?php
            $users = 'select * from staffs';
            $result = mysqli_query($conn, $users);
            $count = 0;
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <div class="wrapper pad_bot2">                    
                    <figure class="left marg_right1"><img src="../Backend/images/<?php echo!empty($row['avatar']) ? $row['avatar'] : 'page5_img1.jpg'; ?>" height="150px" width="150px" alt=""></figure>
                    <strong>First Name : </strong><?php echo!empty($row['first_name']) ? $row['first_name'] : ''; ?><br>
                    <strong></strong>
                    <strong>Last Name :</strong> <?php echo!empty($row['last_name']) ? $row['last_name'] : ''; ?><br>
                    <strong></strong>
                    <strong>Gender:</strong> <?php echo!empty($row['gender']) ? $row['gender'] : ''; ?><br>
                    <strong></strong>
                    <strong>Date of Birth :</strong> <?php echo!empty($row['dob']) ? $row['dob'] : ''; ?><br>
                    <strong></strong>
                    <p><strong>Description :</strong> <?php echo!empty($row['description']) ? trim($row['description']) : ''; ?><p><br>
                        <strong></strong>
                </div>
            <?php } ?>

            <h3>About Staff</h3>
            <p>Et harum quidem rerum facilis estet expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus.</p>            
        </article>
    </div>
</section>
<?php
include 'footer.php';
?>