<?php
include 'header.php';
$id = !empty($_REQUEST['id']) ? $_REQUEST['id'] : '';
$airlineClassError = $adultSeatError = $dateError = '';
if (isset($id)) {
    $airline = "SELECT railway_infos.*,railway_infos.id As railway_info_id, railway_infos.name As railway_info_name,railway_routes.* FROM railway_infos LEFT JOIN railway_routes ON railway_infos.id = railway_routes.railway_infos_id WHERE railway_routes.id='$id'";
    $result = $conn->query($airline);
    $row = $result->fetch_assoc();

    $routeId = !empty($row['id']) ? $row['id'] : '';
    $booked = "SELECT SUM(total_seat) As total_seat from book_ticket WHERE airline_route_id='$routeId'";
    $bookedResult = $conn->query($booked);
    $bookedRow = $bookedResult->fetch_assoc();
echo "<pre>";print_r($bookedRow['book_ticket']);die;
}
if (isset($_REQUEST['save'])) {
    $Valid = $Check = 0;
    if (empty($_REQUEST['airline_class'])) {
        $airlineClassError = "* Railway Class is Required";
        $Valid = 1;
    }

    if (empty($_REQUEST['adult_seat'])) {
        $adultSeatError = "*  Adult Seat is Required";
        $Valid = 1;
    }

    if (empty($_REQUEST['date'])) {
        $dateError = "*  Date is Required";
        $Valid = 1;
    }
    if ($Valid == 0) {
        $userId = !empty($_SESSION['id']) ? $_SESSION['id'] : 0;
        $airline_route_id = !empty($row['id']) ? $row['id'] : 0;
        $airline_info_id = $row['airline_info_id'];
        $airline_class = $_REQUEST['airline_class'];
        $adult_seat = $_REQUEST['adult_seat'];
        $children_seat = !empty($_REQUEST['children_seat']) ? $_REQUEST['children_seat'] : 0;
        $total_seat = $adult_seat + $children_seat;
        $total_price = $total_seat * $row['price'];
        $date = $_REQUEST['date'];
        $status = "Pending";
        $sql = "INSERT INTO `book_ticket`(`user_id`,`airline_route_id`, `airline_info_id`, `airline_class`, `adult_seat`, `children_seat`, `total_seat`, `total_price`, `date`,`status`) VALUES ('$userId','$airline_route_id','$airline_info_id','$airline_class','$adult_seat','$children_seat','$total_seat','$total_price','$date','$status')";
        if (mysqli_query($conn, $sql)) {
            echo "<script>
                alert('Railways ticket is booked successfully');
                window.location.href='index.php';
             </script>";
        } else {
            echo "<script>
                alert('Opps something wents wrong...!!!');
                window.location.href='view_railways.php?id=$id';
             </script>";
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            die;
        }
    }
}
?>
<!-- / header -->
<style>

    /* Create two equal columns that floats next to each other */
    .column {
        float: left;
        width: 30%;
        /*padding: 10px;*/
    }
    .img-center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 25%;
    }
    h2.font{
        color: #006699;
    }
    .error-message{
        color: red;
        margin-left:4px;
        font-family:Cambria, 'Hoefler Text', 'Liberation Serif'
    }
