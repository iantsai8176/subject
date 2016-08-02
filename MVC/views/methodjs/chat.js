                        function MakeRequest()
                        {
                        	$.ajax({
                        		type:"GET",
                        		url:"Home/chat?rq=msg",
                        		data:{newmsg:$("#msg").val()},
                        		dataType:"json",
                        		success:function(data){
                        			//$("#ResponseDiv").append('<div>'+data["username"]+':'+data["msg"]+'</div>')
                        			$("#msg").val("");
                        		}
                        	});
                        }
            
                        $(document).ready(function(){
                        	setInterval(startRequest,3000);
                        })
                        
                        function startRequest(){
                        	$.ajax({
                        		type:"GET",
                        		url:"Home/chat?rq=update",
                        		data:{capturemsg:"1"},
                        		dataType:"json",
                        		success:function(data){
                        			//var array = JSON.parse(data);
                        			console.log(data)
                        			if(data["status"] == 0){
                        				console.log(data);
                        				$("#ResponseDiv").append('<div>'+data["username"]+':'+data["msg"]+'{'+data["time"]+'}'+'</div>')
                        				$('#ResponseDiv').scrollTop ($('#ResponseDiv').height());
                        			}
                        			else{
                        			}
                        		}
                        	})
                        
                        }