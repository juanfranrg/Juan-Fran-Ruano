<?php
include "../clases/Orders.php";

switch ($_GET['accion'])
{
	case 'mostrarTodas':
            echo Orders::getOrders();
            break;
    case 'numberOrders':
            echo Orders::getNumberOrders();
            break;
    case 'getShow':
            if (isset($_GET['id']) != "" && isset($_GET['id'])){
                $id=$_GET['id'];
            }
            
            echo Orders::getOrderShow($id);
            break;
    case 'editStatus':
            if (isset($_GET['id']) != "" && isset($_GET['id'])){
                $id=$_GET['id'];
            }
            echo Orders::getOrderToUpdate($id);
            break;
    case 'edit':
            $id=$_GET['id'];
            $statusO=$_GET['statusO'];
            echo "ID:".$id;
            echo "Status:".$statusO;
            echo Orders::updateOrderStatus($id, $statusO);
            break;
}
if(isset($_POST['accion'])){
    switch ($_POST['accion'])
    {
        
        case 'delete':
            if (isset($_POST['id']) != "" && isset($_POST['id'])){
                $id=$_POST['id'];
            }
            echo Orders::deleteOrder($id);
            break;

    }
}

?>