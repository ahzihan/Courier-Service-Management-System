<?php
include_once 'header.php';
if (isset($_POST['form_submit'])) {
  $orderID = $_GET['edit_order'];
  $obj->update_order($_POST, $orderID);
  echo "<script>window.location.assign('order_list.php')</script>";
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
          <h1 class="m-0 text-dark">Place Order</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Order</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Order</h3>
                </div>

                <form role="form" action="" method="post">
                  <div class="card-body">
                    <a href="javascript:void(0)" id="btn" class="btn bg-info">Add More</a>
                    <table class="table table-bordered">
                      <thead>
                        <tr class="bg-primary">
                          <th>Sl</th>
                          <th>Product Name</th>
                          <th width="14%">Category</th>

                          <th width="10%">Weigth</th>
                          <th width="10%">Unit Price</th>
                          <th width="8%">Quantity</th>
                          <th width="8%">Subtotal</th>
                          <th width="5px"></th>
                        </tr>
                      </thead>
                      <tbody id="tbody">
                        <?php
                        $orderID = $_GET['edit_order'];
                        $order_total = $obj->total_update_for_order($orderID);
                        $orders = $obj->order_details_update($orderID);
                        $Sl = 0;
                        while ($slg_orders = $orders->fetch_assoc()) {
                          $Sl += 1;
                        ?>
                          <tr id="tr_<?php echo $Sl ?>">
                            <td class="sl"><?php echo $Sl ?></td>
                            <td><input class="form-control" type="text" name="p_name[]" value="<?php echo $slg_orders['product'] ?>"></td>
                            <td><select class="form-control" name="cate_name[]" id="">
                                <?php
                                $result = $obj->get_category();
                                while ($row = $result['query_cate']->fetch_assoc()) { ?>
                                  <option <?php if ($slg_orders['categoryID'] == $row['categoryID']) {
                                            echo 'selected';
                                          } ?> value="<?php echo $row['categoryID'] ?>"><?php echo $row['category_name'] ?></option>
                                <?php } ?>
                              </select></td>

                            <td><input class="amount form-control" type="text" name="weight[]" value="<?php echo $slg_orders['wieght'] ?>"></td>
                            <td><input name="price[]" id="amount_<?php echo $Sl ?>" class="amount form-control" type="text" onkeyup="cal(<?php echo $Sl ?>)" value="<?php echo $slg_orders['price'] ?>"></td>
                            <td><input name="quantity[]" id="qty_<?php echo $Sl ?>" class="amount form-control" type="text" onkeyup="cal(<?php echo $Sl ?>)" value="<?php echo $slg_orders['qty'] ?>"></td>
                            <td id="total_<?php echo $Sl ?>" class="total"><?php echo $slg_orders['qty'] * $slg_orders['price']; ?></td>
                            <td><button onclick="remove_tr(<?php echo $Sl ?>)" class="btn btn-danger">x</button></td>
                          </tr>
                          <input type="hidden" name="order_details_id[]" value="<?php echo $slg_orders['id'] ?>">
                        <?php } ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <td></td>
                          <td colspan="6" id="t"><?php echo $order_total['order_total'] ?></td>
                          <td></td>
                        </tr>
                      </tfoot>
                    </table>
                    <?php
                    $update_order = $obj->get_order_update($orderID)
                    ?>
                    <div class="form-group">
                      <label for="">Customer Name</label>
                      <input value="<?php echo $update_order['customer_name'] ?>" type="text" class="form-control" name="cust_name">
                    </div>
                    <div class="form-group">
                      <label for="">Customer Phone </label>
                      <input value="<?php echo $update_order['customer_phone'] ?>" type="text" class="form-control" name="cust_phone">
                    </div>
                    <div class="form-group">
                      <label for="">Priority</label>
                      <select class="form-control" name="priority" id="">
                        <option>--select--</option>
                        <option <?php if ($update_order['priority'] == 'emergency') {
                                  echo 'selected';
                                } ?> value="emergency">Emergency</option>
                        <option <?php if ($update_order['priority'] == 'normal') {
                                  echo 'selected';
                                } ?> value="normal">normal</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Pickup Area</label>
                      <select class="form-control" name="p_area" id="">
                        <option value="">--select--</option>
                        <?php
                        $result = $obj->get_category();
                        while ($row = $result['query_area']->fetch_assoc()) { ?>
                          <option <?php if ($update_order['pickup_area'] == $row['areaID']) {
                                    echo 'selected';
                                  } ?> value="<?php echo $row['areaID'] ?>"><?php echo $row['area_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">pickup Address</label>
                      <input value="<?php echo $update_order['pickup_address'] ?>" type="text" class="form-control" name="p_add">
                    </div>
                    <div class="form-group">
                      <label for="">Delivary Area</label>
                      <select class="form-control" name="d_area" id="">
                        <option value="">--select--</option>
                        <?php
                        $result = $obj->get_category();
                        while ($row = $result['query_area']->fetch_assoc()) { ?>
                          <option <?php if ($update_order['delivery_area'] == $row['areaID']) {
                                    echo 'selected';
                                  } ?> value="<?php echo $row['areaID'] ?>"><?php echo $row['area_name'] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="">Delivary Address</label>
                      <input value="<?php echo $update_order['delivery_address'] ?>" type="text" class="form-control" name="d_add">
                    </div>

                    <div class="form-group">
                      <label for="">Order Type</label>
                      <select class="form-control" name="order_type" id="">
                        <option>--select--</option>
                        <option <?php if ($update_order['order_type'] == 'Cash on Delivery') {
                                  echo 'selected';
                                } ?> value="Cash on Delivery">Cash On delivery</option>
                        <option <?php if ($update_order['order_type'] == 'Only Delivery') {
                                  echo 'selected';
                                } ?> value="Only Delivery">Only delivery</option>
                      </select>
                    </div>




                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary" name="form_submit">Submit</button>
                    </div>
                </form>

              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </section>
</div>



<?php include_once 'footer.php'; ?>
<!-- <script src="jquery-3.5.1.min.js"></script> -->
<script>
  $(document).ready(function() {
    var i = <?php echo $Sl ?>;
    $('#btn').click(function() {
      i += 1;
      var html = '<tr id="tr_' + i + '">'
      html += '<td class="sl">' + i + '</td>'
      html += '<td><input name="p_name[]" class="form-control" type="text"></td>'

      html += '<td><select name="cate_name[]" class="form-control" name="" id="">'
      html += '<?php $result = $obj->get_category();
                while ($row = $result['query_cate']->fetch_assoc()) { ?>'
      html += '<option value="<?php echo $row['categoryID'] ?>"><?php echo $row["category_name"] ?></option>'
      html += '<?php } ?>'
      html += '</select></td>'


      html += '<td><input class="form-control" type="text" name="weight[]"></td>'
      html += '<td><input type="text" class="amount form-control" id="amount_' + i + '" onkeyup="cal(' + i + ')" value="0" name="price[]"></td>'
      html += '<td><input type="text" class="amount form-control" id="qty_' + i + '" onkeyup="cal(' + i + ')" value="0" name="quantity[]"></td>'
      html += '<td id="total_' + i + '" class="total"><?php echo $slg_orders['qty'] * $slg_orders['price']; ?></td>'
      html += '<td><button onclick="remove_tr(' + i + ')" class="btn btn-danger">x</button></td>'
      html += '</tr>'
      $('#tbody').append(html);
      var x = 1;
      $('.sl').each(function() {
        $(this).text(x);
        x += 1;

      })
      // return false
    })
    // $(document).on('focus', 'input', function() {
    //   $(this).val('');
    // })

  })

  function cal(id) {
    var price = parseFloat($('#amount_' + id).val());
    var qty = parseFloat($('#qty_' + id).val());

    $('#total_' + id).text(price * qty);
    grand_total();
  }

  function grand_total() {
    var amount = 0;
    $('.total').each(function() {
      amount += parseFloat($(this).text())
    })
    $('#t').text(amount)
  }

  function remove_tr(id) {
    $('#tr_' + id).remove()
    grand_total();
    var x = 1;
    $('.sl').each(function() {
      $(this).text(x);
      x += 1;
    })

  }
</script>