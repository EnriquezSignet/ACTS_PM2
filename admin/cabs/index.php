<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-purple">
	<div class="card-header">
		<h3 class="card-title">Service Providers</h3>
		<div class="card-tools">
			<a href="?page=cabs/manage_cab" class="btn btn-flat btn-success btn-sm">
				<span class="fas fa-plus"></span> Add New Service Provider
			</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<table class="table table-bordered table-striped table-hover">
				<colgroup>
					<col width="5%">
					<col width="10%">
					<col width="20%">
					<col width="25%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-dark text-light">
						<th class="text-center">#</th>
						<th class="text-center">Category</th>
						<th class="text-center">Services</th>
						<th class="text-center">Details</th>
						<th class="text-center">Status</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$qry = $conn->query("SELECT c.*, cc.name as category FROM `cab_list` c INNER JOIN category_list cc ON c.category_id = cc.id WHERE c.delete_flag = 0 ORDER BY (c.`reg_code`) ASC ");
					while($row = $qry->fetch_assoc()):
						foreach($row as $k => $v){
							$row[$k] = trim(stripslashes($v));
						}
					?>
						<tr>
							<td class="text-center align-middle"><?php echo $i++; ?></td>
							<td class="align-middle"><?php echo ucwords($row['category']) ?></td>
							<td class="align-middle"><?php echo ucwords($row['cab_model'])?></td>
							<td class="align-middle">
								<div>
									<p class="m-0 truncate-1"><small><b>Name:</b> <?= $row['cab_driver'] ?></small></p>
									<p class="m-0 truncate-1"><small><b>ID No:</b> <?= $row['reg_code'] ?></small></p>
									<p class="m-0 truncate-1"><small><b>Home Address:</b> <?= $row['driver_address'] ?></small></p>
								</div>
							</td>
							<td class="text-center align-middle">
								<?php if($row['status'] == 1): ?>
									<span class="badge badge-success px-3 rounded-pill">Active</span>
								<?php else: ?>
									<span class="badge badge-danger px-3 rounded-pill">Inactive</span>
								<?php endif; ?>
							</td>
							<td class="text-center align-middle">
								<button type="button" class="btn btn-flat btn-info btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="?page=cabs/view_cab&id=<?php echo $row['id'] ?>">
										<span class="fa fa-eye text-dark"></span> View
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="?page=cabs/manage_cab&id=<?php echo $row['id'] ?>">
										<span class="fa fa-edit text-primary"></span> Edit
									</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">
										<span class="fa fa-trash text-danger"></span> Delete
									</a>
								</div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this cab permanently?","delete_cab",[$(this).attr('data-id')])
		});
		$('.table th, .table td').addClass("align-middle px-2 py-1");
		$('.table').dataTable();
	});
	
	function delete_cab($id){
		start_loader();
		$.ajax({
			url: _base_url_+"classes/Master.php?f=delete_cab",
			method: "POST",
			data: {id: $id},
			dataType: "json",
			error: err => {
				console.log(err);
				alert_toast("An error occurred.", 'error');
				end_loader();
			},
			success: function(resp){
				if(typeof resp == 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occurred.", 'error');
					end_loader();
				}
			}
		})
	}
</script>
