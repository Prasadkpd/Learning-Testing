<?php
include("connection.php");

//check cookie is set if not redirect to login page
if(!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
    echo "redirect";
    $con->close();
    exit();
}

$username = $password ="";

$username = $con->real_escape_string($_COOKIE['username']);
$password = $con->real_escape_string($_COOKIE['password']);

//get user data
$sql = "SELECT * FROM users WHERE user_uname = '$username' AND user_password = '$password' AND user_status='ACTIVE'";
$result = $con->query($sql);

if(($result->num_rows ==1)== false){
    echo "redirect";
    $con->close();
    exit();
}
$customerID = $con->real_escape_string($_POST['customerID']);
$sql ="select orders.order_by, orders.order_status, orders.order_value, orders.order_date, product.prod_desc , orders_item.qty, orders.order_no FROM orders_item, orders, product WHERE orders_item.prod_code = product.prod_code AND orders.order_no = orders_item.order_no and orders.cus_id='$customerID'";
$result = $con->query($sql);

$html = null;
$html = '
<table class="table table-striped" id="orderTable">
<thead>
<tr>
<th scope="col">Order By</th>
<th scope="col">Order Status</th>
<th scope="col">Order Value</th>
<th scope="col">order Date</th>
<th scope="col">Products</th>
<th scope="col">Quantity</th>
<th scope="col">Order Number</th>
</tr>
</thead>
<tbody>
';
while($row = $result->fetch_assoc()){
    $html .= '<tr>';
    $html .= '<td>'.$row['order_by'].'</td>';
    $html .= '<td>'.$row['order_status'].'</td>';
    $html .= '<td>'.$row['order_value'].'</td>';
    $html .= '<td>'.$row['order_date'].'</td>';
    $html .= '<td>'.$row['prod_desc'].'</td>';
    $html .= '<td>'.$row['qty'].'</td>';
    $html .= '<td>'.$row['order_no'].'</td>';
    $html .= '</tr>';
}

$html .=
'
</tbody>
</table>';
echo $html;
exit();
?>