var orderItems =Array() ;
var orderCounter = 1;
var grandTotal =0;
$(document).ready(function(){
    $('#createCustomer').click(function(){
        var name = $("#newName").val();
        var address = $("#newAddress1").val();
        address = address + "\n" + $("#newAddress2").val();
        address = address + "\n" + $("#newAddress3").val();
        var shipaddress = $("#newShipAddress1").val();
        shipaddress = shipaddress + "\n" + $("#newShipAddress2").val();
        shipaddress = shipaddress + "\n" + $("#newShipAddress3").val();
        var phonenumber = $("#newPhoneNumber").val();
        var discount = $("#newDiscount").val();
        var creditlimit = $("#newCreditLimit").val();
        var remarks = $("#newRemarks").val();

        $.ajax({
            url: "create-user.php",
            type:"POST",
            data:{name:name, address:address, shipaddress:shipaddress, phonenumber:phonenumber, 
                discount:discount, creditlimit:creditlimit, remarks:remarks},
            success: function(data){
                if (data == "Successfull"){
                    alert(data);
                    $("#newName").val('');
                    $("#newAddress1").val('');
                    $("#newAddress2").val('');
                    $("#newAddress3").val('');
                    $("#newShipAddress1").val('');
                    $("#newShipAddress2").val('');
                    $("#newShipAddress3").val('');
                    $("#newPhoneNumber").val('');
                    $("#newDiscount").val('');
                    $("#newCreditLimit").val('');
                    $("#newRemarks").val('');
                }else{
                    window.location.href = "index.php";
                }   
            }
        });
    });

    $("#searchPhoneNumber").on('input',function(e){
        var len = $('#searchPhoneNumber').val();
        len = len.length;
        if (len >5){
            var searchPhoneNumber = $('#searchPhoneNumber').val();
            var customerUpdate = "customerUpdate";
            $.ajax({
                url: "search.php",
                type: 'POST',
                data :{customerUpdate:customerUpdate, searchPhoneNumber:searchPhoneNumber},
                success: function(data){
                    $("#results").html(data);
                }
            });
        }
    });

    $('#updateCustomerData').click(function(){
        var name = $("#updateName").val();
        var address = $("#updateAddress1").val();
        address = address + "\n" + $("#updateAddress2").val();
        address = address + "\n" + $("#updateAddress3").val();
        var shipaddress = $("#updateShipAddress1").val();
        shipaddress = shipaddress + "\n" + $("#updateShipAddress2").val();
        shipaddress = shipaddress + "\n" + $("#updateShipAddress3").val();
        var phonenumber = $("#updatePhoneNumber").val();
        var discount = $("#updateDiscount").val();
        var creditlimit = $("#updateCreditLimit").val();
        var remarks = $("#updateRemarks").val(); 
        var usedcreditlimit = $('#updateUsedCreditLimit').val();
        var updateUser = "updateUser";
        var status = $('#updateStatus').val();
        var userID = $('#userID').val();

        $.ajax({
            url: "update.php",
            type: "POST",
            data: {updateUser:updateUser, name:name, address:address, shipaddress:shipaddress, phonenumber:phonenumber,
                   discount:discount, creditlimit:creditlimit, usedcreditlimit:usedcreditlimit, remarks:remarks,
                   userID:userID, status:status },
            success: function(data){
                if(data == "done"){
                    alert(data);
                    $("#updateName").val('');
                    $("#updateAddress1").val('');
                    $("#updateAddress2").val('');
                    $("#updateAddress3").val('');
                    $("#updateShipAddress1").val('');
                    $("#updateShipAddress2").val('');
                    $("#updateShipAddress3").val('');
                    $("#updatePhoneNumber").val('');
                    $("#updateDiscount").val('');
                    $("#updateCreditLimit").val('');
                    $("#updateRemarks").val('');
                    $('#updateUsedCreditLimit').val('');
                    $('#updateStatus').val('');
                    $('#userID').val('');
                    $('#searchPhoneNumber').val('');
                    $("#results").html('');
                }else{
                    alert(data);
                    window.location.href = "index.php";
                }
            }
        });
    });

    $('#orderPhone').on('input', function(e){
        var len = $('#orderPhone').val();
        len = len.length;
        if (len >5){
            var orderPhoneNumber = $('#orderPhone').val();
            var orderPhone = "orderPhone";
            $.ajax({
                url: "search.php",
                type: 'POST',
                data :{orderPhone:orderPhone, orderPhoneNumber:orderPhoneNumber},
                success: function(data){
                   $("#orderResult").html(data);
                }
            });
        }
    });

    $('#productName').on('input', function(e){
        var len = $('#productName').val();
        len = len.length;

        if(len>3){
            var searchProductName = $('#productName').val();
            var searchProduct = "productOrder";
            $.ajax({
                url:"search.php",
                type:"POST",
                data: {searchProductName:searchProductName, searchProduct:searchProduct},
                success: function(result) {
                    $('#productResult').html(result);
                }
            });
        }
    });

    $('#addItem').click(function(){
        
        var itemName = $("#orderItem").val();
        var itemID = $('#itemID').val();
        var quantity = $("#orderAvailableQuantity").val();
        var unitPrice = $("#orderUnitPrice").val();
        var qoh = $("#availableQTY").val();
        var discount = $("#customerDiscount").val();
        discount = parseFloat(discount);
        var total = parseFloat( unitPrice)* parseFloat(quantity);
        grandTotal = parseFloat(grandTotal)+total;

        if ((itemName == "") || (quantity==0)){
            alert("Please check the item fields");
            return;
        }
        $('#tableItems').append(
            '<tr>',
            '<th scope="row">'+orderCounter+'</th>',
            '<td>'+itemName+"</td>",
            '<td>'+quantity+'</td>',
            '<td>'+unitPrice+'</td>',
            '<td>'+total+'</td>',
            '</tr>'
        );
        orderCounter = parseInt(orderCounter)+1;
        orderItems = orderItems+itemID+"|"+unitPrice+"|"+qoh+"|"+quantity+"|"+itemName+"|";
        $('#orderTotal').val((grandTotal*discount)/100);
    });

    $("#placeOrder").click(function(){
        var cusID = $('#orderCustomerID').val();
        $.ajax({
            url:"place-order.php",
            type:"POST",
            data:{cusID:cusID, orderItems:orderItems},
            success:function (result){
                var win = window.open(result, '_blank');
                win.focus();
            }
        });
    });

    $('#createEmployee').click(function(){
        var newUsername = $('#newUsername').val();
        var newPassword = $('#newPassword').val();
        var newName = $('#newName').val();
        var newEmail = $('#newEmail').val();
        var newRole = $('#newRole').val();
        var newStatus = $('#newStatus').val();
        
        $.ajax({
            url:"create-employee.php",
            type:"POST",
            data:{newUsername:newUsername,newPassword:newPassword,newName:newName,newEmail:newEmail,newRole:newRole,newStatus:newStatus},
            success:function(data){
                alert(data);
            }
        });

    });
    $('#deleteEmployee').click(function(){
        var deleteUser = $("#deleteUser").val();
        var deactivateUser = "deactivateUser";

        $.ajax({
            url:"create-employee.php",
            type:"POST",
            data:{deleteUser:deleteUser,deactivateUser:deactivateUser},
            success:function(data){
                alert(data);
            }
        });
    });

    $('#addNewProduct').click(function(){
        var prodCode = $("#prodCode").val();
        var prodDesc = $("#prodDesc").val();
        var prodPrice = $("#prodPrice").val();
        var prodQOH = $("#prodQOH").val();
        var prodBo = $("#prodBo").val();

        $.ajax({
            url:"add-product.php",
            type:"POST",
            data:{prodCode:prodCode,prodDesc:prodDesc,prodPrice:prodPrice,prodQOH:prodQOH,prodBo:prodBo},
            success:function(data){
                alert(data);
            }
        });
    });

    $('#getCustomer').click(function(){
        var customerID = $('#customerID').val();
        $.ajax({
            url:"get-order.php",
            type:"POST",
            data:{customerID:customerID},
            success:function(data){
                $('#recipts').html(data);
            }
        });
    });

    $("#cancelOrder").click(function(){
        var cancelOrderID = $("#cancelOrderID").val();
        $.ajax({
            url:"cancel-order.php",
            type:"POST",
            data:{cancelOrderID:cancelOrderID},
            success:function(data){
                alert(data);
            }
        });
    });

    $('#viewInvent').click(function(){
        
        $.ajax({
            url:"inventory.php",
            type:"POST",
            data:{"temp":"temp"},
            success:function(result){
                var win = window.open(result, '_blank');
                win.focus();
            }
        });
    });

    $('#viewExplosion').click(function(){
        $.ajax({
            url:"explosion.php",
            type:"POST",
            data:{"temp":"temp"},
            success:function(result){
                var win = window.open(result, '_blank');
                win.focus();
            }
        });
    });

    $('#updateProduct').click(function(){
        var productID = $('#productID').val();
        var productQTY = $('#productQTY').val();
        $.ajax({
            url:"updateProduct.php",
            type:"POST",
            data:{productID:productID,productQTY:productQTY},
            success:function(result){
                alert(result);
            }
        });
    });

});
function loadUser(userID){
    var loadUser = "loadUser";
    var userID = userID;
    $.ajax({
        url: "search.php",
        type: "POST",
        data: {loadUser:loadUser, userID:userID},
        success: function(data){
            var obj = JSON.parse(data);
            $('#updateName').val(obj.name);
            var address = obj.address.split("\n");
            $('#updateAddress1').val(address[0]);
            $('#updateAddress2').val(address[1]);
            $('#updateAddress3').val(address[2]);
            var shipAddress = obj.shipaddress.split("\n");
            $('#updateShipAddress1').val(shipAddress[0]);
            $('#updateShipAddress2').val(shipAddress[1]);
            $('#updateShipAddress3').val(shipAddress[2]);
            $('#updatePhoneNumber').val(obj.phone);
            $('#updateDiscount').val(obj.discount);
            $('#updateCreditLimit').val(obj.credit);
            $('#updateUsedCreditLimit').val(obj.usedcredit);
            $('#updateRemarks').val(obj.remarks);
            $('#userID').val(userID);
        }
    });
}

function loadOrderCustomer(userID){
    var loadUser = "loadUser";
    var userID = userID;

    $.ajax({
        url: "search.php",
        type: "POST",
        data: {loadUser:loadUser, userID:userID},
        success: function(data){
            var obj = JSON.parse(data);
            $('#orderCustomerID').val(obj.id);
            $('#customerDiscount').val(obj.discount);
            $('#placeOrder').prop("disabled", false);
        }
    });
}

function loadItem(code, desc, price, qoh){
    $('#orderItem').val(desc);
    $('#itemID').val(code);
    $('#orderUnitPrice').val(price);
    $('#availableQTY').val(qoh);
}
