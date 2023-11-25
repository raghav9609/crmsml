var deviceId = 2;
        if (screen.width < 480) {
            deviceId = 1;
        } else if (screen.width > 767 && screen.width < 1023) {
            deviceId = 3;
        }
        var step = 0;
        $(document).ready(function () {
            $("#submit").click(function () {
                var user = $("#user").val();
                var pwd = $("#password").val();
                if (user == '') {
                    $("#err").addClass("red").text("Enter Corrent LoginID");
                } else if (step == 1 && pwd == '') {
                    $("#err").addClass("red").text("Enter Corrent OTP/ Password");
                } else {
                    $.ajax({
                        type: "POST",
                        data: "id=" + user + "&otp=" + pwd + "&deviceId=" + deviceId,
                        url: headURL+"include/login-action.php",
                        cache: false,
                        beforeSend: function () {
                            $("#submit").val('Please Wait....');
                        },
                        success: function (response) {
                            var data = $.parseJSON(response);
                            $("#err").addClass("red").text("");
                            if (data.status == 'error') {
                                $("#err").addClass("red").text(data.message);
                            }
                            if(data.goto != ''){
                                window.location.href = data.goto;
                            }
                            $("#submit").val('Login');
                        }
                    });
                }

            });
        });
        var user_field = document.getElementById("user");
        user_field.addEventListener("keyup", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $(".buttonsub").trigger("click");
            }
        });
        var pass_field = document.getElementById("password");
        pass_field.addEventListener("keyup", function (event) {
            if (event.keyCode === 13) {
                event.preventDefault();
                $(".buttonsub").trigger("click");
            }
        });