
  <?php
include_once 'header.php';
  ?>
  <!-- Main Sidebar Container Starts here-->
  <?php
include_once 'left_menu.php';
  ?>
  <!-- Main Sidebar Container Ends here-->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Delivery Man's</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Delivery man</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Delivery Man Table</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px">#ID</th>
                      <th>Name</th>
                      <th>Total Delivered</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                  $i=1;
                    $data=$obj->get_all_delivered();
                    while($row=$data->fetch_assoc()){
                  ?>
                    <tr>
                      <td><?php echo $i++;?></td>
                      <td><?php echo $row['d_name']?></td>
                      <td><?php echo $row['total']?></td>
                      <td><a href="delivery_man_report.php?id=<?php echo $row['dID']?>" class="btn btn-xs btn-warning"><i class="fas fa-eye"></i></a></td>
                    </tr>
                    <?php 
                        }      
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              </div>
            </div>
           
          </div>
        </div>
        <!-- /.row -->
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include_once 'footer.php'; ?>