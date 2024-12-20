<?php if ($_settings->chk_flashdata('success')): ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Shop Types</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" class="btn btn-flat btn-primary" id="create_new" style="background-color: #14453d; border-color: #14453d;"><span class="fas fa-plus"></span> Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="container-fluid">
				<table class="table table-bordered table-stripped table-dark">
					<colgroup>
						<col width="5%">
						<col width="25%">
						<col width="25%">
						<col width="25%">
						<col width="20%">
					</colgroup>
					<thead>
						<tr class="bg-gradient-secondary">
							<th>#</th>
							<th>Date Created</th>
							<th>shop_type</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$qry = $conn->query("SELECT * from `shop_type_list` where delete_flag = 0 order by `name` asc ");
						while ($row = $qry->fetch_assoc()):
						?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
								<td><?php echo $row['name'] ?></td>
								<td class="text-center">
									<?php if ($row['status'] == 1): ?>
										<span class="badge badge-success bg-gradient-success px-3 rounded-pill">Active</span>
									<?php else: ?>
										<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span>
									<?php endif; ?>
								</td>
								<td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" style="background-color: #14453d; border-color: #14453d;">
										Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" style="color: #14453d;"><span class="fa fa-edit text-primary"></span> Edit</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>" style="color: #14453d;"><span class="fa fa-trash text-danger"></span> Delete</a>
									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#create_new').click(function() {
			uni_modal('Add New Shop Type', "shop_types/manage_shop_type.php")
		})
		$('.edit_data').click(function() {
			uni_modal('Update Shop Type', "shop_types/manage_shop_type.php?id=" + $(this).attr('data-id'))
		})
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this Shop Type permanently?", "delete_shop_type", [$(this).attr('data-id')])
		})
		$('table .th,table .td').addClass('align-middle px-2 py-1')
		$('.table').dataTable();
	})

	function delete_shop_type($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_shop_type",
			method: "POST",
			data: {
				id: $id
			},
			dataType: "json",
			error: err => {
				console.log(err)
				alert_toast("An error occured.", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload();
				} else {
					alert_toast("An error occured.", 'error');
					end_loader();
				}
			}
		})
	}
</script>
<style>
	body {
		background-color: #121212;
		color: #ffffff;
	}

	.card {
		background-color: #1e1e1e;
	}

	.table thead th {
		background-color: #14453d;
		color: #ffffff;
	}

	.table tbody tr {
		background-color: #2c2c2c;
	}

	.table tbody tr:hover {
		background-color: #3a3a3a;
	}

	.dropdown-menu {
		background-color: #1e1e1e;
	}

	.dropdown-item:hover {
		background-color: #14453d;
		color: #ffffff;
	}
</style>