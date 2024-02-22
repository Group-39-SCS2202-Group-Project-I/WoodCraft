<?php include "inc/header.view.php"; ?>
<!-- <?php echo $data['id'] ?> -->
<style>
    .chatbox {
        width: 100%;
        height: 90%;
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
        margin: 1rem 0 1rem 0;
    }

    .receiver-message {
        min-width: 30%;
        background-color: var(--secondary);
        /* border-radius: 10px; */
        border-radius: 0 .75rem .75rem .75rem;
        padding: 1rem;
        align-self: flex-start;
        margin: 0.3rem 0 0.3rem 0;
    }

    .chatbox-message-item-time {
        float: right;
        font-size: .75rem;
        margin-top: .5rem;
        /* display: inline-block; */
    }

    .chatbox-header {
        display: flex;
        padding: 20px;
        background-color: var(--blk);
        color: var(--light);
        border-radius: 10px 10px 0 0;
    }
</style>

<?php
$osr_user_id = $_SESSION['USER_DATA']->user_id;
$cus_user_id = $data['id'];

$chat_url = ROOT . "/fetch/chat_by_cus_id/" . $cus_user_id;
$response = file_get_contents($chat_url);
$chats = json_decode($response, true);

$cus_name = $chats['cus_name'];
$chat_id = $chats['chat_id'];

// show($chat_id);

?>

<div class="chatbox-header">
    <span class="material-symbols-outlined">
        person
    </span>

    <p> &nbsp;<?= $cus_name ?></p>
</div>
<div class="chatbox">

    <div id="chatlogs" class="chatlog">
        <?php

        $chat_record_url = ROOT . "/fetch/chat_records/" . $chat_id;
        $chat_record_response = file_get_contents($chat_record_url);
        $chat_records = json_decode($chat_record_response, true);

        // show($chat_records);

        if ($chat_records) {
            foreach ($chat_records as $chat_record) {
                if ($chat_record['sent_by'] == $cus_user_id) {
                    echo "<div class='receiver-message'>{$chat_record['message']}<span class='chatbox-message-item-time'>{$chat_record['created_at']}</span></div>";
                } else {
                    echo "<div class='sender-message'>{$chat_record['message']}<span class='chatbox-message-item-time'>{$chat_record['created_at']}</span></div>";
                }
            }
        }


        ?>


    </div>

    <div class="chatbox-input">
        <div><textarea id="chat-input" placeholder="Type a message..."></textarea></div>
        <div><button id="send-btn" onclick='send()'><span class="material-symbols-outlined">
                    send
                </span></button></div>
    </div>
</div>

<script>
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        console.log('Connection established!');
        conn.send(JSON.stringify({
            'newRoute': 'Personalchat-<?= $chat_id ?>'
        }));

    };

    document.getElementById('chat-input').scrollIntoView();

    function typing() {
        conn.send(JSON.stringify({
            'typing': 'y',
            'name': 'Support Agent'
        }));
    }

    const textarea = document.getElementById('chat-input');
    const btn = document.getElementById('send-btn');

    var dateTime = new Date();
    var date = dateTime.toLocaleDateString();
    var time = dateTime.toLocaleTimeString([], {
        hour: '2-digit',
        minute: '2-digit'
    });

    conn.onmessage = function(e) {
        let data = JSON.parse(e.data);
        console.log(data);
        if (typeof data.message !== 'undefined') {
            let message = `<div class="receiver-message">${data.message}<span class="chatbox-message-item-time">${date} ${time}</span></div>`;
            document.getElementById('chatlogs').innerHTML += message;
            document.getElementById('chat-input').scrollIntoView();
        } else if (typeof data.typing !== 'undefined') {
            console.log(data.typing);
            // 
            document.getElementById('chat-input').scrollIntoView();
        }
    }

    textarea.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            btn.click();
            textarea.value = '';

            document.getElementById('chat-input').scrollIntoView();
        }
    })

    function send() {
        conn.send(JSON.stringify({
            'sent_by': '<?= $osr_user_id ?>',
            'message': textarea.value,
            'created_at': `${date} ${time}`
        }));


        sendMessage(textarea.value, <?= $chat_id ?>);
        let message = `<div class="sender-message">${textarea.value}<span class="chatbox-message-item-time">${date} ${time}</span></div>`;
        document.getElementById('chatlogs').innerHTML += message;
        document.getElementById('chat-input').scrollIntoView();
        textarea.value = '';





    }

    function sendMessage(message, chat_id) {

        let data = {
            connection: chat_id,
            message: message,
            sent_by: '<?= $osr_user_id ?>',
            created_at: `${date} ${time}`

        };

        // var xhr = new XMLHttpRequest();
        // xhr.open("POST", "<?= ROOT ?>/add/chat_record", true);
        // xhr.setRequestHeader('Content-Type', 'application/json');
        // xhr.send(JSON.stringify(data));
        $.ajax({
            url: '<?= ROOT ?>/add/chat_record',
            type: 'POST',
            data: data,
            success: function(response) {
                console.log(response);
            }
        });
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<?php include "inc/footer.view.php"; ?>