</style>
<section id="content">
    <div class="imgcontainer img-center">
        <figure class="left marg_right1 "><img src="../Backend/images/<?php echo!empty($row['image']) ? $row['image'] : '3.png'; ?>" alt="" width="180px" height="180px"></figure>
    </div>
    <div class="row wrapper pad1">
        <div class="column">
            <h2><font color="#006699">From Route :</font>  <?php echo!empty($row['from_route']) ? $row['from_route'] : '-'; ?></h2>
            <h2><font color="#006699">To Route :</font>  <?php echo!empty($row['to_route']) ? $row['to_route'] : '-'; ?></h2>      
        </div>        
        <div class="column">
            <h2><font color="#006699">Economy Seat :</font> <?php echo!empty($row['economy_seat']) ? $row['economy_seat'] : '-'; ?></h2>
            <h2><font color="#006699">Business Seat :</font> <?php echo!empty($row['business_seat']) ? $row['business_seat'] : '-'; ?></h2>      
        </div>        
        <div class="column">
            <h2><font color="#006699">First Class Seat :</font> <?php echo!empty($row['first_class_seat']) ? $row['first_class_seat'] : '-'; ?></h2>
            <h2><font color="#006699">Total Seat :</font><?php echo!empty($row['total_seat']) ? $row['total_seat'] : '-'; ?></h2>      
        </div>        
        <div class="column">
            <h2><font color="#006699">Passenger Size :</font> <?php echo!empty($row['passenger_size']) ? $row['passenger_size'] : '-'; ?></h2>
            <h2> <font color="#006699">Plan Type :</font> <?php echo!empty($row['plan_type']) ? $row['plan_type'] : '-'; ?></h2>      
        </div>        
        <div class="column">
            <h2><font color="#006699">Contact No :</font> <?php echo!empty($row['contact_no']) ? $row['contact_no'] : '-'; ?></h2>
            <h2><font color="#006699">Plan Type :</font>  <?php echo!empty($row['plan_type']) ? $row['plan_type'] : '-'; ?></h2>      
        </div>        
        <div class="column">
            <h2><font color="#006699">Adult Seat :</font> <?php echo!empty($row['adult']) ? $row['adult'] : '-'; ?></h2>
            <h2><font color="#006699">Children Seat :</font>  <?php echo!empty($row['children']) ? $row['children'] : '-'; ?></h2>      
        </div>        
        <div class="column">
            <h2> <font color="#006699">Total A&C Seat :</font> <?php echo!empty($row['total']) ? $row['total'] : '-'; ?></h2>
            <h2><font color="#006699">Price :</font>  <?php echo!empty($row['price']) ? $row['price'] : '-'; ?></h2>      
        </div>        
        <div class="column">
            <h2><font color="#006699">Status :</font>  <?php echo!empty($row['status']) ? $row['status'] : '-'; ?></h2>
            <h2><font color="#006699">Name :</font>  <?php echo!empty($row['name']) ? $row['name'] : '-'; ?></h2>  
        </div>        
        <div class="column">
            <h2><font color="#006699">Date Time :</font>  <?php echo!empty($row['date_time']) ? $row['date_time'] : '-'; ?></h2>
            <h2><font color="#006699">Available Seat :</font>  <?php echo!empty($bookedRow['total_seat']) ? intval($row['total_seat'] - $bookedRow['total_seat']) : $row['total_seat']; ?></h2>

        </div>       

        <!--        <form class="modal-content animate center-block column" method="post">
                    <div class="container">
                        <button type="submit" name="save">Booked</button>
                    </div>                
                </form>-->
    </div>    
    <?php
    $availableSeat = $row['total_seat'] - $bookedRow['total_seat'];
    if (!empty($_SESSION['id'])) {
        if (!empty($availableSeat) && $row['total_seat'] > $bookedRow['total_seat']) {
            ?>
            <h4 class="pad_top1">Booked Ticket</h4>
            <form class="modal-content animate center-block" method="post">
                <div class="container">
                    <label for="uname"><b>Railway Class *</b></label>
                    <input type="text" placeholder="Enter Railway Class" name="airline_class">
                    <span class="error-message"><?php echo!empty($airlineClassError) ? $airlineClassError : ''; ?></span><br>

                    <label for="uname"><b>Adult Seat *</b></label>
                    <input type="number" placeholder="Enter Adult Seat" name="adult_seat">
                    <span class="error-message"><?php echo!empty($adultSeatError) ? $adultSeatError : ''; ?></span><br>

                    <label for="uname"><b>Children Seat</b></label>
                    <input type="number" placeholder="Enter Children Seat" name="children_seat">
                    <span class="error-message"><?php echo!empty($childrenSeatError) ? $childrenSeatError : ''; ?></span><br>

                    <label for="uname"><b>Date *</b></label>
                    <input type="date" placeholder="Enter Date" name="date">
                    <span class="error-message"><?php echo!empty($dateError) ? $dateError : ''; ?></span><br>

                    <button type="submit" name="save">Submit</button>
                </div>                
            </form>
            <?php
        } else {
            echo '<h2 class="pad_top1">Sorry this flight has full.</h2>';
        }
    } else {
        echo '<h2 class="pad_top1">Please login and booked your tickets.</h2>';
    }
    ?>

</section>
<!--content end-->
<!--footer -->
<?php
include 'footer.php';
?>