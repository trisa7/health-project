<?php

//dashboard.php

require_once 'include/DB.php';

include('class/Appointment.php');

$object = new Appointment;

include('header.php');

?>

<div class="container-fluid">
	<?php
	include('navbar.php');
	?>
	<br />
	<div class="card">
		<div class="card-header"><h3><b>Doctor Schedule List</b></h3></div>
			<div class="card-body">
		      	<div class="table-responsive">
		      		<table class="table table-striped table-bordered">
		      			<tr>
		      				<th>Doctor Name</th>
							<th>Hospital Name</th>
		      				<th>Education</th>
		      				<th>Speciality</th>
		      				<th>Appointment Date</th>
		      				<th>Appointment Day</th>
		      				<th>Available Time</th>
		      				<th>Action</th>
		      			</tr>
						<?php
							//$sql="SELECT dt.doctor_name,dt.doctor_degree,dt.doctor_expert_in,dst.doctor_schedule_date,dst.doctor_schedule_day,dt.doctor_status FROM doctor_table dt,doctor_schedule_table dst";
							//$sql="SELECT * FROM doctor_table";
							$glob_et="21:00";
							$sql="SELECT * FROM doctor_table INNER JOIN doctor_schedule_table ON doctor_table.doctor_id=doctor_schedule_table.doctor_id";
                    		$ConnectingDB=db();
                    		$stmt=$ConnectingDB->query($sql);
                    		while ($DataRows=$stmt->fetch()){
                    			$dn=$DataRows["doctor_name"]; 
								$dhn=$DataRows["doctor_hospital_name"];
                    			$dd=$DataRows["doctor_degree"];
                    			$dei=$DataRows["doctor_expert_in"];
                    			$dsd=$DataRows["doctor_schedule_date"];
                    			$dsday=$DataRows["doctor_schedule_day"];
								$dset=$DataRows["doctor_schedule_end_time"];
								$dsid=$DataRows["doctor_schedule_id"];                      
                		?>
                		<tr>
                    		<td><?php echo $dn;?></td>
							<td><?php echo $dhn;?></td>
                    		<td><?php echo $dd;?></td>
                    		<td><?php echo $dei;?></td>
                    		<td><?php echo $dsd;?></td>
                    		<td><?php echo $dsday;?></td>
                    		<td><?php echo $dset." - ".$glob_et;?></td>
							<td><button type="button" name="get_appointment" class="btn btn-primary btn-sm get_appointment" data-id="<?php echo $dsid;?>">Get Appointment</button></td>
               			</tr>
                    	<?php }?>
		      		</table>
		      	</div>
		    </div>
		</div>
	</div>

<?php

include('footer.php');

?>

<div id="appointmentModal" class="modal fade">
  	<div class="modal-dialog">
    	<form method="post" id="appointment_form">
      		<div class="modal-content">
        		<div class="modal-header">
          			<h4 class="modal-title" id="modal_title">Make Appointment</h4>
          			<button type="button" class="close" data-dismiss="modal">&times;</button>
        		</div>
        		<div class="modal-body">
        			<span id="form_message"></span>
                    <div id="appointment_detail"></div>
                    <div class="form-group">
                    	<label><b>Reason for Appointment</b></label>
                    	<textarea name="reason_for_appointment" id="reason_for_appointment" class="form-control" required rows="5"></textarea>
                    </div>
        		</div>
        		<div class="modal-footer">
          			<input type="hidden" name="hidden_doctor_id" id="hidden_doctor_id" />
          			<input type="hidden" name="hidden_doctor_schedule_id" id="hidden_doctor_schedule_id" />
          			<input type="hidden" name="action" id="action" value="book_appointment" />
          			<input type="submit" name="submit" id="submit_button" class="btn btn-success" value="Book" />
          			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        		</div>
      		</div>
    	</form>
  	</div>
</div>


<script>

$(document).ready(function(){

	var dataTable = $('#appointment_list_table').DataTable({
		"processing" : true,
		"serverSide" : true,
		"order" : [],
		"ajax" : {
			url:"action.php",
			type:"POST",
			data:{action:'fetch_schedule'}
		},
		"columnDefs":[
			{
                "targets":[6],				
				"orderable":false,
			},
		],
	});

	$(document).on('click', '.get_appointment', function(){

		var doctor_schedule_id = $(this).data('id');
		var doctor_id = $(this).data('doctor_id');

		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:'make_appointment', doctor_schedule_id:doctor_schedule_id},
			success:function(data)
			{
				$('#appointmentModal').modal('show');
				$('#hidden_doctor_id').val(doctor_id);
				$('#hidden_doctor_schedule_id').val(doctor_schedule_id);
				$('#appointment_detail').html(data);
			}
		});

	});

	$('#appointment_form').parsley();

	$('#appointment_form').on('submit', function(event){

		event.preventDefault();

		if($('#appointment_form').parsley().isValid())
		{

			$.ajax({
				url:"action.php",
				method:"POST",
				data:$(this).serialize(),
				dataType:"json",
				beforeSend:function(){
					$('#submit_button').attr('disabled', 'disabled');
					$('#submit_button').val('wait...');
				},
				success:function(data)
				{
					$('#submit_button').attr('disabled', false);
					$('#submit_button').val('Book');
					if(data.error != '')
					{
						$('#form_message').html(data.error);
					}
					else
					{	
						window.location.href="appointment.php";
					}
				}
			})

		}

	})

});

</script>