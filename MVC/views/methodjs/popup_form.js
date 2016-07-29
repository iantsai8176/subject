        $("#modal_trigger").leanModal({//對話筐插件
            top: 200,
            overlay: 0.6,
            closeButton: ".modal_close"
        });
        $(function() {
                // Calling Register Form
                $("#register_form").click(function() {
                    $(".user_login").hide();
                    $(".user_register").show();
                    $(".header_title").text('Register');
                    return false;
                });

                //Going back to Social Forms
                $(".back_btn").click(function() {
                    $(".user_login").show();
                    $(".user_register").hide();
                    $(".header_title").text('Login');
                    return false;
                });

            })
            //--------Judge form1 data not null---
        $(document).ready(function() {
                $("#OK").click(function() {
                    if ($("#username").val() == "") {
                        $(".username_error").text("*必填").css("color","red");
                        eval("document.form1['username'].focus()");
                    }
                    else if ($("#password").val() == "") {
                        $(".password_error").text("*必填").css("color","red");
                        eval("document.form1['password'].focus()");
                    }
                    else {
                        document.form1.submit();
                    }
                })
            })
            //-------judge form2 data not null---
        emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/; //正規表示法(判斷email是否為有效格式)
        $(document).ready(function() {
            $("#confirm").click(function() {
                if ($("#newname").val() == "") {
                    $(".newname_error").text("*必填").css("color","red");
                    eval("document.form2['newname'].focus()");
                }
                else if (($("#newemail").val().search(emailRule) == -1)) {
                    $(".newemail_error").text("*請填入有效Email").css("color","red");
                    eval("document.form2['newemail'].focus()");
                }
                else if (($("#newpsw").val() == "")) {
                    $(".newpsw_error").text("*必填").css("color","red");
                    eval("document.form2['newpsw'].focus()");
                }
                else {
                    document.form2.submit();
                }
            })
        })
