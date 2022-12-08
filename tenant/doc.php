<?php 

session_start();
include('../includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        header("content-type: application/vnd.ms-word");
        header("content-disposition: attachment; filename=downloaded.doc");
    ?>

    <center>
        <u> <h4>House Renting Contruct</h4></u>
       
    </center>
    <p>
        This is to certify that the following house is rented to the following client for the following period of time.
        </p
        <p>
            <b>House Details</b>

            <table border="1" width="100%">
                <tr>
                    <th>House Number</th>
                    <th>House Reference</th>
                    <th>Price</th>
                    <th>District</th>
                    <th>Sector</th>
                    <th>Village</th>
                    <th>Cell</th>
                    <th>Landlord</th>
                    <th>Authority Status</th>

                </tr>
                <?php
                $reference = $_GET['doc']; 
                    $sql = "SELECT *,users_table.fname as landfname,users_table.lname as landlname FROM 
                    requesttable, `tbl_house` LEFT JOIN users_table ON tbl_house.owner = users_table.uid 
                    WHERE requesttable.houseReference='$reference'";
                    $query = mysqli_query($con, $sql);
                   while ($row = mysqli_fetch_array($query)) {
                ?>
                <tr>
                    <td><?php echo $row['houseNumber']; ?></td>
                    <td><?php echo $row['houseReference']; ?></td>
                    <td><?php echo $row['price']; ?></td>
                    <td><?php echo $row['district']; ?></td>
                    <td><?php echo $row['sector']; ?></td>
                    <td><?php echo $row['village']; ?></td>
                    <td><?php echo $row['cell']; ?></td>
                    <td><?php echo $row['landlname'] ." ". $row['landfname']; ?></td>
                    <td><?php echo $row['statusAuthority']; ?></td>
                </tr>
    <?php 
    }
    ?>
</table>
        </p>
       <p>
        Tenant Details
        <table border="1" width="100%">
            <tr>
                <th>Names</th>
                <th>Phone</th>
                <th>Email</th>
                <th>ID Number</th>
            </tr>
        <?php 
            $client = $_SESSION['cID'];
            $sql = "SELECT * FROM `tbl_client` WHERE cli_id = '$client'";
            $query = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_array($query)) {
        ?>
        
            <tr>
                <td><?php echo $row['fname'] . " " .$row['lname']; ?></td>
                <td><?php echo $row['phone']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td><?php echo $row['ID_CardNumber']; ?></td>
            </tr>
       </p>
       <?php
            }
            ?>
        </table>
</body>
</html>