$(document).ready(function () { 
    $("#f_stats").change(function () {
        var f_stats_val = $("#f_stats").val();
        if(f_stats_val == 2 || f_stats_val == 3 || f_stats_val == 4 || f_stats_val == 8 || f_stats_val == 9 || f_stats_val == 5){
            $("#fol_date,#fol_time,.fol_date,.fol_time").removeClass("hidden").attr('required',true).val('');
        }else{
            $("#fol_date,#fol_time,.fol_date,.fol_time").addClass("hidden").removeAttr('required').val('');
        }        
    });

    $( "#ad_query" ).on( "click", function() {
        var f_stats_val = $("#f_stats").val();
        var fol_date = $("#fol_date").val();
        var fol_time = $("#fol_time").val();
        var folow_given = $("#folow_given").val();
        if(f_stats_val == '' || f_stats_val == 0){
            alert("Fill Mandatory Fields");
        }else if((f_stats_val == 2 || f_stats_val == 3 || f_stats_val == 4 || f_stats_val == 8 || f_stats_val == 9 || f_stats_val == 5) && (fol_date == '' || fol_time == "")){
            alert("Fill Mandatory Fields");
        }else if(folow_given == '' || folow_given == 0){
            alert("Fill Mandatory Fields");
        }else{
            $('#loader').css("display","block");
            var data_string = $("#follow_up_form").serializeArray();
            $.ajax({      
                type: "POST",
                dataType: "text",
                data: data_string,
                cache: false,
                timeout: 60000,
                url: "https://astechnos.com/crmsml/query/update-follow-up.php",
                success: function(response){
                  setTimeout(  function() {  
                    console.log("Follow Up Added Successfully");  
                  alert("Follow Up Added Successfully");
                  
                    window.location.href = 'https://astechnos.com/crmsml/query/index.php';
                  
                  $('#loader').css("display","none");
                  verticalToggle('step4');
                  }, 3000);  
              }
              });
        }
        
      } );
});
