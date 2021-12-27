<?php

//index.php

require_once 'include/DB.php';

include('class/Appointment.php');

$object = new Appointment;

if(isset($_SESSION['patient_id']))
{
	header('location:dashboard.php');
}

$object->query = "
SELECT * FROM doctor_schedule_table 
INNER JOIN doctor_table 
ON doctor_table.doctor_id = doctor_schedule_table.doctor_id
WHERE doctor_schedule_table.doctor_schedule_date >= '".date('Y-m-d')."' 
AND doctor_schedule_table.doctor_schedule_status = 'Active' 
AND doctor_table.doctor_status = 'Active' 
ORDER BY doctor_schedule_table.doctor_schedule_date ASC
";

$result = $object->get_result();

include('header.php');

?>
<style>
.wrapper{
	width:90%;
	margin:0 auto;
	background:white;
	box-shadow:7px 0px 10px rgba(0,0,0,0.6), -7px 0px 10px rgba(0,0,0,0.6);
}
section{
	padding:1%;
}
nav{
	margin-bottom:2%;
}
nav a{
	padding:0.7% 2.5%;
	padding-top:2px;
	margin:2% 1%;
	text-decoration:none;
	border-top:3px solid #000;
	border-bottom:3px solid #000;
	transition:all 0.5s;
}
nav a:hover{
	box-shadow:0 1px 1px #f00;
	text-shadow:0 1px 1px #f00;
}
.section{
    margin: 0;
    padding: 0;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.slider{
    width: 100%;
    height: 700px;
    border-radius: 0px;
    overflow: hidden;
}
.slide{
    width: 500%;
    height: 700px;
    display: flex;
    padding-top: 0;
}
.slide input{
    display: none;
    padding-top: 0;
}
.st{
    width: 20%;
    transition: 2s;
}
.st img{
    width: 100%;
    height: 700px;
}
.nav-m{
    position: absolute;
    padding-left: 40%;
    width: 800px;
    margin-top: -40px;
    display: flex;
    justify-content: center;
}
.m-btn{
    border: 2px solid #23e3c2;
    padding: 5px;
    border-radius: 10px;
    cursor: pointer;
    transition: 1s;
}
.m-btn:not(:last-child){
    margin-right: 30px;
}
.m-btn:hover{
    background-color: #23e3c2;
}
#radio1:checked ~.first{
    margin-left: 0;
}
#radio2:checked ~.first{
    margin-left: -20%;
}
#radio3:checked ~.first{
    margin-left: -40%;
}
#radio4:checked ~.first{
    margin-left: -60%;
}
.nav-auto{
    position: absolute;
    padding-left: 410px;
    width: 1000px;
    padding-top: 200px;
    margin-top: 460px;
    display: flex;
    justify-content: center;
}
.nav-auto div{
    border: 2px solid #23e3c2;
    padding: 5px;
    border-radius: 10px;
    transition: 1s;
}
.nav-auto div:not(:last-child){
    margin-right: 30px;
    justify-content: center;
}
#radio1:checked ~ .nav-auto .a-b1{
    background-color: #23e3c2;
}
#radio2:checked ~ .nav-auto .a-b2{
    background-color: #23e3c2;
}
#radio3:checked ~ .nav-auto .a-b3{
    background-color: #23e3c2;
}
#radio4:checked ~ .nav-auto .a-b4{
    background-color: #23e3c2;
} 
.header{
	display:grid;
	grid-template-columns:1fr;
	background-color:#323232;
	opacity:96;
	height:2.7em;
	width:100%;
	text-align:center;
	align-items:center;
	position:fixed;
	font-size:15px;
}
.header a{
	color:#C0C0C0;
	text-decoration:none;
}
.header > div > a,i{
	padding-right:40px;
	padding-left:40px;
}
.header > div > a:hover{
	color:white;
}
.header i:hover{
	color:white;
}
*,:after,:before{box-sizing:border-box}
.clearfix:after,.clearfix:before{content:'';display:table}
.clearfix:after{clear:both;display:block}
a{color:inherit;text-decoration:none}
</style>
	<div class="wrapper">
			<header id="homesection">
				<br>
				<nav>
					<a href="#homesection">Home</a>
					<a href="#aboutsection">About</a>
					<a href="#doctorsection">Doctor's List</a>
					<a href="#contactsection">Contact Us</a>
				</nav>
				<div class="headerImage">
                    <div class="slider">
                        <div class="slide">
                            <input type="radio" name="radio-btn" id="radio1">
                            <input type="radio" name="radio-btn" id="radio2">
                            <input type="radio" name="radio-btn" id="radio3">
                            <input type="radio" name="radio-btn" id="radio4">
        
                             <div class="st first">
                                <img src="img/thank-you-messages-thank-you-notes.jpg" alt="">
                             </div>
                            <div class="st">
                                <img src="img/Appreciation-Message-for-Doctor.jpg" alt="">
                            </div>
                            <div class="st">
                                <img src="img/Doctor-Quotes-10-min.jpg" alt="">
                            </div>
                            <div class="st">
                                <img src="img/Doctors-care-inspirational-words-heal-quote-old-patient-640x480.jpg" alt="">
                            </div>
                            <div class="nav-auto">
                                <div class="a-b1"></div>
                                <div class="a-b2"></div>
                                <div class="a-b3"></div>
                                <div class="a-b4"></div>
                            </div>
                        </div>
                        
                        <div class="nav-m">
                            <label for="radio1" class="m-btn"></label>
                            <label for="radio2" class="m-btn"></label>
                            <label for="radio3" class="m-btn"></label>
                            <label for="radio4" class="m-btn"></label>
                        </div>
                    </div>
				</div>
			</header>
			<section id="aboutsection">
				<h2>About</h2>
				<article>
					<p>
						The word health refers to a state of complete emotional and physical well-being. 
                        Healthcare exists to help people maintain this optimal state of health.
                        Good health is central to handling stress and living a longer, more active life.
                    </p>
                    <p>
                        Health is a state of complete physical, mental, and social well-being and not merely the absence of disease or infirmity.
                        A resource for everyday life, not the objective of living. 
                        Health is a positive concept emphasizing social and personal resources, as well as physical capacities.
					</p>
				</article>
			</section>
			<script type="text/javascript">
            	var counter=1;
            	setInterval(function(){
                	document.getElementById('radio' + counter).checked=true;
                	counter++;
                	if(counter > 4){
                    	counter = 1;
                	}
            	},5000);
        	</script>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script src="index.js"></script>
			<section id="doctorsection">
		      	<div class="card">
		      		<form method="post" action="result.php">
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
		      						/*foreach($result as $row)
		      						{
		      							echo '
		      							<tr>
		      								<td>'.$row['doctor_name'].'</td>
		      								<td>'.$row['doctor_degree'].'</td>
		      								<td>'.$row['doctor_expert_in'].'</td>
		      								<td>'.$row['doctor_schedule_date'].'</td>
		      								<td>'.$row['doctor_schedule_day'].'</td>
		      								<td>'.$row['doctor_schedule_start_time'].' - '.$row['doctor_schedule_end_time'].'</td>
		      								<td><button type="button" name="get_appointment" class="btn btn-primary btn-sm get_appointment" data-id="'.$row['doctor_schedule_id'].'">Get Appointment</button></td>
		      							</tr>';
		      						}*/
		      						?>
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
                        				//$ds=$DataRows["doctor_status"];                        
                					?>
                					<tr>
                    					<td><?php echo $dn;?></td>
										<td><?php echo $dhn;?></td>
                    					<td><?php echo $dd;?></td>
                    					<td><?php echo $dei;?></td>
                    					<td><?php echo $dsd;?></td>
                    					<td><?php echo $dsday;?></td>
                    					<td><?php echo $dset." - ".$glob_et;?></td>
										<td><button type="button" name="get_appointment" class="btn btn-primary btn-sm get_appointment" data-id="'.$row['doctor_schedule_id'].'">Get Appointment</button></td>
										<!--<td><?php //echo $ds;?></td>-->
               						</tr>
                    				<?php }?>
		      					</table>
		      				</div>
		      			</div>
		      		</form>
		      	</div>
			</section>
			<section id="contactsection">
				<h2>Contact</h2>
					<article>
						<p>
							Contact no. :
						</p>
                        <p>
                            E-mail ID :
                        </p>
					</article>	
			</section>
		</div>
		    

<?php

include('footer.php');

?>

<script>

$(document).ready(function(){
	$(document).on('click', '.get_appointment', function(){
		var action = 'check_login';
		var doctor_schedule_id = $(this).data('id');
		$.ajax({
			url:"action.php",
			method:"POST",
			data:{action:action, doctor_schedule_id:doctor_schedule_id},
			success:function(data)
			{
				window.location.href=data;
			}
		})
	});
});

</script>