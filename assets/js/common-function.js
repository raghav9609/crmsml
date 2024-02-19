$(".removeSpecial").focusout(function() {
    var field_value = this.value;
    var final_val = field_value.replace(/[^A-Za-z0-9\-@_#%.\s]/gi, '').replace(/[_\s]/g, ' ');
    $("#"+this.id).val(final_val);
}) 
$(document).on('keyup', '.numonly', function(e) {
    var charCode = (e.which) ? e.which : e.keyCode;
    if (charCode != '37' && charCode != '39' && charCode != '8' && charCode != '46') {
        var th = $("#" + this.id);
        th.val(th.val().replace(/[^0-9]/g, ''));
    }
});
$(document).on('keyup', '.onlybackspace', function(e) {
    var charCode = (e.which) ? e.which : e.keyCode;
    if (charCode != '8' && charCode != '46') {
        var th = $("#" + this.id);
        th.val('');
    }
});
$(document).on('keyup', '.alphaonly', function(e) {
    var charCode = (e.which) ? e.which : e.keyCode;
    if (charCode != '37' && charCode != '39' && charCode != '8' && charCode != '46') {
        var th = $("#" + this.id);
        th.val(th.val().replace(/[^a-zA-Z ]/g, ''));
    }
});
$(document).on('keyup', '.alpha-num', function(e) {
    var charCode = (e.which) ? e.which : e.keyCode;
    if (charCode != '37' && charCode != '39' && charCode != '8' && charCode != '46') {
        var th = $("#" + this.id);
        th.val(th.val().replace(/[^a-zA-Z0-9 ]/g, ''));
    }
});
 $("#pin_code").on("focusout", function () {
    var pincode = $("#pin_code").val();
    $.ajax({
        data: "pincode=" + pincode,
        type: "POST",
        url: "//crmloadbalancer-331170859.ap-south-1.elb.amazonaws.com/include/get-city.php",
        success: function (data) {
            if (data != '') {
                var element = data.split("@#");
                $("#city_id").val(element[0]);
                // $("#state").val(element[1]);
            }
        }
    });
});

$('.drop-paste').bind("drop paste",function(e) {
    e.preventDefault();
});

$('.alpha-num-hyphen').bind('keypress', function(evt) {
    if(evt.which >= 48 && evt.which <= 57)
        return true;
    if(evt.which >= 65 && evt.which <= 90 || (evt.which > 96 && evt.which < 123))
        return true;
    if(evt.which == 45)
        return true;
    else
      evt.preventDefault();
});

$('.alpha-wo-space').bind('keypress', function(evt) {           //alpha without spaces
    if((evt.which > 64 && evt.which < 91) || (evt.which > 96 && evt.which < 123)) {
      return true;
    } else {
      evt.preventDefault();
    }
});
  
$('.alpha-num-space').bind('keypress', function(evt) {          //alpha numeric with restricted spaces
    var input = evt.target;
    var val = $(this).val();
    var end = $(this).prop('selectionEnd');

    if(evt.which === 32 &&  evt.target.selectionStart === 0)
        return false;
    if(evt.which >= 48 && evt.which <= 57)
        return true;
    if(evt.which >= 65 && evt.which <= 90 || (evt.which > 96 && evt.which < 123))
        return true;
    if(evt.which == 32 && (val[end - 1] == " " || val[end] == " "))
        evt.preventDefault();
    if(evt.which > 31 && evt.which < 33)
        return true;
    else
        evt.preventDefault();
});
  
$(".alnum-wo-space").bind('keypress', function(evt) {           //alpha numeric without space
    if(evt.which >= 48 && evt.which <= 57)
        return true;
    if(evt.which >= 65 && evt.which <= 90 || (evt.which > 96 && evt.which < 123))
        return true;
    else
        evt.preventDefault();
});

$(".no-space").bind('keypress', function(evt) {
    if(evt.which == 32) {
        return false;
    }
});

$('.alpha-w-space').bind('keypress', function(evt) {           //alpha with restricted spaces
    var input = evt.target;
    var val = $(this).val();
    var end = $(this).prop('selectionEnd');

    if(evt.which === 32 &&  evt.target.selectionStart === 0)
        return false;
    if(evt.which >= 48 && evt.which <= 57)
        return false;
    if(evt.which >= 65 && evt.which <= 90 || (evt.which > 96 && evt.which < 123))
        return true;
    if(evt.which == 32 && (val[end - 1] == " " || val[end] == " "))
        evt.preventDefault();
    if(evt.which > 31 && evt.which < 33)
        return true;
    else
        evt.preventDefault();
});

$('.num-hyphen').bind('keypress', function(evt) {
    if(evt.which >= 48 && evt.which <= 57)
        return true;
    if(evt.which == 45)
        return true;
    else
      evt.preventDefault();
});

$(".alpha-num-hash").bind('keypress', function(evt) {
    if(evt.which >= 48 && evt.which <= 57)
        return true;
    if(evt.which >= 65 && evt.which <= 90 || (evt.which > 96 && evt.which < 123))
        return true;
    if(evt.which == 51 || evt.which == 35)
        return true;
    else
      evt.preventDefault();
});

$(document).on('keyup', '.alpha-num-fta', function (evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    var th = $("#" + this.id);
    if(evt.target.selectionStart === 1 || evt.target.selectionStart === 2) {
        if(evt.keyCode < 65 || evt.keyCode > 90) {
            if(evt.keyCode != 8) {
                th.val(th.val().substring(0, th.val().length - 1));
                return false;
            }
        }
    } else {
        if((evt.keyCode >= 48 && evt.keyCode <= 57) || (evt.keyCode >= 96 && evt.keyCode <= 105)) {
            return true;
        } else {
            if(evt.keyCode != 8) {
                th.val(th.val().substring(0, th.val().length - 1));
                return false;
            }
        }
    }
});

$(document).on('keyup', '.alpha-num-fa', function (evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    var th = $("#" + this.id);
    if(evt.target.selectionStart === 1) {
        if((evt.keyCode < 65 || evt.keyCode > 90)) {
            if(evt.keyCode != 8) {
                th.val(th.val().substring(0, th.val().length - 1));
                return false;
            }
        }
    } else {
        if((evt.keyCode >= 48 && evt.keyCode <= 57) || (evt.keyCode >= 96 && evt.keyCode <= 105)) {
            return true;
        } else {
            if(evt.keyCode != 8) {
                th.val(th.val().substring(0, th.val().length - 1));
                return false;
            }
        }
    }
});


//Changes - Starts
$(document).on('keypress', '.num-dot', function(evt) {
    if(evt.which >= 48 && evt.which <= 57)
        return true;
    if(evt.which == 190 || evt.which == 110 || evt.which == 46)
        return true;
    else
      evt.preventDefault();
});
//Changes - Ends


$('.get_roi_rate').keypress(function(event) {
    if (((event.which != 46 || (event.which == 46 && $(this).val() == '')) ||
            $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
   
}).on('paste', function(event) {
    
    event.preventDefault();
   
});


