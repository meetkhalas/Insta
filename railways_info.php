<?php
include 'header.php';
?>
<!-- / header -->
<!--content -->
<section id="content">
    <div class="wrapper pad1">
        <?php
        include 'search_railway.php';
        $from = $to = $name = $date = '';
        if (!empty($_REQUEST)) {
            $from = !empty($_REQUEST['from']) ? trim($_REQUEST['from']) : '';
            $to = !empty($_REQUEST['to']) ? trim($_REQUEST['to']) : '';
            $name = !empty($_REQUEST['name']) ? trim($_REQUEST['name']) : '';
            $date = !empty($_REQUEST['date']) ? trim($_REQUEST['date']) : '';
        }
        ?>
        <article class="col2">
            <?php
            if (!empty($from) && !empty($to)) {
//                $staff = "SELECT train_infos.*,train_infos.id As train_info_id, train_infos.name As train_info_name,train_routes.* FROM train_infos LEFT JOIN train_routes ON train_infos.id = train_routes.train_infos_id WHERE train_routes.from_route LIKE '%$from%' AND train_routes.to_route LIKE '%$to%'";
                $staff = "SELECT train_infos.*,train_infos.id As train_info_id, train_infos.name As train_info_name,train_routes.* FROM train_infos LEFT JOIN train_routes ON train_infos.id = train_routes.train_infos_id WHERE train_routes.from_route like '%" . $from . "%' AND train_routes.to_route LIKE '%" . $to . "%'";
            } elseif (!empty($name)) {
                $staff = "SELECT train_infos.*,train_infos.id As train_info_id, train_infos.name As train_info_name,train_routes.* FROM train_infos LEFT JOIN train_routes ON train_infos.id = train_routes.train_infos_id WHERE train_routes.name like '%" . $name . "%'";
            }  elseif (!empty($date)) {
                $staff = "SELECT train_infos.*,train_infos.id As train_info_id, train_infos.name As train_info_name,train_routes.* FROM train_infos LEFT JOIN train_routes ON train_infos.id = train_routes.train_infos_id WHERE train_routes.date_time like '%" . $date . "%'";
            }else {
                $staff = "SELECT train_infos.*,train_infos.id As train_info_id, train_infos.name As train_info_name,train_routes.* FROM train_infos LEFT JOIN train_routes ON train_infos.id = train_routes.train_infos_id";
            }
//            $staff = "SELECT train_infos.*,train_infos.id As train_info_id, train_infos.name As train_info_name,train_routes.*'
//                    . ' FROM train_infos LEFT JOIN train_routes ON train_infos.id = train_routes.train_infos_id WHERE train_routes.from_route LIKE '%$from%'";
            $result = mysqli_query($conn, $staff);
            $count = 0;
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <h3 class="pad_top1"><?php echo!empty($row['train_infos_name']) ? $row['train_infos_name'] : '-'; ?></h3>
                <div class="wrapper pad_bot3">
                    <figure class="left marg_right1"><img src="../Backend/images/<?php echo!empty($row['image']) ? $row['image'] : '3.png'; ?>" alt="" width="180px" height="180px"></figure>
                    <div class="cols">
                        <h4>From <?php echo!empty($row['from_route']) ? $row['from_route'] : '-'; ?></h4>
                        <ul class="list1">
                            <li> <span class="color1 right"><?php echo!empty($row['from_route']) ? $row['from_route'] : '-'; ?></span> <a href="javascript::void();">From route:</a> </li>
                            <li> <span class="color1 right"><?php echo!empty($row['to_route']) ? $row['to_route'] : '-'; ?></span> <a href="javascript::void();">To Route:</a> </li>
                            <li> <span class="color1 right"><?php echo!empty($row['total_seat']) ? $row['total_seat'] : '-'; ?></span> <a href="javascript::void();">Total Seat:</a> </li>
                            <li> <span class="color1 right"><?php echo!empty($row['price']) ? $row['price'] : '-'; ?></span> <a href="javascript::void();">Price:</a> </li>
                            <li> <span class="color1 right"><?php echo!empty($row['status']) ? $row['status'] : '-'; ?></span> <a href="javascript::void();">Status:</a> </li>
                            <li> <span class="color1 right"><?php echo!empty($row['date_time']) ? $row['date_time'] : '-'; ?></span> <a href="javascript::void();">Date:</a> </li>
                            <li> <a href="view_railways.php?id=<?php echo!empty($row['id']) ? $row['id'] : '-'; ?>">More destinations</a> </li>
                        </ul>
                    </div>
                </div>
                <?php
                if (empty($row)) {
                    echo '<h1>No Record Found..!</h1>';
                }
            }
            ?>                
        </article>
    </div>
</section>
<!--content end-->
<!--footer -->
<?php include 'footer.php'; ?>