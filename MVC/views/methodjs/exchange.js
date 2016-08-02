 start();
                    $(document).ready(function() {
                        $("#cal").click(function() {
                            if (!isNaN($("#num").val())) { //isNaN檢查函數是否是非數值
                                $.get("Home/exchange", {
                                    num: $("#num").val(),
                                    ex: $("#new").text()
                                }, function(data) {
                                    console.log(data);
                                    $("#answer").text(data + " JPY").css("color", "blue");
                                    $("#cal").attr("disabled", true);
                                })
                            }
                            else {
                                $("#num").val("").focus();
                                $("#answer").text("  請輸入數值").css("color", "blue");
                            }

                            $("#clear").click(function() {
                                $("#answer").text("");
                                $("#num").val("");
                                $("#cal").attr("disabled", false);
                            })
                        });
                        setInterval(start, 30000);
                    });

                    function start() {
                        $.get("Home/exchange", function(data) {
                            var array = JSON.parse(data);
                            $("#bank").text(array[2]).css("font-family");
                            $("#new").text(array[4]).css("font-family");
                        });
                    }