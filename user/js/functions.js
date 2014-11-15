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


  function Advanced_search(value){
        
        $("#Advancedtablebody td").remove();  
        var searchwordlocation = $("#Locationdata").val();
        var searchtagdata = $("#Tagdata").val();
        var Time1= $("#time1").val();
        var Time2= $("#time2").val();
        var Date1= $("#date1").val();
        var Date2= $("#date2").val();

         $.getJSON("/mythings/system/controller/advancedsearch_process.php",{locationsearchdata:searchwordlocation, tagsearchdata:searchtagdata, Stime1:Time1 , Stime2:Time2, Sdate1:Date1, Sdate2:Date2},function(data) {
          
                        $.each(data, function(index, datasend) {
                        

                          var a=parseInt(datasend.ID);
                          var b=timeConverter(a);
                          $('#Advancedtablebody').append('<tr class="data">');
                          $('#Advancedtablebody').append('<td class="data" width="30px">'+b+'</td>'); //add ID
                          $('#Advancedtablebody').append('<td class="data">'+datasend.firstname+'</td>'); // add first name
                          $('#Advancedtablebody').append('</tr>');
                        });
     
                    });
            
                    

        $("#Advancedsearchdata").show();

     }

  function lecturehalls(value){
        
        $("#attendancebody td").remove();  
        var Lecturehall = $("#lecturehall").val();
        var lecdate= $("#lecturedate").val();
        var lecturetime1= $("#lecturehalltimefrom").val();
        var lecturetime2= $("#lecturehalltimeto").val();
        

         $.getJSON("/mythings/system/controller/attendancesearch_process.php",{lacturehallname:Lecturehall,  Stimefrom:lecturetime1 , Stimeto:lecturetime2, date:lecdate},function(data) {
          
                        $.each(data, function(index, datasend) {
                        

                          //var a=parseInt(datasend.ID);
                          //var b=timeConverter(a);
                          $('#attendancebody').append('<tr class="data">');
                          $('#attendancebody').append('<td class="data" width="30px">'+datasend.tag_name+'</td>'); //add ID
                          $('#attendancebody').append('<td class="data">'+datasend.count+'</td>'); // add first name
                          $('#attendancebody').append('</tr>');
                        });
     
                    });
            
                    

        $("#attendancetable").show();

     }

