function load_em(){
var e = $.cookie("username"); //"USERNAME" COOKIE
var p = $.cookie("password"); //"PASSWORD" COOKIE

$("#username").val(e); //FILLS WITH "USERNAME" COOKIE
$("#password").val(p); //FILLS WITH "PASSWORD" COOKIE
$("#loginerror").hide();
}



$(document).ready(function(){
  //$("#loginerror").hide();
 
   $("#button").click(function(){
   
	
	var c = $("#remember1"); //INPUT CHECKBOX
	var u = $("#username1").val(); //VALUE OF USERNAME
	//alert("U: " + u);
	var p = $("#password1").val(); //VALUE OF PASSWORD
	var pnew=hex_sha512(p);
	//alert("P: " + pnew);
	 $.post("/mythings/controller/login_adminprocess.php",
    {
      username:u,
      password:p
    },
    function(data,status){
      alert("Status: " + status+ data);
	  window.location = "/mythings/admin/home.html"
    });

	
//IF CHECKBOX IS SET, COOKIE WILL BE SET
	if(c.is(":checked")){
		$.cookie("username", u, { expires: 365 }); //SETS IN DAYS (1 YEARS)
		$.cookie("password", p, { expires: 365 }); //SETS IN DAYS (1 YEARS)
		$("#loginerror").show();
	}
	 


  });
 
 
});