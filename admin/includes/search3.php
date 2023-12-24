<?php
include 'config.php';
$searchErr = '';
$employee_details='';
if(isset($_POST['save']))
{
    if(!empty($_POST['search']))
    {
        $con=mysqli_connect("localhost","root","","carrental");
        $search = $_POST['search'];
        $query="SELECT B.BRANDNAME,U.FULLNAME FROM tblvehicles V,tblbrands B,tblbooking BK,tblusers U WHERE V.VEHICLESBRAND=B.ID AND V.ID=BK.VEHICLEID AND BK.USEREMAIL=U.EMAILID AND V.SEATINGCAPACITY='{$search}';";
        
        $employee_details = mysqli_query($con,$query);
         
    }
    else
    {
        $searchErr = "Please enter the information";
    }
    
}
 
?>
<!DOCTYPE html>
<html>
<head>
    <title>Search Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style>
        .container {
            width: 80%;
            margin: auto;
            padding: 30px;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            margin-bottom: 20px;
        }
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Car Results</h3>
        <form class="form-horizontal" action="#" method="post">
            <div class="form-group">
                <label class="control-label col-sm-4" for="search"><b>Enter Seating Capacity</b></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="search" placeholder="Search here">
                </div>
                <div class="col-sm-2">
                    <button type="submit" name="save" class="btn btn-success btn-sm">Search</button>
                </div>
            </div>
            <div class="form-group">
                <span class="error" style="color: red;">* <?php echo $searchErr; ?></span>
            </div>
        </form>
        <div class="table-responsive">
            <h3>Search Result</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>BRANDNAME</th>
                        <th>FULLNAME</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!$employee_details) {
                        echo '<tr><td colspan="2">No data found</td></tr>';
                    } else {
                        foreach ($employee_details as $key => $value) {
                            ?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>
                                <td><?php echo $value['BRANDNAME']; ?></td>
                                <td><?php echo $value['FULLNAME']; ?></td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
