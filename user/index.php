<html>
<head>
<title>IOT</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Copyright" content="ent.mrt.ac.lk">
<meta name="description" content="Internet of my things">
<meta name="keywords" content="main page">
<meta name="author" content="Final year Project University of Moratuwa">
<meta name="language" content="">
 <META HTTP-EQUIV="Pragma" CONTENT="no-cache"><META HTTP-EQUIV="Expires" CONTENT="-1">

<link rel="shortcut icon" href="stylesheet/img/devil-icon.png"> <!--Pemanggilan gambar favicon-->
<link rel="stylesheet" type="text/css" href="mos-css/mos-style.css"> <!--pemanggilan file css-->
<link rel="stylesheet" type="text/css" media="screen" href="css/ui-lightness/jquery-ui-1.10.3.custom.css" />
<link rel="stylesheet" type="text/css" media="screen" href="css/ui.jqgrid.css" />
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/sha512.js"></script>
	<script src="http://wcetdesigns.com/assets/javascript/jquery/cookie-plugin.js"></script>
	<script type="text/javascript" src="js/common.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>

	<script src="js/jqgrid/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="js/jqgrid/jquery.jqGrid.min.js" type="text/javascript"></script>
</head>







<body onload="load_em()">
<div id="loginpart"> 
	<!-- ################### Login part starts  ##########################-->

	<div id="header">
	<div class="inHeaderLogin"></div>
	</div>

<div id="loginForm">
	<div id="headLoginForm">
	<div id= "pic">
	</div>
	</div>
	<div class="fieldLogin">
	<form method="post" action="" >
	<label>Username</label><br>
	<input id="username" type="text" class="login"><br>
	<label>Password</label><br>
	<input id="password" type="password" class="login"><br>
	<input id='remember' type="checkbox"  value="remember">Keep me sign in<br>
	<br>
	<div id='button1'>
		<button type="button" class="button"> Log In</button>
	</div> 
	</form>
	<br>
	<br>
	<a href="http://www.google.com">I can't access my account </a><br>
	<a href="http://www.google.com">Help </a>
	<br>
	 <br>
	<input type="submit" class="button" value="create_account">

	</div>
	<div id='loginerror'style ="display: none;"> <p1>You entered invalid username/passowrd</p1> </div> <!-- place this in a correct place-->
</div>
 <div id="video">
	<embed
		width="420" height="345"
		src="http://www.youtube.com/v/sfEbMV295Kk?hl=en_US&amp;version=3&amp;rel=0"
		type="application/x-shockwave-flash">
	</embed>
</div>
<div id="intro">
	Connect With Your Things ,Find & Manage.
</div>

</div>  <!-- ############## login part ends ##################### -->

<div id="homepart" style ="display: none;"> <!-- ############# home page part starts ################## -->



<div id="header">
	<div class="inHeader">
		<div  class="mosAdmin">
			<div id = "nameofuser">
				Welcome, <?php
				session_start();
				echo $_SESSION['username'];
				 ?>
			</div>
			<!-- <div id="Name" >
			</div> -->
			 <br>
		<a href=""></a> | <a href="">Help</a> | <a id='logout'>Logout</a>
		</div>
	<div class="clear"></div>
	</div>
</div>



