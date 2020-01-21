var SimpleChat = {
    
    openNav : function () {
        document.getElementById("mySidenav").style.width = "250px";
    },
    
    closeNav : function() {
        document.getElementById("mySidenav").style.width = "0";
    },
    
    getCookie : function(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    },
    
    setCookie : function(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    },
    
    convertTime : function(UNIX_timestamp){
        var a = new Date(UNIX_timestamp * 1000);
        var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var year = a.getFullYear();
        var month = months[a.getMonth()];
        var date = a.getDate();
        var hour = a.getHours();
        var ampm = "am";
        if (hour == 0){
            hour = 12;
            var ampm = "am";
        } 
        if (hour >= 13){
            hour = hour - 12;
            var ampm = "pm";
        }
        if (hour < 10){ hour = '0'+hour;}
        var min = a.getMinutes();
        if (min < 10){ min = '0'+min;}
        var sec = a.getSeconds();
        if (sec < 10){ sec = '0'+sec;}
        var time = month + ' ' + date +', ' + year + ' ' + hour + ':' + min + ':' + sec + ' ' + ampm;
        return time;
    },
    
    checkRegistration : function(){
        if(document.getElementById("username").value == ""){
            document.getElementById("warning-text").innerHTML = "Enter a Username";
            document.getElementById("warning").style.display = "block";
            return false;
        }
        if(document.getElementById("password").value.length < 8){
            document.getElementById("warning-text").innerHTML = "Password must be at least 8 characters";
            document.getElementById("warning").style.display = "block";
            return false;
        }
        if(document.getElementById("password").value.length != document.getElementById("password2").value.length){
            document.getElementById("warning-text").innerHTML = "Passwords do not match";
            document.getElementById("warning").style.display = "block";
            return false;
        }
    },
    
    checkRoomName : function(){
        if(document.getElementById("roomname").value == ""){
            return false;   
        }  
    },
    
    addMessage : function() {
        if(document.getElementById("message").value != ""){
            var xhttp = new XMLHttpRequest();
            xhttp.convertTime = this.convertTime;
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var message = JSON.parse(this.responseText);
                    var message_bubble = document.createElement("div");
                    message_bubble.id = "message-me".concat(message.message_id);
                    message_bubble.className = "message-me";
                    var message_room = document.createElement("div");
                    message_room.className = "message-room";
                    message_room.innerHTML = "Room: ".concat(message.roomname);
                    var message_username = document.createElement("div");
                    message_username.className = "message-username"
                    message_username.innerHTML = message.username;
                    var message_timestamp = document.createElement("span");
                    message_timestamp.className = "message-timestamp";
                    message_timestamp.innerHTML = " ".concat(this.convertTime(message.timestamp));
                    var message_text = document.createElement("div");
                    message_text.className = "message-text";
                    message_text.innerHTML = message.message;

                    message_username.appendChild(message_timestamp);
                    message_bubble.appendChild(message_room);
                    message_bubble.appendChild(message_username);
                    message_bubble.appendChild(message_text);

                    document.getElementById("message-area").appendChild(message_bubble);
                    document.getElementById("message-area").scrollTop = document.getElementById("message-area").scrollHeight;
                    document.getElementById("message").value = "";
                    document.getElementById("last_message").value = message.message_id;
                }
            };
            xhttp.open("POST", "add_message.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("username=".concat(this.getCookie("username"),"&ip=",this.getCookie("ip"),"&message=",document.getElementById("message").value,"&room_id=",document.getElementById("room_id").value));
        }
    },
    
    updateMessages : function(){
        window.setInterval(function(self){
            var xhttp = new XMLHttpRequest();
            xhttp.convertTime = self.convertTime;
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var messages = JSON.parse(this.responseText);
                    for (var i in messages) {
                        if (messages[i].username == messages[i].current_user && messages[i].ip == messages[i].current_user_ip){
                            var message_bubble = document.createElement("div");
                            message_bubble.id = "message-me".concat(messages[i].message_id);
                            message_bubble.className = "message-me";
                            var message_room = document.createElement("div");
                            message_room.className = "message-room";
                            message_room.innerHTML = "Room: ".concat(messages[i].roomname);
                            var message_username = document.createElement("div");
                            message_username.className = "message-username"
                            message_username.innerHTML = messages[i].username;
                            var message_timestamp = document.createElement("span");
                            message_timestamp.className = "message-timestamp";
                            message_timestamp.innerHTML = " ".concat(this.convertTime(messages[i].timestamp));
                            var message_text = document.createElement("div");
                            message_text.className = "message-text";
                            message_text.innerHTML = messages[i].message;

                            message_username.appendChild(message_timestamp);
                            message_bubble.appendChild(message_room);
                            message_bubble.appendChild(message_username);
                            message_bubble.appendChild(message_text);
                        } else {
                            var message_bubble = document.createElement("div");
                            message_bubble.id = "message-you".concat(messages[i].message_id);
                            message_bubble.className = "message-you";
                            var message_room = document.createElement("div");
                            message_room.className = "message-room";
                            message_room.innerHTML = "Room: ".concat(messages[i].roomname);
                            var message_username = document.createElement("div");
                            message_username.className = "message-username"
                            var usernameNode = document.createTextNode(" ".concat(messages[i].username));
                            var message_timestamp = document.createElement("span");
                            message_timestamp.className = "message-timestamp";
                            message_timestamp.innerHTML = " ".concat(this.convertTime(messages[i].timestamp));
                            var message_text = document.createElement("div");
                            message_text.className = "message-text";
                            message_text.innerHTML = messages[i].message;

                            message_username.appendChild(message_timestamp);
                            message_username.appendChild(usernameNode);
                            message_bubble.appendChild(message_room);
                            message_bubble.appendChild(message_username);
                            message_bubble.appendChild(message_text);
                        }
                        document.getElementById("message-area").appendChild(message_bubble);
                        document.getElementById("message-area").scrollTop = document.getElementById("message-area").scrollHeight;
                        document.getElementById("message").value = "";
                        document.getElementById("last_message").value = messages[i].message_id;
                    }
                }
            };
            xhttp.open("POST", "get_messages.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("id=".concat(document.getElementById("room_id").value,"&last_message_id=",document.getElementById("last_message").value));
        }, 2000, this);
    }
    
}
