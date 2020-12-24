<?php 
include_once 'header.php';
if (isset($_POST['product_name'])) {
  $obj->insert_stock($_POST);
  
}
?>
<?php
include_once 'left_menu.php';
?>
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add stock</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Stock</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <form action="" method="post"> <!-- form started -->

          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-primary">

                  <div class="card-header">
                    <h3 class="card-title">Select Order</h3>
                  </div>
                  <input type="hidden" value="<?php echo $_SESSION['empID'] ?>" name="empID">
                  <div class="form-group">

                    <label for=""></label>
                    <select class="form-control" name="order_id" id="order_id">
                      <option>--select order--</option>
                      <?php 
                      $data = $obj->get_orders_id();
                      while ($row = $data->fetch_assoc()) {?>
                        <option value="<?php echo $row['orderID'] ?>"><?php echo $row['code'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <!--  <hr> -->


                </div>
              </div>

            </div>
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-md-12">
                <div class="card card-info">
                  <div class="card-header">
                    <h3 class="card-title">Product's List of an Entire Order..&nbsp;&nbsp;</h3>
                    <small><em>Select order to see</em></small>
                  </div>
                  <div class="card-body">

                    <table class="table table-bordered">
                      <tr>
                        <th>Product/Quantity</th>
                        <th>Enter quantity</th>
                      </tr>
                      <tbody id="ol_show"></tbody>
                    </table>
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary" name="new_stock_submit">Submit</button>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </form>
        <div class="col-md-7">
          <div class="card card-info">
            <div class="card-header">
          <h3 class="card-title"> Available Stock</h3>
        </div>
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <th>#</th>
              <th>orderID</th>
              <th>Stock-in-date</th>
              <th>Approve By</th>
              <th>Action</th>
            </thead>
            <tbody>
              <?php 
                $i=1;
                $data = $obj->get_stock_list();
                while ($row = $data->fetch_assoc()) { ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row['orderID'] ?></td>
                <td><?php echo $row['stock_in_date'] ?></td>
                
                <td><?php echo $row['emp_name'] ?></td>
                <td>
                  <a class="btn btn-xs btn-success" href="details.php?id=<?php echo $row['orderID'] ?>">Details</a>
                </td>
              </tr>
              <?php $i+=1; } ?>
            </tbody>
          </table>
        </div>
          </div>
      </div> 
    </div>
  </div>
</section>
</div>



<?php include_once 'footer.php'; ?>
<script>
  $(document).ready(function(){
    var i=1;
    $('#btn').click(function(){
     i += 1;
     var html = '<tr id="tr_'+i+'">'
     html +='<td class="sl">'+i+'</td>'
     html +='<td><input name="p_name[]" class="form-control" type="text"></td>'
     html +='<td><input type="text" class="amount form-control" id="qty_'+i+'" onkeyup="cal('+i+')" value="0" name="quantity[]"></td>'
     html +='<td><button onclick="remove_tr('+i+')" class="btn btn-danger">x</button></td>'
     html +='</tr>'
     $('#tbody').append(html);
     var x=1;
     $('.sl').each(function(){
      $(this).text(x);
      x+=1;
      
    })
     // return false
   })
    // $(document).on('focus','input',function(){
    //   $(this).val('');
    // })




    $('#order_id').on('change',function(){
      var orderID_data = $(this).val();
      console.log(orderID_data);
      $.ajax({
        url: 'get_product_list_to_insert.php',
        method: 'post',
        data :{'orderID': orderID_data},
        dataType: 'html',
        success:function(d){
          $('#ol_show').html(d)
        }
      });
    })

  })


  function remove_tr(id){
    $('#tr_'+id).remove()
    var x=1;
    $('.sl').each(function(){
      $(this).text(x);
      x+=1;
    })

  }
</script>