
      
    $(document).ready(function () {
        $("#old_password").focusout(function () {
            $(".old_passwd .error").addClass("hidden").text("");
            var old_password = $("#old_password").val(); 
            $.ajax({
                type: "POST",
                url: "/disbursement/update.php",
                data: "old_password="+old_password+"&check=1",
                success: function (response) {
                    var isPasswordValid = JSON.parse(response);
                    if (old_password == '' || old_password.length < 5 || old_password.length > 16) {
                        $(".old_passwd .error").removeClass("hidden").text("Enter Old Password Between 5 - 16 Characters");
                    }else if(isPasswordValid.status_code == 2){
                        $(".old_passwd .error").removeClass("hidden").text(isPasswordValid.message);
                    }
                    else {
                        $(".old_passwd .error").addClass("hidden");
                    }
                }
            });
        });
            $(".alphanum").on("input", function(){
            var regexp = /[^a-zA-Z0-9!@#%&]/g;
            if($(this).val().match(regexp)){
            $(this).val( $(this).val().replace(regexp,'') );
            }
        });
 
        $("#new_password").focusout(function () {
            $(".new_passwd .error").addClass("hidden").text("");
            let passwordValue = $("#new_password").val();
            var old_password = $("#old_password").val();
            if (passwordValue.length == "" || passwordValue.length <5 || passwordValue.length > 16 ) {
                $(".new_passwd .error").removeClass("hidden").text("Enter New Password between 5 - 16 Characters");
            }else if(old_password == passwordValue){
                $(".new_passwd .error").removeClass("hidden").text("Old password and new password should be different."); 
            }
            else {
                $(".new_passwd .error").addClass("hidden");
            }
        });

        $("#confirm_password").focusout(function () { 
            $(".ConfrmPassword .error").addClass("hidden").text("");
            let confirmPasswordValue = $("#confirm_password").val();
            let passwordValue = $("#new_password").val();
            if (passwordValue != confirmPasswordValue) {
                $(".ConfrmPassword .error").removeClass("hidden").text("New Password & Confirm Password Does not match !!!");
            }
            else{
                $(".ConfrmPassword .error").addClass("hidden");
            }
        });
        $("#submit_pass").click(function () { 
            let confirmPasswordValue = $("#confirm_password").val();
            let passwordValue = $("#new_password").val();
            var old_password = $("#old_password").val();
            $.ajax({
                type: "POST",
                url: "/disbursement/update.php",
                data: "new_password="+passwordValue+"&confirm_password="+confirmPasswordValue+"&old_password="+old_password+"&check=2",
                success: function (response) {
                    var isPasswordValid = JSON.parse(response);
                        Swal.fire({
                            icon: isPasswordValid.status,
                            text: isPasswordValid.message,
                            timer: 3000
                        }).then(function () {
                            window.location="/disbursement/password.php";
                        })
                    
                            
                }
            });
        });
    });