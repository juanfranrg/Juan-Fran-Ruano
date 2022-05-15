<?php
class Orders
{
	static function getOrderToUpdate($id){
        include "../co/bd.php";
        $sql= "SELECT orders.id_order, orders.date_add, orders.reference, orders.total_paid, 
                address.address1, address.firstname, address.lastname, address.city, country_lang.name AS Country,
                order_state_lang.name AS orderState, order_state_lang.id_order_state
                FROM orders
                JOIN address ON address.id_address = orders.id_address_delivery
                JOIN country_lang ON country_lang.id_country = address.id_country
                JOIN order_state_lang ON order_state_lang.id_order_state = orders.current_state
                WHERE orders.id_order=$id
                ORDER BY orders.id_order DESC
        ";
        $consulta = $db->prepare($sql); 
		$consulta->execute();
        if (isset($ruta)){
            $ruta=$ruta.'<table class="table table-bordered table-striped">';
        }else{
            $ruta= '';
        }
        $ruta=$ruta.'<table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th></th>
            <th></th>
            
          </tr>
        </thead>
        <tbody id="myTable2">';
		while ($row = $consulta->fetch())
		{
            $idO=$row['id_order'];
            $idState=$row['id_order_state'];

            $sql2 = "SELECT product_name 
            FROM order_detail
            WHERE id_order = $idO";

            $sql3 = "SELECT * 
            FROM order_state_lang
            WHERE id_order_state <> $idState";

            $estados = $db->prepare($sql3);
            $estados->execute();

            $productos = $db->prepare($sql2); 
            $productos->execute();
            
			$ruta = $ruta."<tr>
            <th scope='row'>Id</th>
                <td>".$row['id_order']."</td>
            </tr>
            <tr>
                <th scope='row'>Reference</th>
                <td>".$row['reference']."</td>
            </tr>
            <tr><th scope='row'>Date</th>
                <td>".$row['date_add']."</td>
            </tr>
            <tr><th scope='row'>Name</th>
                <td>".$row['firstname']."</td>
            </tr>
            <tr><th scope='row'>Surename</th>
                <td>".$row['lastname']."</td>
            </tr>
            <tr><th scope='row'>D.Address</th>
                <td>".$row['address1']."</td>
            </tr>
            <tr><th scope='row'>Country</th>
                <td>".$row['Country']."</td>
            </tr>
            <tr><th scope='row'>Products</th>
            <td>";

            if ($productos->rowCount()){
                while ($row2 = $productos->fetch())
                {
                    $ruta=$ruta."".$row2['product_name'].", ";
                }
            }else{
                $ruta=$ruta."<span style='color:red'>No products introduced</span>";
            }
            $ruta=$ruta."</td></tr><tr><th scope='row'>Status</th><td><select onchange='statusSelected(statusO)' id='statusO' name='statusO'><option selected value=".$row['id_order_state'].">".$row['orderState']."</option>
            ";
            while ($row3 = $estados->fetch())
            {
                $ruta=$ruta."<option value=".$row3['id_order_state'].">".$row3['name']."</option>";
            }
            $ruta=$ruta."</select>
            <input type='hidden' name='idHidden' id='idHidden' value=".$idO.">
            
            </td>";
        }
        $ruta=$ruta."</tr></thead></table>";
        return $ruta;
    }

    static function getOrderShow($id){
        include "../co/bd.php";
        $sql= "SELECT orders.id_order, orders.date_add, orders.reference, orders.total_paid, 
                address.address1, address.firstname, address.lastname, address.city, country_lang.name AS Country,
                order_state_lang.name AS orderState
                FROM orders
                JOIN address ON address.id_address = orders.id_address_delivery
                JOIN country_lang ON country_lang.id_country = address.id_country
                JOIN order_state_lang ON order_state_lang.id_order_state = orders.current_state
                WHERE orders.id_order=$id
                ORDER BY orders.id_order DESC";
        $consulta = $db->prepare($sql); 
		$consulta->execute();
        
        if (isset($ruta)){
            $ruta=$ruta.'<table class="table table-bordered table-striped">';
        }else{
            $ruta= '';
        }
        $ruta=$ruta.'<table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th></th>
            <th></th>
            
          </tr>
        </thead>
        <tbody id="myTable2">';
		while ($row = $consulta->fetch())
		{
            $idO=$row['id_order'];
            $sql2 = "SELECT product_name 
            FROM order_detail
            WHERE id_order = $idO";
            $productos = $db->prepare($sql2); 
            $productos->execute();
            $ruta = $ruta."<tr>
            <th scope='row'>Id</th>
                <td>".$row['id_order']."</td>
            </tr>
            <tr>
                <th scope='row'>Reference</th>
                <td>".$row['reference']."</td>
            </tr>
            <tr><th scope='row'>Date</th>
                <td>".$row['date_add']."</td>
            </tr>
            <tr><th scope='row'>Name</th>
                <td>".$row['firstname']."</td>
            </tr>
            <tr><th scope='row'>Surename</th>
                <td>".$row['lastname']."</td>
            </tr>
            <tr><th scope='row'>D.Address</th>
                <td>".$row['address1']."</td>
            </tr>
            <tr><th scope='row'>Country</th>
                <td>".$row['Country']."</td>
            </tr>
            <tr><th scope='row'>Products</th>
            <td>";
            if ($productos->rowCount()){
                while ($row2 = $productos->fetch())
                {
                    $ruta=$ruta."".$row2['product_name'].", ";
                }
            }else{
                $ruta=$ruta."<span style='color:red'>No products introduced</span>";
            }
            $ruta=$ruta."</td></tr><tr><th scope='row'>Status</th><td>".$row['orderState']."</td>";
        }
        $ruta=$ruta."</tr></thead></table>";
        return $ruta;
    }

