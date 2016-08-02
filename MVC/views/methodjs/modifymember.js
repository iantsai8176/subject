emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
                $(document).ready(function() {
            $("#modify").click(function() {
                if ($("#Modify_email").val().search(emailRule) == -1) {
                    $(".Modify_email_error").text("請填入有效Email").css("color","red");
                    eval("document.form3['Modify_email'].focus()");
                }
                else if (($("#Modify_psw").val() == "")) {
                    $(".Modify_psw_error").text("不能為空值").css("color","red");;
                    eval("document.form3['Modify_psw'].focus()");
                }
                else {
                    document.form3.submit();
                }
            })
        })