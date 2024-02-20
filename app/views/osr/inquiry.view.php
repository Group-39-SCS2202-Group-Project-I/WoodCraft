<?php include "inc/header.view.php"; ?>
<!-- <?php echo $data['id'] ?> -->
<style>
    .chatbox {
        width: 100%;
        height: 100%;
        border-radius: 10px;
        overflow: auto;
        background-color: white;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        /* Added this line */
    }

    .chatlog {
        display: flex;
        flex-direction: column;
    }

    .chatlog p {
        margin: 10px 0;
    }

    .chatbox-input {
        display: grid;
        grid-template-columns: 89% 10%;
        justify-content: space-between;
        padding-top: 20px;
        box-sizing: border-box;
    }

    #chat-input {
        width: 100%;
        text-align: left;
        padding: 1rem;
        height: 5rem;
        border: none;
        border-radius: 5px;
        background-color: var(--light);
        color: var(--blk);
        resize: none;
    }

    #send-btn {
        width: 100%;
        padding-top: 2rem;
        padding: 1rem;
        height: 5rem;
        border: none;
        border-radius: 5px;
        background-color: var(--blk);
        color: var(--light);
        cursor: pointer;
        transition: background-color 0.2s ease-in-out;
    }

    #send-btn:hover {
        background-color: var(--primary);
        /* color: var(--blk); */
    }

    #chat-input:focus {
        outline: none;
        border: 0.1rem solid var(--primary);
    }

    .sender-message {
        min-width: 30%;
        background-color: var(--primary);
        color: white;
        /* border-radius: 10px; */
        border-radius: .75rem 0 .75rem .75rem;
        padding: 1rem;
        align-self: flex-end;
    }

    .receiver-message {
        min-width: 30%;
        background-color: var(--secondary);
        /* border-radius: 10px; */
        border-radius: 0 .75rem .75rem .75rem;
        padding: 1rem;
        align-self: flex-start;
    }

    .chatbox-message-item-time {
        float: right;
        font-size: .75rem;
        margin-top: .5rem;
        /* display: inline-block; */
    }
</style>
<div class="chatbox">
    <div id="chatlogs" class="chatlog">
        <!-- Chat logs will appear here -->

        <div class="sender-message ">John: Hello! <span class="chatbox-message-item-time">8.30</span></div>
        <div class="receiver-message ">Jane: Hi! <span class="chatbox-message-item-time">8.31</span></div>
        <div class="sender-message ">John: How are you? <span class="chatbox-message-item-time">8.32</span></div>
        <div class="receiver-message">Jane: I'm good. <span class="chatbox-message-item-time">8.33</span></div>
        

    </div>

    <div class="chatbox-input">
        <div><textarea id="chat-input" placeholder="Type a message..."></textarea></div>
        <div><button id="send-btn"><span class="material-symbols-outlined">
                    send
                </span></button></div>
    </div>
</div>

<script>
    document.getElementById('chat-input').scrollIntoView();
    document.getElementById('chat-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter' && !e.ctrlKey) {
            e.preventDefault();
            document.getElementById('send-btn').click();
        }
    });
    document.getElementById('send-btn').addEventListener('click', function() {
        var input = document.getElementById('chat-input');
        var message = input.value;
        input.value = '';
        // Replace '\n' with '<br>' to display the message in the next line
        message = message.replace(/\n/g, '<br>');

        var chatlogs = document.getElementById('chatlogs');
        var newMessage = document.createElement('p');
        newMessage.innerHTML = message;

        // Determine the sender of the message
        var sender = 'sender-message'; // Assuming the sender is the current user

        var dateTime = new Date();
        var date = dateTime.toLocaleDateString();
        var time = dateTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

        newMessage.innerHTML += `<span class="chatbox-message-item-time">${date} ${time}</span>`;
        

        // newMessage.innerHTML += `<span class="chatbox-message-item-time">${time}</span>`;

        // Add the appropriate class based on the sender
        newMessage.classList.add(sender);

        // chatlogs.scrollTop = 0;
        chatlogs.appendChild(newMessage);

        input.scrollIntoView();
    });
</script>
<?php include "inc/footer.view.php"; ?>