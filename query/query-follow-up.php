<?php
$query_id = $id;
?>
<script src="<?php echo $head_url; ?>/assets/js/query-follow-up.js?version=1.84"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $head_url; ?>/assets/css/style.css"/>
<style type="text/css">
    .query_follow li {
        color: blue;
    }
    .query_follow li:nth-child(odd) {
        color: #18365E;
    }

    .query_follow li:nth-child(even) {
        color: #d8450b;
    }
    .open>.dropdown-menu {
    display: block;
}
label.checkbox{
    margin-top:1px!important;
}

.multiselect-container {
    position: absolute!important;
    list-style-type: none!important;;
    margin: 0!important;
    padding: 0!important;
}
.dropdown-menu {
    z-index: 1000;
    display: none;
    float: left;
    padding: 5px 0;
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    border: 1px solid #ccc;
      left: -205px;
    width: 255px;
}
.add_checkbox{
    position: unset!important;
}

.dropdown-menu>li>a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
}
.multiselect{margin-top: 11px;border-radius: 0px!important;box-shadow: none!important;}

.multiselect-container>li>a {
    padding: 0;
}
b.caret{
    margin-left:228px!important;
    display: inline;
}
.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
    color: #262626;
    text-decoration: none;
    background-color: #f5f5f5;
}

.checkbox, .radio {
    position: relative;
    display: block;
    margin-top: 10px;
    margin-bottom: 10px;
}

.multiselect-container>li>a>label {
    margin: 0;
    height: 100%;
    cursor: pointer;
    font-weight: 400;
}


.multiselect-container>li>a>label.checkbox, .multiselect-container>li>a>label.radio {
    margin: 0;
}

.dropdown-menu>li>a {
    display: block;
    padding: 3px 20px;
    clear: both;
    font-weight: 400;
    line-height: 1.42857143;
    color: #333;
    white-space: nowrap;
}

.form-group label {
    font-size: 12px;
    font-weight: 500;
    width: 100px;
    color: #636363;
    display: block;
    background: #ffffff;
    padding: 3px 0px!important 0px 0px;
    cursor: text;
    -webkit-transition: all .3s ease 0ms;
    -moz-transition: all .3s ease 0ms;
    -ms-transition: all .3s ease 0ms;
    -o-transition: all .3s ease 0ms;
    transition: all .3s ease 0ms;
}
.border-class, .register textarea{
    width: 85%;
    outline: medium none;
    background: transparent none repeat scroll 0% 0%;
    border: none;
    border-bottom: 1px solid #eb9b42;
    height: 25px;
    font-family: roboto;
    font-size: 12px;
    color: #000;
    text-decoration: none;
    line-height: 1;
    text-align: left;
    }
    .multiple-sub-status-label{
        width: calc(100% - 30px);
        top: -18px;
        background: 0 0;
        color: #18375f;
        font-size: 12px;
        left: 15px;
    }
    </style>

<div id="ad_form" style="border: 1px solid #CCC;padding:10px;">
    <form method="POST" id="follow_up_form">
    <input type="hidden" name="query_id" id="query_id" value="<?php echo $query_id; ?>">
    
    <div class="row div-width">       
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-list-alt"></span>
        <?php  get_dropdown('query_status', 'f_stats', '', 'class="valid" required'); ?>
        <label for="f_stats" class="label-tag">Select Status</label>
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-user"></span>
        <select name='folow_given' id='folow_given' class="valid" required>
            <option value="">Feedback Given By</option>
			
                <option value='1'>Customer</option>
                <option value='2' selected="selected">SML User</option>
            
        </select>
        <label for="folow_given" class="label-tag">Feedback Given By</label>
        </div>
        
        <div class="form-group col-xl-3 col-lg-4 col-md-6 fol_date hidden">
        <span class="fa-icon fa-calendar"></span>
        <input type="text" name="fol_date" id="fol_date" placeholder="yyyy-mm-dd" class="hidden valid onlybackspace" maxlength="10" autocomplete="off">
        <label for="fol_date" class="label-tag">Follow Up Date</label>
        </div>
        <div class="form-group col-xl-3 col-lg-4 col-md-6 fol_time hidden">
        <span class="fa-icon fa-clock-o"></span>
        <input type="text" name="fol_time" id="fol_time" class="time hidden valid onlybackspace" placeholder="Follow Up Time" maxlength="8" autocomplete="off">
        <label for="fol_time" class="label-tag">Follow Up Time</label>
        </div>
        
        
        <div class="form-group col-xl-3 col-lg-4 col-md-6">
        <span class="fa-icon fa-commenting"></span>
        <textarea name="remark" id="remark" placeholder="Remarks" class="valid border-class" autocomplete="off"></textarea>
        <label for="remark" class="label-tag optional-tag">Remarks</label>
        </div>
        
        </div>
        <div class="form-group col-xl-12 col-lg-4 col-md-6">
        <input type="button" name="ad_query" id="ad_query" class="buttonsub cursor valid" value="Submit">
        </div>
    </form>
</div>
<br><br>
<script type='text/javascript'>
$("#fol_time").focusout(function() {
    if($("#fol_time").val() != "") {
        $("#follow_up_time_t").val($("#fol_time").val());
    }
});
</script>