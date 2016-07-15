<!DOCTYPE html>  
<html>  
<head>  
    <meta charset="utf-8"/>  
    <meta name="viewport" content="width=device-width"/>  
    <link rel="stylesheet" type="text/css" href="./styles/chat-mobile.css"/>  
    <script type="text/javascript" src="./scripts/jquery-1.8.2.min.js"></script>  
    <script type="text/javascript">  
    $(function() {  
        timestamp = 0;  
        updateMsg(timestamp);  
        $('button').click(function() { //重点是这里，从这里向服务器端发送数据  
            $.post('chat.php', {  
                'message': $('#msg').val(),  
                'name': $('#name').val(),  
                'timestamp': timestamp  
            },function(xml) {  
                $('#msg').val('');  
                addMessage(xml);  
            });  
            return false;  
        });  
  
        $('#name').blur(function (){ //仅仅用来控制名字输入框的背景  
            if ($('#name').val()) {  
                $(this).css({"background": "url(images/background.jpg)", "border": "2px dashed #fff"});  
            };  
        });  
        $('#name').click(function () {  
            $(this).css({"background": "#fff", "border": "2px solid #fff"});  
        })  
  
    });  
    //update message  
    function updateMsg(timestamp) { //从服务器端更新聊天数据，并载入吧  
        $.post('chat.php', {'timestamp': timestamp}, function(xml) {  
            $('#loading').remove();  
            addMessage(xml);  
        });  
        setTimeout('updateMsg(timestamp);', 1000); //1s刷新一次信息  
    }  
    function addMessage(xml) { //解析xml，并添加到页面内  
        if($('status', xml).text() == 2) {  
            return;  
        };  
        timestamp = $('timestamp', xml).text();  
        $('message', xml).each(function() {  
            var author = $('author', this).text();  
            var content = $('content', this).text();  
            var time = $('time', this).text();  
            var htmlcode = '<div><strong>' + author + ': </strong><label>' + time + '</label><p>' + content + '</p></div>';  
            $('#messageWindow').append(htmlcode);  
            scrollToBottom();  
        });  
    }  
    function scrollToBottom () { //控制滚动条一直显示在底部  
        var height = document.getElementById('messageWindow').scrollHeight;  
        if (height > $('#messageWindow').scrollTop()) {  
            $('#messageWindow').scrollTop(height);  
        }  
    }  
  
    </script>  
</head>  
<body>  
    <header>  
        <div id="hr"></div>  
    </header>  
  
    <div id="wrapper">  
        <div id="window">  
            <div id="messageWindow">  
                <span id="loading">loading...</span>  
            </div>  
            <form id="chatform">  
                <label>your message:</label>  
                <textarea type="text" id="msg" size="50"/></textarea>  
                <input type="text" id="name" size="10" placeholder="your name"/>  
                <button accesskey="s">Send</button>  
            </form>  
        </div>  
    </div>  
    <br/>  
    <br/>  
    <p id="hint">Hint: 移动版的，开放的聊天室</p>  
  
    <footer>  
        <p>©SamuraiMe</p>  
    </footer>  
</body>  
</html>  