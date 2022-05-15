//Pametros para Ajax
    var parametros = {
            "accion" : "mostrarTodas"
    };
    var parametros2 = {
        "accion" : "getShow"
    };

    
    $(function() {
        
        $(document).ready(function() {
            
            //Filtros
                clearInterval(myInterval)
                $("#myInput").on("keyup", function() {
                    //si el valor es vacío entonces vuelvo a interval
                    if ($("#myInput").val() == ""){
                        var count_cases = -1;
                        var myInterval2 = setInterval(function () {
                
                            $.ajax({
                                    data:  parametros,
                                    url:   'controladores/accionOrder.php?accion=mostrarTodas',
                                    type:  'get',
                                    beforeSend: function () {
                                            //$("#myTable").html("Procesando, espere por favor...");
                                    },
                                    success:  function (response) {
                                            $("#myTable").html(response);
                                            
                                            
                                    }
                            });
                            $.ajax({
                                type : "GET",
                                url : "controladores/accionOrder.php?accion=numberOrders",
                                success : function(response){
                                    if (count_cases != -1 && count_cases < response) notifications('newOrderList');
                                    if (count_cases != -1 && count_cases > response) notifications('deletedOrderList');
                                    count_cases = response;
                                }
                            });
                            //si el valor es diferente a 0, vuelvo a parar
                            if ($("#myInput").val() != ""){
                                clearInterval(myInterval2)
                            }
                            
                            
                        }, 1000); // 1 segundo
                    }else{
                        clearInterval(myInterval)
                    }
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            
            //Ajax para cargar datos y mostrarlos cada segundo

            var count_cases = -1;
            var myInterval = setInterval(function () {
                
                $.ajax({
                        data:  parametros,
                        url:   'controladores/accionOrder.php?accion=mostrarTodas',
                        type:  'get',
                        beforeSend: function () {
                                //$("#myTable").html("Procesando, espere por favor...");
                        },
                        success:  function (response) {
                                $("#myTable").html(response);
                        }
                });
                $.ajax({
                    type : "GET",
                    url : "controladores/accionOrder.php?accion=numberOrders",
                    success : function(response){
                        if (count_cases != -1 && count_cases < response) notifications('newOrderList');
                        if (count_cases != -1 && count_cases > response) notifications('deletedOrderList');
                        count_cases = response;
                    }
                });
                
            }, 1000); // 1 segundo



        });
    });
    function showStatus(id){
        var userid = $(this).data('id');

        // AJAX request
        $.ajax({
            url: 'controladores/accionOrder.php?accion=getShow&id='+id,
            type: 'get',
            data: id,
            success: function(response){ 
                $('.modal-show-body').html(response); 
                $('#showOne').modal('show'); 
            }
        });
    }

    function editStatus(id){
        var userid = $(this).data('id');

        // AJAX request
        $.ajax({
            url: 'controladores/accionOrder.php?accion=editStatus&id='+id,
            type: 'get',
            data: id,
            success: function(response){ 
                $('.modal-edit-body').html(response); 
                $('#edit').modal('show'); 
            }
        });
    }
    function saveOrder() {

        var statusO = localStorage.getItem("idSelected")
        var id = localStorage.getItem("idOrder")
        $.ajax({
            url: 'controladores/accionOrder.php?accion=edit&id='+id+'&statusO='+statusO,
            type: 'get',
            data: id, statusO,
            success: function(response){ 
                notifications("successUpdate");
                $('#edit').modal('hide'); 
            },
            error: function (response){
                notifications("errorUpdate");
            }
        });
    }
    function statusSelected(idSelected){
        var idOrder=document.getElementById('idHidden')
        localStorage.setItem('idSelected', idSelected.value);
        localStorage.setItem('idOrder', idOrder.value);
    }
    function notifications(errorCode){
        arrayMessages=['(Error) An unespected error ocurred during deleting process, please try again',
        'Order was deleted successfully!', 
        '(Error) An unespected error ocurred during updating process, please try again!' , 
        'State was changed successfully!',
        'New Order has been introduced in the list',
        'Order has been deleted in the list'];
        if (errorCode== "errorDelete") alert(arrayMessages[0]);
        if (errorCode== "successDelete") alert(arrayMessages[1]);
        if (errorCode== "errorUpdate") alert(arrayMessages[2]);
        if (errorCode== "successUpdate") alert(arrayMessages[3]);
        if (errorCode== "newOrderList") alert(arrayMessages[4]);
        if (errorCode== "deletedOrderList") alert(arrayMessages[5]);
    }             
    function DeleteOrder(id) {
        var conf = confirm("¿Está seguro, realmente desea eliminar el registro?");
        if (conf == true) {
            $.post("controladores/accionOrder.php", {
                    id: id,
                    accion: "delete"
                },
                function (data, status) {
                    if (status == "error"){
                        notifications("errorDelete");
                    }
                    if (status == "success"){
                        notifications("successDelete");
                    }
                }
            );
        }
    }

