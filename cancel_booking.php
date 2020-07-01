<?php

include 'conn.php';
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $sql = "UPDATE `book_ticket` SET `status`='Cancel' WHERE `id`=$id";
    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Booking order is canceled successfully');
                window.location.href='booked_ticket_listing.php';
             </script>";
    } else {
        echo "<script>
                alert('Opps something wents wrong...!!!');
                window.location.href='booked_ticket_listing.php';
             </script>";
//        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>