	static function getOrders()
    {
        include "../co/bd.php";
        $sql= "SELECT orders.id_order, orders.date_add, orders.reference, orders.total_paid, 
                address.address1, address.firstname, address.lastname, address.city, country_lang.name AS Country,
                order_state_lang.name AS orderState, order_state_lang.id_order_state
                FROM orders
                JOIN address ON address.id_address = orders.id_address_delivery
                JOIN country_lang ON country_lang.id_country = address.id_country
                JOIN order_state_lang ON order_state_lang.id_order_state = orders.current_state
                WHERE order_state_lang.name like '%pago aceptado%' or order_state_lang.name like '%preparaci%'
                ORDER BY orders.id_order DESC
        ";
        
		$consulta = $db->prepare($sql); 
		$consulta->execute();
        if ($consulta->rowCount()){
            
            $ruta="";
            while ($row = $consulta->fetch())
            {
                $idO=$row['id_order'];
                $sql2 = "SELECT product_name 
                FROM order_detail
                WHERE id_order = $idO";
                $productos = $db->prepare($sql2); 
                $productos->execute();
                
                $ruta = $ruta."<tr><td>".$row['id_order']."</td><td>".$row['reference']."</td><td>".$row['date_add']."</td>
                <td>".$row['firstname']."</td><td>".$row['lastname']."</td><td>".$row['address1']."</td><td>".$row['Country']."</td>
                <td>";
                if ($productos->rowCount()){
                    while ($row2 = $productos->fetch())
                    {
                        $ruta=$ruta."".$row2['product_name'].", ";
                    }
                }else{
                    $ruta=$ruta."<span style='color:red'>No products introduced</span>";
                }
                $ruta=$ruta."</td>
                ";
                if($row['id_order_state'] == 3){
                    $ruta=$ruta."<td><span style='color:orange'>".$row['orderState']."</span></td>
                ";
                }else{
                    $ruta=$ruta."<td><span style='color:green'>".$row['orderState']."</span></td>
                ";
                }
                $ruta=$ruta."<td><button onclick='showStatus(".$row['id_order'].")' class='btn btn-info'>Show</button></td><td><button onclick='editStatus(".$row['id_order'].")' class='btn btn-warning'>Edit</button></td><td><button onclick='DeleteOrder(".$row['id_order'].")' class='btn btn-danger'><i class='bi bi-x-square'>Delete</i></button></td></tr><tr>";
            }
            return $ruta;
        }else{
            return "No data has been introduced!";
        }
    }
    static function getNumberOrders(){
        include "../co/bd.php";
        $sql= "SELECT orders.id_order, orders.date_add, orders.reference, orders.total_paid, 
                address.address1, address.firstname, address.lastname, address.city, country_lang.name AS Country,
                order_state_lang.name AS orderState, order_state_lang.id_order_state
                FROM orders
                JOIN address ON address.id_address = orders.id_address_delivery
                JOIN country_lang ON country_lang.id_country = address.id_country
                JOIN order_state_lang ON order_state_lang.id_order_state = orders.current_state
                WHERE order_state_lang.name like '%pago aceptado%' or order_state_lang.name like '%preparaci%'
                ORDER BY orders.id_order DESC
        ";
        $orders=-1;
		$consulta = $db->prepare($sql); 
		$consulta->execute();
        if ($consulta->rowCount()){
            $orders=$consulta->rowCount();
        }
        return $orders;
    }
    static function deleteOrder($id){
        include "../co/bd.php";
        $sql1 = $db->prepare("DELETE FROM orders WHERE id_order='$id'"); 
        $sql1->execute();
        $sql2 = $db->prepare("DELETE FROM order_detail WHERE id_order='$id'"); 
        $sql2->execute();
    }
    static function updateOrderStatus($id, $statusO){
        include "../co/bd.php";
        
        $sql1 = $db->prepare("UPDATE orders SET current_state='$statusO' WHERE id_order = '$id'"); 
        $sql1->execute();
    }
	
}
?>
