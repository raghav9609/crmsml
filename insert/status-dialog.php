<?php if($height_dynamic == ''){
    $height_dynamic = 80;
} ?>
<style>
.resp-tab-content {
    /* display: block!important; */
}
.fixed_move_btn{
    right: 20.2%!important;
    padding: 3px!important;
}
.box {
    width: 40%;
    margin: 0 auto;
    background: rgba(255,255,255,0.2);
    padding: 35px;
    border: 2px solid #fff;
    border-radius: 20px/50px;
    background-clip: padding-box;
    text-align: center;
}
.overlay {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0, 0, 0, 0.7);
    transition: opacity 500ms;
    visibility: hidden;
    opacity: 0;
    z-index: 1050;
}
.popup-overlay {
    visibility: visible;
    opacity: 1;
}

.popup {
    margin: 70px auto;
    border-radius: 5px;
    width: 80%;
    position: relative;
    overflow: hidden;
    transition: all 5s ease-in-out;
}

.popup h2 {
    margin-top: 0;
    color: #333;
    font-family: Tahoma, Arial, sans-serif;
}
.popup .close {
    position: absolute;
    top: 20px;
    right: 30px;
    transition: all 200ms;
    font-size: 30px;
    font-weight: bold;
    text-decoration: none;
    color: #333;
    color: white;
    right: 10;
    top: 0;
    font-size: 25px;
}
.popup .close:hover {
    color: #EB9B42;
}
.popup .content {
    /*overflow: auto;*/
    background: #fff;
}
.ft-sz-12 {
    font-size: 12px !important;
}
.un-ln {
    text-decoration: underline !important;
}

.dialog-cur:disabled {
    cursor: pointer;
}
#case_follow_up_form.form-control {
    margin: 0!important;
    width:70%!important;
}
</style>
<script>
$(document).ready(function() {
    $('#dialog-cancel-btn, #cross-close').click(function() {
        $("#popup1").removeClass("popup-overlay");
        return false;
    });
})
</script>
    <div id="popup1" class="overlay">
        <div class="popup">
            <div style="font-size: 15px !important; font-weight: bold !important" class="blue-bg col-12 font-weight-nb pb-2 pt-2 white font-20">
                <span style="display: block; text-align: center"><?php echo $heading_pop_up; ?></span>
                <?php if($no_close_button_popup != 1){ ?>
                <a class="close" id="cross-close" href="javascript:void();">&times;</a>
                <?php } ?>
            </div>
            <div class="content" id="dialog-step" style="height:<?php echo $height_dynamic; ?>%;overflow-y: auto">
            <?php echo $dialog_res; ?>
            </div>
        </div>
    </div>
    <link href="../all_query/hl-journey/assets/css/grid.css?v=1.1" rel="stylesheet">
    <script src="../../include/js/jquery.validate.min.js"></script>
