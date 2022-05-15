<div id="control" class="container">
  <p>filter, please search in all columns: </p>  
  <input class="form-control" id="myInput" type="text" placeholder="Search..">
  <br>
  <table id="tableP" class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th>Id</th>
        <th>Reference</th>
        <th>Order Data</th>
        <th>Name</th>
        <th>Surname</th>
        <th>D.Address</th>
        <th>Country</th>
        <th>Products</th>
        <th>PO State</th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody id="myTable">
    
    </tbody>
  </table>
  
</div>

<!-- Modal -->
    <div class="modal fade" id="showOne" role="dialog">
        <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Order Information</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                </div>
                <div class="modal-show-body">
                    
                </div>
                <div class="modal-footer">
                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            
        </div>
    </div>

<!-- // Modal --> 
</div>
    <div class="modal fade" id="edit" role="dialog">
        <div class="modal-dialog">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Change Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                </div>
                <div class="modal-edit-body">
                    
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="saveOrder()" class="btn btn-info">Save Order</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            
        </div>
    </div>

</div>

