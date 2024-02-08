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
        grid-template-columns: 79% 20%;
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
        background-color: var(--primary);
        border-radius: 10px;
        padding: 10px 10px;
        align-self: flex-end;
    }

    .receiver-message {
        background-color: var(--secondary);
        border-radius: 10px;
        padding: 10px 10px;
        align-self: flex-start;
    }
</style>
<div class="chatbox">
    <div id="chatlogs" class="chatlog">
        <!-- Chat logs will appear here -->

        <p class="sender-message">John: Hello!</p>
        <p class="receiver-message">Jane: Hi there!</p>
        <p class="sender-message">John: How are you?</p>
        <p class="receiver-message">Jane: I'm good, thanks!</p>

    </div>

    <div class="chatbox-input">
        <div><textarea id="chat-input" placeholder="Type a message..."></textarea></div>
        <div><button id="send-btn">Send</button></div>
    </div>
</div>

<script>
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

        // Add the appropriate class based on the sender
        newMessage.classList.add(sender);

        // chatlogs.scrollTop = 0;
        chatlogs.appendChild(newMessage);

        input.scrollIntoView();
    });
</script>
<?php include "inc/footer.view.php"; ?>