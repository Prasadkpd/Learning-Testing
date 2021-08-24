<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GET USER</title>
    <style>
    table {
    width: 100%;
    border-collapse: collapse;
    }

    table, td, th {
    border: 1px solid black;
    padding: 5px;
    }

    th {text-align: left;}
    </style>

</head>
<body>
    <?php 
    
    $q = intval($_GET['q']);

    $con = new mysqli("localhost","root"," ","test");
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
          
    $sql="SELECT * FROM users WHERE id = '".$q."'";
    $result = mysqli_query($con,$sql);

    echo "<table>
    <tr>
    <th>Firstname</th>
    <th>Lastname</th>
    <th>Age</th>
    <th>Hometown</th>
    <th>Job</th>
    </tr>";
    while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row['firstName'] . "</td>";
    echo "<td>" . $row['lastName'] . "</td>";
    echo "<td>" . $row['age'] . "</td>";
    echo "<td>" . $row['hometown'] . "</td>";
    echo "<td>" . $row['job'] . "</td>";
    echo "</tr>";
    }
    echo "</table>";
    mysqli_close($con);
    
    ?>
</body>
</html>