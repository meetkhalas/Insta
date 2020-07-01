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
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    table, table td {
        padding: 14px;
        /* border: solid; */
        /* border-collapse: collapse; */
        font-size: 17px;
    }
</style>
<!--content -->
<section id="content">
    <div class="wrapper pad1">
        <article class="">
            <h2>Booking Details</h2>

            <table>
                <tr>
                    <th>From</th>
                    <th>To</th>
                    <th>train Class</th>
                    <th>Adult Seat</th>
                    <th>Children Seat</th>
                    <th>Total Seat</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                $id = !empty($_SESSION['id']) ? $_SESSION['id'] : 0;
                $sql = "SELECT train_routes.from_route, train_routes.to_route, book_ticket.* FROM `book_ticket` left join train_routes ON book_ticket.train_route_id = train_routes.id  WHERE user_id = '$id'";
                $result = mysqli_query($conn, $sql);
                $count = 0;
                while ($row = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <td><?php echo!empty($row['from_route']) ? $row['from_route'] : '-'; ?></td>                        
                        <td><?php echo!empty($row['to_route']) ? $row['to_route'] : '-'; ?></td>                        
                        <td><?php echo!empty($row['train_class']) ? $row['train_class'] : '-'; ?></td>                        
                        <td><?php echo!empty($row['adult_seat']) ? $row['adult_seat'] : '-'; ?></td>                        
                        <td><?php echo!empty($row['children_seat']) ? $row['children_seat'] : '-'; ?></td>                        
                        <td><?php echo!empty($row['total_seat']) ? $row['total_seat'] : '-'; ?></td>                        
                        <td><?php echo!empty($row['total_price']) ? $row['total_price'] : '-'; ?></td>                        
                        <td><?php echo!empty($row['date']) ? $row['date'] : '-'; ?></td>                        
                        <td><?php echo!empty($row['status']) ? $row['status'] : '-'; ?></td>                        
                        <td>
                            <?php
                            if ($row['status'] == 'Cancel') {
                                echo 'Booking Cancel';
                            } else {
                                ?>
                                <a href="cancel_booking.php?id=<?php echo!empty($row['id']) ? $row['id'] : '-'; ?>" class="btn btn-info">Cancel Booking</a>
                            <?php } ?>
                        </td>

                    </tr>

                    <?php
                }
                ?>
            </table>
          
        </article>
    </div>
</section>
<!--content end-->
<?php
include 'footer.php';
?>
