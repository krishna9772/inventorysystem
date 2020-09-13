<style type="text/css">

	a:hover{
		text-decoration: none;
	}
	
</style>
<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Total Users</strong></div>
			<div class="panel-body" align="center">
				<a href="<?php echo base_url()?>account/users"><h1><?php echo $total_users ?></h1></a>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Total Prin.Company</strong></div>
			<div class="panel-body" align="center">
				<a href="<?php echo base_url()?>category_con/fetch_Category"><h1><?php echo $total_categorys?></h1></a>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Total Dis.Company</strong></div>
			<div class="panel-body" align="center">
			<a href="<?php echo base_url()?>brand_con/fetch_brand"><h1><?php echo $total_brands?></h1></a>
			</div>
		</div>
	</div>
	<div class="col-md-3">
		 
		<div class="panel panel-default">
			<div class="panel-heading"><strong>Total Items in Stock</strong></div>
			<div class="panel-body" align="center">
				<a href="<?php echo base_url()?>product_con/fetch_product"><h1><?php echo $total_products?></h1></a>
			</div>
		</div>
	</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Order Value</strong></div>
				<div class="panel-body" align="center">
					<h1><?php echo $total_order_value?></h1>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Paid Order Value</strong></div>
				<div class="panel-body" align="center">
					<h1><?php echo $total_paid_value?></h1>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading"><strong>Total Credit Order Value</strong></div>
				<div class="panel-body" align="center">
					<h1><?php echo $total_unpaid_value?></h1>
				</div>
			</div>
		</div>
	</aside>