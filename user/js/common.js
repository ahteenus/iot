function load_em(){
$("#loginpart").hide();
//$("#video").hide();
//$("#intro").hide();
var e = $.cookie("username"); //"USERNAME" COOKIE
var p = $.cookie("password"); //"PASSWORD" COOKIE

$("#username").val(e); //FILLS WITH "USERNAME" COOKIE
$("#password").val(p); //FILLS WITH "PASSWORD" COOKIE
$("#loginerror").hide();
var e = "username"; //"USERNAME" COOKIE
var p = "password"; //"PASSWORD" COOKIE
var pnew=hex_sha512(p);
	$.post("/mythings/system/controller/login_check.php",
    {
      e: e,
      p:pnew
    },
    function(data1,status){
		data1 = data1.split(/\t/g);
		var data=data1[0];
		if(data=="ReLogin Success"){
			$("#homepart").show();
			$("#Name").html("Hello,"+data1[1]);
		}
		else{
			$("#homepart").hide();
			$("#loginpart").show();
		}
		
	}); 
}



$(document).ready(function(){
  
   $("#button1").click(function(){
   
	
	var c = $("#remember"); //INPUT CHECKBOX
	var u = $("#username").val(); //VALUE OF USERNAME
	var p = $("#password").val(); //VALUE OF PASSWORD
	var pnew=hex_sha512(p);
	 $.post("/mythings/system/controller/login_process.php",
    {
      username:u,
      password:pnew
    },
    function(data1,status){
		data1 = data1.split(/\t/g);
		var data=data1[0];
		//alert(data);
		if(data=="Success: You have been logged in!"){
			$("#loginForm").hide();
			$("#video").hide();
			$("#intro").hide();
			$("#nameofuser span").content("Hi I am replace");
			$("#searchpart").show();
			$("#Name").html("Hello,"+data1[1]);
		}
		else if(data=="Earlier Login"){
			$("#loginForm").hide();
			$("#video").hide();
			$("#intro").hide();
			$("#homepart").show();
			$("#Name").html("Hello,"+data1[1]);
		}
		else if(data=="Login Failed"){
			$("#loginerror").show();
		}
		else{
		
		}
		
    });

	
//IF CHECKBOX IS SET, COOKIE WILL BE SET
	if(c.is(":checked")){
		$.cookie("username", u, { expires: 365 }); //SETS IN DAYS (1 YEARS)
		$.cookie("password", p, { expires: 365 }); //SETS IN DAYS (1 YEARS)
	}
  });
 
 $("#logout").click(function(){
	var l="logout";
	 $.post("/mythings/system/controller/login_out.php",
    {
      username:l,
      password:l
    },
    function(data,status){
		window.location.replace("/mythings/user/");
    }); 
  });
  $("#search1").click(function(){
		$("#home").hide();
		$("#searchpart").show();
		$("#basicsearchpart").show();
		$("#advancesearchpart").hide();
		$("#prioritylistpart").hide();
		$("#attendance").hide();

		$("#mytagpart").hide();
		$("#settingpart").hide();
		$("#advancedsearch").click(function(){
			$("#basicsearchpart").hide();
			$("#advancesearchpart").show();
		});
  });
   $("#home1").click(function(){
		$("#home").show();
		$("#searchpart").hide();
		$("#prioritylistpart").hide();
		$("#mytagpart").hide();
		$("#attendance").hide();

		$("#settingpart").hide();
  });
 $("#prioritylist1").click(function(){
		$("#home").hide();
		$("#searchpart").hide();
		$("#prioritylistpart").show();
		$("#mytagpart").hide();
		$("#attendance").hide();

		$("#settingpart").hide();
		// alert("priority");
			$("#prioritytablebody td").remove();  
            var url = "/mythings/system/controller/getprioritydata_process.php"; // url which we want to connect
              

             // get jason encoded data
            /*$.getJSON(url, function(data) {

              //fetch table  ,, remember different table body ids for this and search table
              $.each(data, function(index, data) {
                $('#prioritytablebody').append('<tr class="data">');
                $('#prioritytablebody').append('<td class="data" width="30px">'+data.ID+'</td>'); //add ID
                $('#prioritytablebody').append('<td class="data">'+data.firstname+'</td>'); // add first name
                $('#prioritytablebody').append('<td class="data">'+data.lastname+'</td>'); // add last name
                $('#prioritytablebody').append('</tr>');
                
              });
 
            });*/

            $("#prioritydata").show();
		
  });
  $("#mytags1").click(function(){
		$("#home").hide();
		$("#searchpart").hide();
		$("#prioritylistpart").hide();
		$("#mytagpart").show();
		$("#settingpart").hide();
		$("#attendance").hide();


		$("#tagtablebody td").remove();  
            var url = "/mythings/system/controller/gettagdata_process.php"; // url which we want to connect
              

             // get jason encoded data
            $.getJSON(url, function(data) {

              //fetch table  ,, remember different table body ids for this and search table
              $.each(data, function(index, data) {
                $('#tagtablebody').append('<tr class="data">');
                $('#tagtablebody').append('<td class="data">'+data.tag_no+'</td>'); //add ID
                 $('#tagtablebody').append('<td class="data">'+data.epc+'</td>'); // add last name
                $('#tagtablebody').append('<td class="data">'+data.tag_name+'</td>'); // add first name
                $('#tagtablebody').append('<td class="data">'+data.priority+'</td>'); // add last name
               
                $('#tagtablebody').append('</tr>');
                
              });
 
            });

            $("#tagdata").show();
  });
  $("#settings1").click(function(){
		$("#home").hide();
		$("#searchpart").hide();
		$("#prioritylistpart").hide();
		$("#mytagpart").hide();
		$("#settingpart").show();
		$("#attendance").hide();
  });
   $("#attendancetab").click(function(){
		$("#home").hide();
		$("#searchpart").hide();
		$("#prioritylistpart").hide();
		$("#mytagpart").hide();
		$("#settingpart").hide();
		$("#attendance").show();
  });

  $(".buttonedit").click(function(){
		var ID= this.id;
		Id= ID;
		//alert(Id);
		var tagnamein= "tag_name_input_"+ID;
		//alert(tagnamein);
		$("#tag_name_"+ID).hide();
		$("#tag_name_input_"+ID).show();
		$("#priority_"+ID).hide();
		$("#priority_data_input_"+ID).show();
		$("#"+ID).hide();
		$("#done_"+ID).show();
		//$(".buttondone").show();
		});

		$(".buttondone").click(function(){
		var ID= Id;
		var tagnamein= "tag_name_input_"+ID;
		//alert(tagnamein);
		
		var newpriority=$("#priority_data_input_"+ID).val();
		var newtagname=$("#tag_name_input_"+ID).val();

		$("#tag_name_"+ID).html(newtagname);
		$("#priority_"+ID).html(newpriority);

		$("#tag_name_input_"+ID).hide();
		$("#priority_data_input_"+ID).hide();
		$("#tag_name_"+ID).show();
		$("#priority_"+ID).show();
		
		$("#done_"+ID).hide();
		$("#"+ID).show();

		 $.post("/mythings/system/controller/edit_data.php", {tagno:ID, tagnamenew:newtagname, prioritynew:newpriority} ,function(datam,stat){
					//alert(datam);
				});
		//alert(newtagname);
		//$(".buttondone").show();
		});


  
});