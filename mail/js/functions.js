function timeConverter(UNIX_timestamp){
 var a = new Date(UNIX_timestamp*1000);
 var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
     var year = a.getFullYear();
     var month = months[a.getMonth()];
     var date = a.getDate();
     var hour = a.getHours();
     var min = a.getMinutes();
     var sec = a.getSeconds();
     var time = date+','+month+' '+year+' '+hour+':'+min+':'+sec ;
     return time;
 }

 function search(value){
   // Don't really have anything to set...just show the value
   /*var s= $("#gosearch").val();
   $.post("/mythings/system/controller/search_process.php",
    {
      keyword: s
    },
    function(data1,status){
     var data =[[,],[,]]
      data1 = data1.split(/\n/g);
      jQuery.each(data1, function(i,line) {   
        line=line.split(/\t/);
        var a=parseInt(line[0]);
        if(i<2){
        data[i][0]=timeConverter(a);
        data[i][1]=line[1]; 
          
        }
      }); 
     // var data = [[48803, "DSK1"], [48769, "APPR"]];*/
    // $("#basicsearchpart").hide();
    $("#tablebody td").remove();  
    var searchword = $("#gosearch").val();
              

                //$.post("search.php",{searchDATA:searchword});

                $.getJSON("/mythings/system/controller/search_process.php",{searchDATA:searchword},function(data) {

                    $.each(data, function(index, datasend) {
                      var a=parseInt(datasend.ID);
                      var b=timeConverter(a);
                      $('#tablebody').append('<tr class="data">');
                      $('#tablebody').append('<td class="data" width="30px">'+b+'</td>'); //add ID
                      $('#tablebody').append('<td class="data">'+datasend.firstname+'</td>'); // add first name
                      $('#tablebody').append('</tr>');
                    });
 
                });
                

    $("#searchdata").show();

  }


  function advancedsearch(value)
  {
   // Don't really have anything to set...just show the value
  var s = $("#goadvancedsearch").val();
  var date1 = $("#date1").val();
  var date2 = $("#date2").val();
  var time1 = $("#time1").val();
  var time2 = $("#time2").val();
	alert(s);
  }

