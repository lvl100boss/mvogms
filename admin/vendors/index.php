<?php if ($_settings->chk_flashdata('success')): ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>

<style>
	body {
		background-color: #121212;
		color: #e0e0e0;
	}

	.card {
		background-color: #1e1e1e;
		border: 1px solid #333;
	}

	.card-header {
		background-color: #14453d;
		color: #fff;
	}

	.table {
		color: #e0e0e0;
	}

	.table thead {
		background-color: #14453d;
		color: #fff;
	}

	.table tbody tr {
		background-color: #1e1e1e;
	}

	.table tbody tr:hover {
		background-color: #333;
	}

	.btn,
	.dropdown-item {
		background-color: #14453d;
		color: #fff;
	}

	.btn:hover,
	.dropdown-item:hover {
		background-color: #0f3a32;
	}

	.img-avatar {
		width: 45px;
		height: 45px;
		object-fit: cover;
		object-position: center center;
		border-radius: 100%;
	}

	.badge-primary {
		background-color: #14453d;
	}

	.badge-danger {
		background-color: #b71c1c;
	}
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Vendors</h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="container-fluid">
				<table class="table table-bordered table-stripped">
					<colgroup>
						<col width="10%">
						<col width="10%">
						<col width="15%">
						<col width="20%">
						<col width="20%">
						<col width="15%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Avatar</th>
							<th>Code</th>
							<th>Shop Name</th>
							<th>Owner</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$qry = $conn->query("SELECT * from `vendor_list` where delete_flag = 0 order by shop_name asc ");
						while ($row = $qry->fetch_assoc()):
						?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td class="text-center"><img src="<?php echo validate_image($row['avatar']) ?>" class="img-avatar img-thumbnail p-0 border-2" alt="vendor_avatar"></td>
								<td><?php echo ($row['code']) ?></td>
								<td><?php echo ucwords($row['shop_name']) ?></td>
								<td><?php echo ucwords($row['shop_owner']) ?></td>
								<td class="text-center">
									<?php if ($row['status'] == 1): ?>
										<span class="badge badge-primary px-3 rounded-pill">Active</span>
									<?php else: ?>
										<span class="badge badge-danger px-3 rounded-pill">Inactive</span>
									<?php endif; ?>
								</td>
								<td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
										Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item" href="?page=vendors/manage_vendor&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
		$('.delete_data').click(function() {
			_conf("Are you sure to delete this vendor permanently?", "delete_vendor", [$(this).attr('data-id')])
		})
		$('.table').dataTable();
	})

	function delete_vendor($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Users.php?f=delete_vendor",
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