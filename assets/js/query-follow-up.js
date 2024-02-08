$(document).ready(function () { 
    $("#f_stats").change(function () {
        var f_stats_val = $("#f_stats").val();
        if(f_stats_val == 2 || f_stats_val == 3 || f_stats_val == 4 || f_stats_val == 8 || f_stats_val == 9 || f_stats_val == 5){
            $("#fol_date,#fol_time,.fol_date,.fol_time").removeClass("hidden").attr('required',true).val('');
        }else{
            $("#fol_date,#fol_time,.fol_date,.fol_time").addClass("hidden").removeAttr('required').val('');
        }        
    });
    $("#ad_query").submit(function () {
        alert("Hello");
    });
});
