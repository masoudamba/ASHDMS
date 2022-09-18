<?php
session_start();
require 'backend/db.php';
$dba = new DBA();
$db = $dba->db;

$stmt = $db->prepare("SELECT A.*, CONCAT(B.`first_name`,' ',B.`last_name`) AS parent FROM payment A INNER JOIN parents B ON A.`parent_id`=B.`id` WHERE A.`status`='paid'");
$stmt->execute();
$payments = $stmt->fetchAll(PDO::FETCH_OBJ);

?>


<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, intial-scale=1.0">
    
    <title>ASH Discipline Monitoring System</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>

</head>

<body>

        <table class="table table-md table-stripped table-bordered">
            <thead>
                <th>#</th>
                <th>Parent</th>
                <th>Phone Number</th>
                <th>Amount</th>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($payments as $payment): ?>
                    <tr>
                        <td><?php echo ($i++); ?></td>
                        <td><?php echo ($payment->parent); ?></td>
                        <td><?php echo ($payment->phone_number); ?></td>
                        <td><?php echo ($payment->amount); ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

        

        

        <div class="home-img" style="width: 500px; display: none;">

            <marquee width="90%" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                <a href="#" style="color: white;">There is no magic wand that can resolve our problems
                    the solution rest with our work and discipline</a>
            </marquee>
            <marquee width="100%" direction="right" onmouseover="this.stop();" onmouseout="this.start();">
                <a href="#" style="color: white;">Success is measured by your discipline and inner peace.</a>
            </marquee>
        </div>
</body>


</html>