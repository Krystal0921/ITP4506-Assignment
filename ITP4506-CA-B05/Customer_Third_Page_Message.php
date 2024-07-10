<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/Customer_Third_Page_Message.css">
    <link rel="stylesheet" href="./style/nav.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Customer Message Page</title>
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
    <nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="./Customer_Main_Page.php"><b>Restaurant Menu</b></a>
        <a class="navbar-brand" href="./Customer_Second_Page.php"><b>Cart</b></a>
        <a class="navbar-brand" href="./Customer_Third_Page.php"><b>Order Record</b></a>
        <label id="username"><b><?php echo "Hello, " . $_SESSION['user']->user_Name ?></b></label>
        <div id="datetime-display" class="datetime"><b>Date: </b></div>
        <div class="nav-right"><a class="navbar-brand" href="./Login.php"><b>Logout</b></a></div>
    </nav>
    <form style="background">
        <center><hr><h3><b>Chat Box</b></h3></hr></center>
        <center><div id="chatbox"></div></center>
        <center><input type="text" id="message" placeholder="Type your message"></center>
        <center><button id="send">Send</button><button type="reset" id="reset">Reset</button></center>
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