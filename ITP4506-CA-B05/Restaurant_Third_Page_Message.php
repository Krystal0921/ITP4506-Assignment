<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Restaurant_Second_Page_Message.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Restaurant History Message Page</title>
    <style>
        #chatbox {
            : center;
            width: 500px;
            height: 300px;
            border: 1px solid #ccc;
            padding: 10px;
            overflow-y: scroll;
        }

        #message {
            width: 500px;
            height: 40px;
        }

        #send,#reset {
            margin-top: 10px;
            width: 10%;
            background-color: #c1a683;
            color: beige;
            padding: 10px 5px;
            margin: 10px 13px;
            border: none;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="fieldset">
        <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="./Restaurant_Main_Page.php"><b>Foods List</b></a>
            <a class="navbar-brand" href="./Restaurant_Second_Page.php"><b>Orders List</b></a>
            <a class="navbar-brand" href="./Restaurant_Third_Page.php"><b>Orders History</b></a>
            <a class="navbar-brand" href="./Restaurant_Fourth_Page.php"><b>Choose Delivery Person</b></a>
            <a class="navbar-brand" href="./Restaurant_Fifth_Page.php"><b>Delivery Person List</b></a>
            <a class="navbar-brand" href="./Login.php"><b>Logout</b></a>
        </nav>
    </div>
    <form style="background">
        <center><hr><h3><b>Chat Box</b></h3></hr></center>
        <center><div id="chatbox"></div></center>
        <input type="hidden" id="send" name="send">
        <script>
            let storedMessages = localStorage.getItem('chatMessages');
            let messages = storedMessages ? JSON.parse(storedMessages) : [];
            function updateChatBox() {
                let chatbox = document.getElementById('chatbox');
                chatbox.innerHTML = '';
                messages.forEach(function(message) {
                    let p = document.createElement('p');
                    p.textContent = message;
                    chatbox.appendChild(p);
                });
                chatbox.scrollTop = chatbox.scrollHeight;
            }
            
            document.getElementById('send').addEventListener('click', function() {
                let messageInput = document.getElementById('message');
                let message = messageInput.value.trim();
                if (message !== '') {
                    messages.push(message);
                    localStorage.setItem('chatMessages', JSON.stringify(messages));
                    messageInput.value = '';
                    updateChatBox();
                    }
            });
            updateChatBox();
        </script>
    </form>
</body>

</html>