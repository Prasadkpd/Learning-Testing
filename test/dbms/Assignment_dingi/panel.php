<?php
include("connection.php");

//check cookie is set if not redirect to login page
if(!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
    header('Location: index.php');
}

$username = $realname = $password = $email = $lastLogin = $status = $userRole = "";

$username = $con->real_escape_string($_COOKIE['username']);
$password = $con->real_escape_string($_COOKIE['password']);

//get user data
$sql = "SELECT * FROM users WHERE user_uname = '$username' AND user_password = '$password' AND user_status='ACTIVE'";
$result = $con->query($sql);

if(($result->num_rows ==1)== false){
    header('Location: index.php');
}
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <title>Warehouse Management Panel</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--js-->
        <link rel="stylesheet" href="depend\css\bootstrap.min.css">
        <script src="depend\js\jquery.min.js"></script>
        <script src="depend\js\popper.min.js"></script>
        <script src="depend\js\bootstrap.min.js"></script>
        <script src="depend\js\crypto-js.min.js"></script>

        <script src="depend\js\panel-page.js"></script>
        <style type="text/css">
        body{ background-color:	#00FFC5;}
        </style>
    </head>
    <body>
        <div class="container-fluid p-2">
            <!-- -->
            <ul class="nav nav-pills" role="tablist">
                <li class="nav-item col-sm " >
                    <a class="nav-link active" style="padding-left: 5vw;" data-toggle="pill" href="#billing">Billing</a>
                </li>
                <li class="nav-item col-sm ">
                    <a class="nav-link" style="padding-left: 5vw;" data-toggle="pill" href="#addCustomer">New One</a>
                </li>
                <li class="nav-item col-sm ">
                    <a class="nav-link" style="padding-left: 5vw;" data-toggle="pill" href="#updateCustomer">Update</a>
                </li>
                <li class="nav-item col-sm ">
                    <a class="nav-link" style="padding-left: 5vw;" data-toggle="pill" href="#myData">My Data</a>
                </li>
                <li class="nav-item col-sm ">
                    <a class="nav-link" style="padding-left: 5vw;" data-toggle="pill" href="#inventory">Inventory</a>
                </li>
                <li class="nav-item col-sm">
                    <a class="nav-link" style="padding-left: 5vw;" data-toggle="pill" href="#admin">Admin</a>
                </li>
                <li class="nav-item col-sm">
                    <a class="nav-link" style="padding-left: 5vw;" data-toggle="pill" href="#trending">Trending</a>
                </li>
                <li class="nav-item col-sm">
                    <a class="nav-link" style="padding-left: 5vw;" data-toggle="pill" href="#viewOrders">View Orders</a>
                </li>
            </ul>
            <!-- -->
            <div class="tab-content">
                <div class="container-fluid tab-pane active " id="billing">
                    <div class="row p-2">
                        <div class="col-8 border border-primary ">
                            <h4>New Order</h4>
                            <div class="input-group mb-3">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Customer ID</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Customer Name" id="orderCustomerID">
                                    <input type="text" class="form-control" placeholder="grand Total" id="orderTotal">
                                    <input type="button" class="btn btn-primary" value="Place Order" id="placeOrder" disabled>
                                </div>
                                
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Item</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Item Name" id="orderItem">
                                <input type="hidden" value="" id="itemID">
                                <input type="hidden" value="" id="availableQTY">
                                <input type="hidden" value="" id="customerDiscount">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Quantity</span>
                                </div>
                                <input type="number" value="0" class="form-control" placeholder="Quantity" id="orderAvailableQuantity">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Unit Price</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Price" id="orderUnitPrice">
                                
                                <input type="button" class="btn btn-outline-secondary" id="addItem" value="Add">
                            </div>

                            <div class="input-group mb-3 border border-dark">
                                <table class="table table-striped" id="orderTable">
                                    <thead>
                                        <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Item Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableItems">
                                        
                                    </tbody>
                                </table>
                            </div>
                                <HR class="border border-dark">
                            <div class="col mb-3 border border-dark p-2">
                                <h5>Cancel Order</h5>
                                <input type="text" class="form-control" placeholder="Order ID" id="cancelOrderID">
                                <br>
                                <input type="button" class="btn btn-outline-danger" id="cancelOrder" value="Cancel Order">
                            </div>

                        </div>
                        
                        <div class="col-4 border border-dark p-1">
                            <div class="border border-danger p-2">
                                <h5>Search Produts</h5>
                                <input type="text" class="form-control form-control-sm" 
                                placeholder="By product name" id="productName">
                            </div>
                            <br>
                            <div class="border border-dark p-2">
                                <h5>Results</h5>
                                <div class="border p-1" id="productResult">
                                </div>
                            </div>
                            <hr class="border border-dark">
                            <div class="border border-danger p-2">
                                <h5>Search customers </h5>
                                <input type="text" class="form-control form-control-sm" 
                                placeholder="By phone number" id="orderPhone">
                            </div>
                            <br>
                            <div class="border border-dark p-2">
                                <h5>Results</h5>
                                <div class="border p-1" id="orderResult">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="tab-pane container fade" id="addCustomer">
                    <div class="col-sm">
                        <h3 style="margin-top: 3vh;">Add new customer</h3>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Name</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Customer Name" id="newName">
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Address</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Address 1" id="newAddress1">
                            <input type="text" class="form-control" placeholder="Address 2" id="newAddress2">
                            <input type="text" class="form-control" placeholder="Address 3" id="newAddress3">
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Ship Address</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Address 1" id="newShipAddress1">
                            <input type="text" class="form-control" placeholder="Address 2" id="newShipAddress2">
                            <input type="text" class="form-control" placeholder="Address 3" id="newShipAddress3">
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Phone Number</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Phone Numbers. Separate with comma" id="newPhoneNumber">
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Discount</span>
                            </div>
                            <input type="number" class="form-control" placeholder="Discont. Enter without & mark." id="newDiscount">
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Credit Limit</span>
                            </div>
                            <input type="number" class="form-control" placeholder="Credit limit" id="newCreditLimit">
                        </div>
                    </div>

                    <div class="col-sm">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Remarks</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Remarks" id="newRemarks">
                        </div>
                    </div>
                    <div class="col-sm">
                        <button type="button" class="btn btn-outline-dark" id="createCustomer">Create User</button>
                    </div>
                </div>

                <!-- update user data -->
                <div class="tab-pane container fade " id="updateCustomer">
                    <div class="row p-2">
                        <div class="col-8 border border-primary p-2">
                            <div class="col-sm">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Name</span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Customer Name" id="updateName">
                                </div>
                            </div>

                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Address</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Address 1" id="updateAddress1">
                                <input type="text" class="form-control" placeholder="Address 2" id="updateAddress2">
                                <input type="text" class="form-control" placeholder="Address 3" id="updateAddress3">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Ship Address</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Address 1" id="updateShipAddress1">
                                <input type="text" class="form-control" placeholder="Address 2" id="updateShipAddress2">
                                <input type="text" class="form-control" placeholder="Address 3" id="updateShipAddress3">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Phone Number</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Phone Numbers. Separate with comma" id="updatePhoneNumber">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Discount</span>
                                </div>
                                <input type="number" class="form-control" placeholder="Discont. Enter without & mark." id="updateDiscount">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Credit Limit</span>
                                </div>
                                <input type="number" class="form-control" placeholder="Credit limit" id="updateCreditLimit">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Used Credit Limit</span>
                                </div>
                                <input type="number" class="form-control" placeholder="Used Credit limit" id="updateUsedCreditLimit">
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Status</span>
                                </div>
                                <select id="updateStatus" class="form-control">
                                    <option value="active" selected>active</option>
                                    <option value="disabled">disable</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Remarks</span>
                                </div>
                                <input type="text" class="form-control" placeholder="Remarks" id="updateRemarks">
                                <input type="hidden" value="" id="userID">
                            </div>
                        </div>
                        <div class="col-sm">
                            <button type="button" class="btn btn-outline-dark" id="updateCustomerData">Update User</button>
                        </div>
                        </div>
                        <div class="col-4 border border-dark p-2">
                            <div class="border border-warning p-2">
                                <h5>Search customers </h5>
                                <input type="text" class="form-control form-control-sm" 
                                placeholder="By phone number" id="searchPhoneNumber">
                            </div>
                            <br>
                            <div class="border border-info p-2">
                                <h5>Results</h5>
                                <div class="border p-1" id="results">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="admin" class="tab-pane container fade ">
                    <div class="row p-2">
                        <div class="col-8 border border-primary p-2">
                            <h5>Add New User</h5>
                            <input type="text" class="form-control" placeholder="Username" id="newUsername">
                            <input type="password" class="form-control" placeholder="Password" id="newPassword">
                            <input type="text" class="form-control" placeholder="Name" id="newName">
                            <input type="email" class="form-control" placeholder="Email" id="newEmail">
                            <input type="text" class="form-control" placeholder="Role" id="newRole">
                            <input type="text" class="form-control" placeholder="Status" id="newStatus">
                            <button type="button" class="btn btn-outline-dark" id="createEmployee">Update Employee</button>
                        </div>
                    </div>
                    
                    <div class="row p-2">
                        <div class="col-8 border border-primary p-2">
                            <h5>Deactivate User</h5>
                            <input type="text" class="form-control" placeholder="Username" id="deleteUser"><br>
                            <button type="button" class="btn btn-outline-dark" id="deleteEmployee">Update Employee</button>
                        </div>
                    </div>
                </div>
                
                <div id="inventory" class="tab-pane container fade ">
                    <div class="row p-2">
                        <div class="col-8 border border-primary p-2">
                            <button type="button" class="btn btn-outline-dark" id="viewInvent">view inventory</button>
                        </div>
                    </div>
                    <div class="row p-2">
                        <div class="col-8 border border-primary p-2">
                            <button type="button" class="btn btn-outline-dark" id="viewExplosion">view Product Explosion Report</button>
                        </div>
                    </div>
                    <div class="row p-2">
                        <h5>Update product Quantity</h5><br>
                        <div class="col-8 border border-primary p-2">
                            <input type="text" class="form-control" placeholder="productID" id="productID"><br>
                            <input type="text" class="form-control" placeholder="productQTY" id="productQTY"><br>
                            
                            <button type="button" class="btn btn-outline-dark" id="updateProduct">Update</button>
                        </div>
                    </div>
                    <div class="row p-2">
                        <h5>Add Product</h5><br>
                        <div class="col-8 border border-primary p-2">
                            <input type="text" class="form-control" placeholder="Product Code" id="prodCode"><br>
                            <input type="text" class="form-control" placeholder="Product Descryption" id="prodDesc"><br>
                            <input type="text" class="form-control" placeholder="Product Price" id="prodPrice"><br>
                            <input type="text" class="form-control" placeholder="Product QOH" id="prodQOH"><br>
                            <input type="text" class="form-control" placeholder="Product BackOrder" id="prodBo" value="0"><br>
                            
                            <button type="button" class="btn btn-outline-dark" id="addNewProduct">Add Product</button>
                        </div>
                    </div>
                </div>

                <div id="myData" class="tab-pane container fade ">
                    <div class="row p-2">
                        <?php
                            $sql = "select * from users where user_uname = '$username'";
                            $result = $con->query($sql);
                            while($row = $result->fetch_assoc()){
                                $username = $row['user_uname'];
                                $name = $row['user_name'];
                                $email =$row['user_email'];
                            } 
                        ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>name</th>
                                    <th>email</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $username; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $email; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="trending" class="tab-pane container fade ">
                    <div class="row p-2">
                        <div class="col-4">
                            <h4>Trending Item</h4> 
                            <table class="table table-bordered">
                                <thead>
                                    <th>Order No</th>
                                    <th>QTY</th>
                                    <th>Product Description</th>
                                </thead>
                                <tbody>
                                    
                                
                            <?php 
                                $sql = "SELECT orders_item.order_no, orders_item.qty, orders_item.prod_code, product.prod_code, product.prod_desc, orders.order_date FROM orders_item, orders, product,produc_part WHERE orders_item.order_no = orders.order_no AND product.prod_code = produc_part.prod_code GROUP BY orders_item.prod_code ORDER by orders_item.qty desc";
                                $result = $con->query($sql);
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>";
                                    echo "<td>".$row['order_no']."</td>";
                                    echo "<td>".$row['qty']."</td>";
                                    echo "<td>".$row['prod_desc']."</td>";
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                            </table>
                        </div>
                        <div class="col-4">
                            <h4>Most wanted product part (upto now)</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <th>Total</th>
                                    <th>part No</th>
                                    <th>Part Description</th>
                                </thead>
                                <tbody>
                            <?php
                                $sql = "SELECT SUM(produc_part.qty_required), produc_part.part_no, part.part_desc FROM produc_part, part WHERE part.part_no=produc_part.part_no GROUP BY produc_part.part_no ORDER BY `SUM(produc_part.qty_required)` DESC";
                                $result = $con->query($sql);
                                while($row = $result->fetch_assoc()){
                                    echo "<tr>";
                                    echo "<td>".$row['SUM(produc_part.qty_required)']."</td>";
                                    echo "<td>".$row['part_no']."</td>";
                                    echo "<td>".$row['part_desc']."</td>";
                                    echo "</tr>";
                                }
                            ?>
                             </tbody>
                            </table>
                        </div>
                        <div class="col-4">
                            <h5>Most Order placed customer (upto now)</h5>
                            <?php
                                $sql ="select (COUNT(orders.cus_id)), customer.cus_name FROM orders, customer WHERE customer.cus_id = orders.cus_id GROUP BY orders.cus_id LIMIT 1";
                                $result = $con->query($sql);
                                while($row = $result->fetch_assoc()){
                                    echo "<p>".$row['(COUNT(orders.cus_id))']."orders by ".$row['cus_name']."</p>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="viewOrders" class="tab-pane container fade p-2">
                    <div class="col mb-3 border border-dark p-2">
                        <h5>Customer </h5>
                        <input type="text" class="form-control" placeholder="Enter Cutomer ID" id="customerID">
                        <br>
                        <input type="button" class="btn btn-outline-danger" id="getCustomer" value="Search Orders">
                    </div>
                    <div class="col mb-3 border border-dark p-2" id="recipts">
                    </div>
                </div>
            </div>
        </div>
    </body>
</HTML>