<?php $this->load->view('all_header');?>

<?php $this->load->view('all_nav_top');?>

<div class="container-fluid">
  <div class="row">

	<?php $this->load->view('all_nav_left');?>

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
	
		<div style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor">
			<div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div>
			<div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div>
		</div>
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2">Dashboard</h1>
			<div class="btn-toolbar mb-2 mb-md-0">
			  <div class="btn-group mr-2">
				<button class="btn btn-sm btn-outline-secondary">Share</button>
				<button class="btn btn-sm btn-outline-secondary">Export</button>
			  </div>
			  <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
				This week
			  </button>
			</div>
		</div>

		<canvas class="my-4 w-100 chartjs-render-monitor" id="myChart" width="1076" height="454" style="display: block; width: 1076px; height: 454px;"></canvas>

		<h2>Section title</h2>
		<div class="table-responsive">
			<table class="table table-striped table-sm">
			  <thead>
				<tr>
				  <th>#</th>
				  <th>Header</th>
				  <th>Header</th>
				  <th>Header</th>
				  <th>Header</th>
				</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td>1,001</td>
				  <td>Lorem</td>
				  <td>ipsum</td>
				  <td>dolor</td>
				  <td>sit</td>
				</tr>
				<tr>
				  <td>1,002</td>
				  <td>amet</td>
				  <td>consectetur</td>
				  <td>adipiscing</td>
				  <td>elit</td>
				</tr>
				<tr>
				  <td>1,003</td>
				  <td>Integer</td>
				  <td>nec</td>
				  <td>odio</td>
				  <td>Praesent</td>
				</tr>
				<tr>
				  <td>1,003</td>
				  <td>libero</td>
				  <td>Sed</td>
				  <td>cursus</td>
				  <td>ante</td>
				</tr>
				<tr>
				  <td>1,004</td>
				  <td>dapibus</td>
				  <td>diam</td>
				  <td>Sed</td>
				  <td>nisi</td>
				</tr>
				<tr>
				  <td>1,005</td>
				  <td>Nulla</td>
				  <td>quis</td>
				  <td>sem</td>
				  <td>at</td>
				</tr>
				<tr>
				  <td>1,006</td>
				  <td>nibh</td>
				  <td>elementum</td>
				  <td>imperdiet</td>
				  <td>Duis</td>
				</tr>
				<tr>
				  <td>1,007</td>
				  <td>sagittis</td>
				  <td>ipsum</td>
				  <td>Praesent</td>
				  <td>mauris</td>
				</tr>
				<tr>
				  <td>1,008</td>
				  <td>Fusce</td>
				  <td>nec</td>
				  <td>tellus</td>
				  <td>sed</td>
				</tr>
				<tr>
				  <td>1,009</td>
				  <td>augue</td>
				  <td>semper</td>
				  <td>porta</td>
				  <td>Mauris</td>
				</tr>
				<tr>
				  <td>1,010</td>
				  <td>massa</td>
				  <td>Vestibulum</td>
				  <td>lacinia</td>
				  <td>arcu</td>
				</tr>
				<tr>
				  <td>1,011</td>
				  <td>eget</td>
				  <td>nulla</td>
				  <td>Class</td>
				  <td>aptent</td>
				</tr>
				<tr>
				  <td>1,012</td>
				  <td>taciti</td>
				  <td>sociosqu</td>
				  <td>ad</td>
				  <td>litora</td>
				</tr>
				<tr>
				  <td>1,013</td>
				  <td>torquent</td>
				  <td>per</td>
				  <td>conubia</td>
				  <td>nostra</td>
				</tr>
				<tr>
				  <td>1,014</td>
				  <td>per</td>
				  <td>inceptos</td>
				  <td>himenaeos</td>
				  <td>Curabitur</td>
				</tr>
				<tr>
				  <td>1,015</td>
				  <td>sodales</td>
				  <td>ligula</td>
				  <td>in</td>
				  <td>libero</td>
				</tr>
			  </tbody>
			</table>
			
			
		</div>


	<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>ZAP CC Check</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-success" href="<?php echo base_url('itemCRUD/create') ?>"> Create New Item</a>

        </div>

    </div>

</div>


<table class="table table-bordered">


  <thead>

      <tr>
          <th>Wallet ID</th>
          <th>Email ID</th>
          <th>Mobile No</th>
          <th>Shopper Name</th>
          <th>Transaction Ref</th>

      </tr>

  </thead>


  <tbody>

   <?php foreach ($data as $item) { ?>      

      <tr>

          <td><?php echo $item->wallet_id; ?></td>
          <td><?php echo $item->shopper_email; ?></td>          
          <td><?php echo $item->shopper_telephone_number; ?></td>          
          <td><?php echo $item->shopper_full_name; ?></td>          
          <td><?php echo $item->transaction_reference; ?></td>          

      <td>

        <form method="DELETE" action="<?php echo base_url('itemCRUD/delete/'.$item->id);?>">

          <a class="btn btn-info" href="<?php echo base_url('itemCRUD/'.$item->id) ?>"> show</a>

         <a class="btn btn-primary" href="<?php echo base_url('itemCRUD/edit/'.$item->id) ?>"> Edit</a>

          <button type="submit" class="btn btn-danger"> Delete</button>

        </form>

      </td>     

      </tr>

      <?php } ?>

  </tbody>


</table>

	</main>
  </div>
</div>


<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.</p>

<?php $this->load->view('all_footer');?>