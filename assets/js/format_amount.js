$(document).ready(function() {

    // var inout_id_arr = ['net_month_inc', 'loan_amount'];
    var inout_id_arr = ".loan_net_incm";
    // inout_id_arr.forEach(function(inout_id) {
    $(inout_id_arr).each(function() {
        var inout_id = $(this).attr('id');
        if($("#" + inout_id).length == 0) {
            return;
        }
        var amount = $("#"+inout_id).val();
        var finl_in = amount.replace(',','');
        if (finl_in.length < 1) {
            $("#"+inout_id).val('');
        } else {
            var val = parseFloat(finl_in);
            var formatted = inrFormat(finl_in);
            if (formatted.indexOf('.') > 0) {
                var split = formatted.split('.');
                formatted = split[0] + '.' + split[1].substring(0, 2);
            }
            if(inout_id == 'net_month_inc') {
                var max = '9';
                $("#"+inout_id).attr('maxlength','9');
            } else if(inout_id == 'loan_amount') {
                var max = '12';
                $("#"+inout_id).attr('maxlength','12');
            }
            // $("#"+inout_id).val(formatted);
            if($("#"+inout_id).val() != undefined || $("#"+inout_id).val() != "" || $.trim($("#"+inout_id).val()) != "") {
                var temp_val = $("#"+inout_id).val()
                if(temp_val.length > 12) {
                    $("#" + inout_id).val("");
                    return false;
                }
            }

            var words = new Array();
            words[0] = '';
            words[1] = 'One';
            words[2] = 'Two';
            words[3] = 'Three';
            words[4] = 'Four';
            words[5] = 'Five';
            words[6] = 'Six';
            words[7] = 'Seven';
            words[8] = 'Eight';
            words[9] = 'Nine';
            words[10] = 'Ten';
            words[11] = 'Eleven';
            words[12] = 'Twelve';
            words[13] = 'Thirteen';
            words[14] = 'Fourteen';
            words[15] = 'Fifteen';
            words[16] = 'Sixteen';
            words[17] = 'Seventeen';
            words[18] = 'Eighteen';
            words[19] = 'Nineteen';
            words[20] = 'Twenty';
            words[30] = 'Thirty';
            words[40] = 'Forty';
            words[50] = 'Fifty';
            words[60] = 'Sixty';
            words[70] = 'Seventy';
            words[80] = 'Eighty';
            words[90] = 'Ninety';

            amount = amount.toString();
            var atemp = amount.split(".");
            var number = atemp[0].split(",").join("");
            var n_length = number.length;
            var words_string = "";
            if (n_length <= 9) {
                var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
                var received_n_array = new Array();
                for (var i = 0; i < n_length; i++) {
                    received_n_array[i] = number.substr(i, 1);
                }
                for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                    n_array[i] = received_n_array[j];
                }
                for (var i = 0, j = 1; i < 9; i++, j++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        if (n_array[i] == 1) {
                            n_array[j] = 10 + parseInt(n_array[j]);
                            n_array[i] = 0;
                        }
                    }
                }
                value = "";
                for (var i = 0; i < 9; i++) {
                    if (i == 0 || i == 2 || i == 4 || i == 7) {
                        value = n_array[i] * 10;
                    } else {
                        value = n_array[i];
                    }
                    if (value != 0) {
                        words_string += words[value] + " ";
                    }
                    if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Crores ";
                    }
                    if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Lakhs ";
                    }
                    if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                        words_string += "Thousand ";
                    }
                    if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                        words_string += "Hundred and ";
                    } else if (i == 6 && value != 0) {
                        words_string += "Hundred ";
                    }
                }
                words_string = words_string.split("  ").join(" ");
            }
            var finl_amt_rs = capitalizeFirstLetter(words_string);    

            if(amount == 0 || amount == "" || amount.trim() == "" || isNaN(amount)) {
                $("."+inout_id+"_value_formt").text("");
            } else {
                $("."+inout_id+"_value_formt").text("Rs. " + finl_amt_rs);
            }
        }
    });

    $('input.loan_net_incm').keyup(function() {
        console.log("Initiated");
        if($(this).val() != undefined){
            var amount = $(this).val().replace(/,/gi, "");
        } else {
            var amount = $(this).val();
        }
        var inout_id = $(this).attr('id');
        var min_idval =  $(this).attr('data-rule-min');
        
        // skip for arrow keys
            var finl_in = amount.replace(',','');
            if (finl_in.length < 1)
                $("#"+inout_id).val('');
            else {
                var val = parseFloat(finl_in);
                var formatted = inrFormat(finl_in);
            if (formatted.indexOf('.') > 0) {
                var split = formatted.split('.');
                formatted = split[0] + '.' + split[1].substring(0, 2);
            }
            
            if(inout_id == 'loan_amount') {
                var max = '12';
                $("#"+inout_id).attr('maxlength','12');
            } else if(inout_id == 'net_month_inc' ) {
                var max = '9';
                $("#"+inout_id).attr('maxlength','9');
            }
            $("#"+inout_id).val(amount);
            } 
        
        var words = new Array();
        words[0] = '';
        words[1] = 'One';
        words[2] = 'Two';
        words[3] = 'Three';
        words[4] = 'Four';
        words[5] = 'Five';
        words[6] = 'Six';
        words[7] = 'Seven';
        words[8] = 'Eight';
        words[9] = 'Nine';
        words[10] = 'Ten';
        words[11] = 'Eleven';
        words[12] = 'Twelve';
        words[13] = 'Thirteen';
        words[14] = 'Fourteen';
        words[15] = 'Fifteen';
        words[16] = 'Sixteen';
        words[17] = 'Seventeen';
        words[18] = 'Eighteen';
        words[19] = 'Nineteen';
        words[20] = 'Twenty';
        words[30] = 'Thirty';
        words[40] = 'Forty';
        words[50] = 'Fifty';
        words[60] = 'Sixty';
        words[70] = 'Seventy';
        words[80] = 'Eighty';
        words[90] = 'Ninety';
        amount = amount.toString();
        var atemp = amount.split(".");
        var number = atemp[0].split(",").join("");
        var n_length = number.length;
        var words_string = "";
        if (n_length <= 9) {
            var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
            var received_n_array = new Array();
            for (var i = 0; i < n_length; i++) {
                received_n_array[i] = number.substr(i, 1);
            }
            for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
                n_array[i] = received_n_array[j];
            }
            for (var i = 0, j = 1; i < 9; i++, j++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    if (n_array[i] == 1) {
                        n_array[j] = 10 + parseInt(n_array[j]);
                        n_array[i] = 0;
                    }
                }
            }
            value = "";
            for (var i = 0; i < 9; i++) {
                if (i == 0 || i == 2 || i == 4 || i == 7) {
                    value = n_array[i] * 10;
                } else {
                    value = n_array[i];
                }
                if (value != 0) {
                    words_string += words[value] + " ";
                }
                if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Crores ";
                }
                if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Lakhs ";
                }
                if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                    words_string += "Thousand ";
                }
                if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                    words_string += "Hundred and ";
                } else if (i == 6 && value != 0) {
                    words_string += "Hundred ";
                }
            }
            words_string = words_string.split("  ").join(" ");
        }
        
        // if((parseInt(amount) >= parseInt(min_idval)) && parseInt($(this).val().length) <= parseInt(max) ){
            var finl_amt_rs = capitalizeFirstLetter(words_string);
            $("."+inout_id+"_value_formt").text("Rs. "+finl_amt_rs);
        // } else {
            // $("."+inout_id+"_value_formt").text('');
        // }

    });
});   

function inrFormat(val) {
    var x = val;
    x = x.toString();
    var afterPoint = '';
    if (x.indexOf('.') > 0)
        afterPoint = x.substring(x.indexOf('.'), x.length);
    x = Math.floor(x);
    x = x.toString();
    var lastThree = x.substring(x.length - 3);
    var otherNumbers = x.substring(0, x.length - 3);
    if (otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
    return res;
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
}