<div id="wrapper">
	<div id="leftBar">
	<ul>
		<!-- <li><a id="home1">Home</a></li> -->
		<li><a id="search1">Search</a></li>
		<li><a id="prioritylist1">Priority list</a></li>
		<li><a id="mytags1">My Tags</a></li>
		<li><a id="attendancetab">Attendance</a></li>
		<li><a id="settings1">Settings</a></li>
	</ul>
	</div>
	<div id="rightContent">
	<!-- <div id="home">
	
	<div class="quoteOfDay">
	
	</div>
		
		
		<div class="clear"></div>
		
		
		<div id="smallRight"><h3>Statistik pengunjung web</h3>
		
		
		</div>
		</div> -->
	
	<div id="searchpart" style="display:none;"> 
	<div id ="basicsearchpart">	<!-- ###### basic search part starts -->
	<h3>Search Tags </h3>
	<div class= "box">
		<form name="basicsearch" action="" method="post">
					 <input id="gosearch" type="text" name="Item" size="70"><br>
					<input type="button" class="button" value="Search" onclick="search(this.value)">
					<input id="advancedsearch" type="button"  class="button" value="Advance Search">		
		</form>
		<table class="data" id="searchdata" style="display:none;">
							<thead>
								<tr class="data">
									<th class="data" width="150px">Time</th>
									<th class="data">Location</th>
								</tr>
							</thead>

							<tbody id="tablebody">
							</tbody>
		</table>
	</div>
	</div> <!-- ####### basic search part ends  -->
	<table id="list"><tr><td></td></tr></table> 
    <div id="pager"></div>
	<div id="advancesearchpart" style="display:none;"><!-- ###### advanced search part sarts -->
	<h3>Advance Search </h3>
	<div id="basicsearch">	
	</div>
	<div class= "box">
		<form name="advancedsearch" >
							 Location :<input id="Locationdata" type="text" name="location" size="50"><br>
							 Tag:<input id="Tagdata" type="text" name="location" size="50"><br>
							 Date : <input id="date1" type="date" name="date1" size="20"> to <input id="date2" type="date" name="date2" size="20"><br>
							 Time : <input id="time1" type="time" name="time1" size="20"> to <input id="time2" type="time" name="time2" size="20">
							 <br>
							<input  type="button" class="button" value="AdvancedSearch" onclick="Advanced_search(this.value)">
				</form>
				<table class="data" id="Advancedsearchdata" style="display:none;">
									<thead>
										<tr class="data">
											<th class="data" width="150px">Time</th>
											<th class="data">Location</th>
										</tr>
									</thead>

									<tbody id="Advancedtablebody">
									</tbody>
				</table>
	</div>
	</div> <!-- ######### advancedd search part ends  -->
	</div>
	
	<div id="prioritylistpart"  style="display:none;"><!--##############################  priority list part starts ######-->
	<h3>Priority List</h3>
	<div class="box">



		 <table   class="data">
			<col width="150px" />
		    
		    <col width="150px" />
		   <col width="250px" />
		    

			<thead >
								<tr class="data">
									<th class="data" >Tag No</th>
									
									<th class="data">Tag Name</th>
									<th class="data">Location</th>
									
									
								</tr>
							</thead>
			<?php
				$con=mysqli_connect("localhost","billz","asdasd","notification"); // database name test hosted at localhost

				 $a=session_id();
				 $uid="fd";
				   
				    //session_start();
				    $uid= $_SESSION["user_id"];
				 

				$sql = "SELECT * FROM priority_taglist WHERE user_id='$uid'";

				$result1 = mysqli_query($con,$sql);


				while($row1 = mysqli_fetch_array($result1)){
				

				$tag=$row1['tag_no'];
	   			$tag_name =$row1['tag_name'];
	   			$location =$row1['latest_location'];
	       
				

				


			?>

			<tr   class="edit_tr">

			<td class="edit_td">
			<span id="tag_number_<?php echo $tag; ?>" class="text"><?php echo $tag; ?></span>
			
			</td>

			<td class="edit_td">
			<span id="epc_number_<?php echo $tag; ?>" class="text"><?php echo $tag_name; ?></span> 
			
			</td>

			<td class="edit_td">
			<span id="tag_name_<?php echo $tag; ?>" class="text"><?php echo $location; ?></span>
			
			</td>


			


			

			</tr>

			<?php
			}

			?>
		</table>
		<!-- <table class="data" id="prioritydata" style="display:none;">
							<thead>
								<tr class="data">
									<th class="data" >Tag No</th>
									<th class="data">Tag Name</th>
									<th class="data">Location</th>
								</tr>
							</thead>

							<tbody id="prioritytablebody">
							</tbody>
		</table> -->
	</div>
	</div>
	
		
	<div id="mytagpart" style="display:none;"><!--##############################  mytags part starts ###########################-->
	<h3>My Tags</h3>
	<div class="box">

		<table   class="data">
			<!-- <col width="150px" /> -->
		    <col width="50px" />
		    <col width="150px" />
		    <col width="50px" />
		    <col width="50px" />

			<thead >
								<tr class="data">
									<!-- <th class="data" >Tag No</th> -->
									<th class="data">EPC</th>
									<th class="data">Tag Name</th>
									<th class="data">Priority</th>
									<th class="data">Edit</th>
									
								</tr>
							</thead>
			<?php
				include('dbselect.php');
				 $a=session_id();
				 $uid="fd";
				   
				    //session_start();
				    $uid= $_SESSION["user_id"];
				 

				$sql = "SELECT * FROM hetmr WHERE user_id='$uid'";

				$result = mysqli_query($con,$sql);


				while($row = mysqli_fetch_array($result)){
				

				$tag=$row['tag_no'];
	   			$tag_name =$row['tag_name'];
	   			$priority =$row['priority'];
	        	$epc =$row['epc'];
				/*$id=$row['id'];
				$firstname=$row['firstname'];
				$lastname=$row['lastname'];*/

				$priority_data="NO";
				if ($priority==1) {
					$priority_data="YES";
				}
				


			?>

			<tr   class="edit_tr">

			<!-- <td class="edit_td">
			<span id="tag_number_<?php echo $tag; ?>" class="text"><?php echo $tag; ?></span>
			
			</td> -->

			<td class="edit_td">
			<span id="epc_number_<?php echo $tag; ?>" class="text"><?php echo $epc; ?></span> 
			
			</td>

			<td class="edit_td">
			<span id="tag_name_<?php echo $tag; ?>" class="text"><?php echo $tag_name; ?></span>
			<input type="text" value="<?php echo $tag_name; ?>" class="editbox" size="15" id="tag_name_input_<?php echo $tag; ?>" style="display:none" /&gt;
			</td>


			<td class="edit_td">
			<span id="priority_<?php echo $tag; ?>" class="text"><?php echo $priority_data; ?></span> 
			<input type="text" value="<?php echo $priority_data; ?>" class="editbox" size="4" id="priority_data_input_<?php echo $tag; ?>" style="display:none"/>
			</td>

			<td class="edit_td">
			<input  type="button" id="<?php echo $tag; ?>" class="buttonedit" value="Edit" />
			<input  type="button" id="done_<?php echo $tag; ?>" class="buttondone" value="Save" style="display:none" />

			</td>
			

			</tr>

			<?php
			}

			?>
		</table>


		<!-- <table class="data" id="tagdata" style="display:none;">
							<thead>
								<tr class="data">
									<th class="data" >Tag No</th>
									<th class="data">EPC</th>
									<th class="data">Tag Name</th>
									<th class="data">Priority</th>
									
								</tr>
							</thead>

							<tbody id="tagtablebody">
							</tbody>
		</table> -->
	</div>









	</div>



	<div id="settingpart" style="display:none;"> <!--###################### settings part starts ########################-->
	<h3>Settings</h3>
	<div class="box">
	</div>
	</div>

	<div id="attendance" style="display:none;"> <!--###################### settings part starts ########################-->
	<h3>Attendence</h3>
	<div class="box">
							Lecture Hall :<input id="lecturehall" type="text" name="location" size="50"><br>
							Date : <input id="lecturedate" type="date" name="date1" size="20"> 
							
							 Time : <input id="lecturehalltimefrom" type="time" name="time1" size="20"> to <input id="lecturehalltimeto" type="time" name="time2" size="20">
							 <br>
							<input  type="button" class="button" value="Get Results" onclick="lecturehalls(this.value)">
				</form>


				<table class="data" id="attendancetable" style="display:none;">
									<thead>
										<tr class="data">
											<th class="data" width="150px">Student Name</th>
											<th class="data">Accuracy</th>
										</tr>
									</thead>

									<tbody id="attendancebody">
									</tbody>
				</table>

	</div>
	</div>



	
	</div>
<div class="clear"></div>
<!-- <div id="footer">
	&copy; 2014  | <a href="#"></a> | design <a href="" target="_blank"></a><br>
	Internet Of My Things UOM <a href="#"></a> |  <a href="lisensi.txt" target="_blank"></a>
</div> -->
</div>
</div>  <!-- ##### home part ends ######### -->





</body>

</html>