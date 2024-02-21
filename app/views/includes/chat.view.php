<!-- <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'> -->
<link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<style>
    :root {
        --blue: var(--primary);
        --grey: var(--secondary);
        --grey-d-1: #EEE;
        --grey-d-2: #DDD;
        --grey-d-3: #888;
        --white: #FFF;
        --dark: #222;
    }

    /* GLOBAL STYLES */



    /* CHATBOX */
    .chatbox-wrapper {
        z-index: 1000;
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 4rem;
        height: 4rem;
    }

    .chatbox-toggle {
        width: 100%;
        height: 100%;
        background: var(--blue);
        color: var(--white);
        font-size: 2rem;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        cursor: pointer;
        transition: .2s;
    }

    .chatbox-toggle:active {
        transform: scale(.9);
    }

    .chatbox-message-wrapper {
        position: absolute;
        bottom: calc(100% + 1rem);
        right: 0;
        width: 620px;
        border-radius: .5rem;
        overflow: hidden;
        box-shadow: .5rem .5rem 2rem rgba(0, 0, 0, .1);
        transform: scale(0);
        transform-origin: bottom right;
        transition: .2s;
    }

    .chatbox-message-wrapper.show {
        transform: scale(1);
    }

    .chatbox-message-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: var(--dark);
        color: var(--white);
        padding: .75rem 1.5rem;
    }

    .chatbox-message-profile {
        display: flex;
        align-items: center;
        grid-gap: .5rem;
    }

    .chatbox-message-image {
        width: 3rem;
        height: 3rem;
        object-fit: cover;
        border-radius: 50%;
    }

    .chatbox-message-name {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--white);
    }

    .chatbox-message-status {
        font-size: .875rem;
        color: var(--grey-d-3);
    }

    .chatbox-message-dropdown {
        position: relative;
    }

    .chatbox-message-dropdown-toggle {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 2.5rem;
        height: 2.5rem;
        font-size: 1.25rem;
        cursor: pointer;
        border-radius: 50%;
    }

    .chatbox-message-dropdown-toggle:hover {
        background: var(--grey);
    }

    .chatbox-message-dropdown-menu {
        list-style: none;
        margin: 0;
        position: absolute;
        top: 100%;
        right: 0;
        background: var(--white);
        padding: .5rem 0;
        width: 120px;
        box-shadow: .25rem .25rem 1.5rem rgba(0, 0, 0, .1);
        transform: scale(0);
        transform-origin: top right;
        transition: .2s;
        border-radius: .5rem;
    }

    .chatbox-message-dropdown-menu.show {
        transform: scale(1);
    }

    .chatbox-message-dropdown-menu a {
        font-size: .875rem;
        font-weight: 500;
        color: var(--dark);
        text-decoration: none;
        padding: .5rem 1rem;
        display: block;
    }

    .chatbox-message-dropdown-menu a:hover {
        background: var(--grey);
    }

    .chatbox-message-content {
        background: var(--white);
        padding: 1.5rem;
        display: flex;
        flex-direction: column;
        grid-row-gap: 1rem;
        max-height: 300px;
        overflow-y: auto;
    }

    .chatbox-message-item {
        width: 90%;
        padding: 1rem;
    }

    .chatbox-message-item.sent {
        align-self: flex-end;
        background: var(--blue);
        color: var(--white);
        border-radius: .75rem 0 .75rem .75rem;
    }

    .chatbox-message-item.received {
        background: var(--grey);
        border-radius: 0 .75rem .75rem .75rem;
        box-shadow: .25rem .25rem 1.5rem rgba(0, 0, 0, .05);
    }

    .chatbox-message-item-time {
        float: right;
        font-size: .75rem;
        margin-top: .5rem;
        /* display: inline-block; */
    }

    .chatbox-message-bottom {
        background: var(--white);
        padding: .75rem 1.5rem;
    }

    .chatbox-message-form {
        display: flex;
        align-items: center;
        background: var(--grey);
        border-radius: .5rem;
        padding: .5rem 1.25rem;
    }

    .chatbox-message-input {
        background: transparent;
        outline: none;
        border: none;
        resize: none;
        scrollbar-width: none;
    }

    .chatbox-message-input::-webkit-scrollbar {
        display: none;
    }

    .chatbox-message-submit {
        font-size: 1.25rem;
        color: var(--blue);
        background: transparent;
        border: none;
        outline: none;
        cursor: pointer;
    }

    .chatbox-message-no-message {
        font-size: 1rem;
        font-weight: 600;
        text-align: center;
    }

    /* CHATBOX */

    .chatbox-input {
        display: grid;
        grid-template-columns: 79% 20%;
        justify-content: space-between;
        padding-top: 10px;
        box-sizing: border-box;
    }

    #chat-input {
        width: 100%;
        text-align: left;
        padding: 1rem;
        height: 4rem;
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
        height: 4rem;
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

    .chatbox-toggle:hover {
        background: var(--blk);
    }

    /* BREAKPOINTS */
    @media screen and (max-width: 576px) {
        .chatbox-message-wrapper {
            width: calc(100vw - 2rem);
        }

        .chatbox-wrapper {
            bottom: 1rem;
            right: 1rem;
        }
    }
</style>


<?php
// show ($_SESSION['USER_DATA']);
// show($_SESSION['USER_DATA']->user_id);
$user_id = $_SESSION['USER_DATA']->user_id;
$chat_url = ROOT . "/fetch/chat_by_cus_id/" . $user_id;
// show ($chat_url);
$chat_response = file_get_contents($chat_url);
$chat = json_decode($chat_response, true);
// show($chat);

$chat_id = $chat['chat_id'];
$cus_name = $chat['cus_name'];
?>


<div class="chatbox-wrapper">
    <div class="chatbox-toggle">
        <!-- <i class='bx bx-message-dots'></i> -->
        <span class="material-symbols-outlined">
            forum
        </span>
    </div>

    <div class="chatbox-message-wrapper">
        <!-- <div style="padding: 10px; border-radius:10px; background-color:var(--white);"> -->
        <div class="chatbox-message-header">
            <div class="chatbox-message-profile">
                <!-- <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8bWFufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                 
                alt="" class="chatbox-message-image"> -->


                <span class="material-symbols-outlined">
                    support_agent
                </span>

                <h4 class="chatbox-message-name">Support Agent</h4>

            </div>
            <!-- <div class="chatbox-message-dropdown">
                <i class='bx bx-dots-vertical-rounded chatbox-message-dropdown-toggle'></i>
                <ul class="chatbox-message-dropdown-menu">
                    <li>
                        <a href="#">Search</a>
                    </li>
                    <li>
                        <a href="#">Report</a>
                    </li>
                </ul>
            </div> -->
        </div>
        <div class="chatbox-message-content">
            <!-- <h4 class="chatbox-message-no-message">You don't have message yet!</h4> -->
            <!-- <div class="chatbox-message-item sent">
					<span class="chatbox-message-item-text">
						Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Quod, fugiat?
					</span>
					<span class="chatbox-message-item-time">08:30</span>
				</div>
				<div class="chatbox-message-item received">
					<span class="chatbox-message-item-text">
						Lorem, ipsum, dolor sit amet consectetur adipisicing elit. Quod, fugiat?
					</span>
					<span class="chatbox-message-item-time">08:30</span>
				</div> -->
            <?php

            $chat_record_url = ROOT . "/fetch/chat_records/" . $chat_id;
            $chat_record_response = file_get_contents($chat_record_url);
            $chat_records = json_decode($chat_record_response, true);

            if ($chat_records) {
                foreach ($chat_records as $chat_record) {
                    if ($chat_record['sent_by'] == $user_id) {
                        echo "<div class='chatbox-message-item sent'>
                <span class='chatbox-message-item-text'>
                    $chat_record[message]
                </span>
                <span class='chatbox-message-item-time'>$chat_record[created_at]</span>
            </div>";
                    } else {
                        echo "<div class='chatbox-message-item received'>
                <span class='chatbox-message-item-text'>
                    $chat_record[message]
                </span>
                <span class='chatbox-message-item-time'>$chat_record[created_at]</span>
            </div>";
                    }
                }
            } else {
                echo "<h4 class='chatbox-message-no-message'>You don't have message yet!</h4>";
            }


            ?>
        </div>
        <div class="chatbox-message-bottom">
            <div id="chatform">



                <div class="chatbox-input">
                    <div><textarea id="chat-input" placeholder="Type a message..."></textarea></div>
                    <div><button id="send-btn" onclick='send()'><span class="material-symbols-outlined">
                                send
                            </span></button></div>
                </div>
            </div>

        </div>

    </div>
    <!-- </div> -->
</div>

<script>
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        console.log('Connection established!');
        conn.send(JSON.stringify({
            'newRoute': 'Personalchat-<?= $chat_id ?>'
        }));

    };

    // let timeoutHandle = window.setTimeout(function() {
    //     document.getElementById('comment-typing-$PostId').innerHTML = '';
    // }, 2000);

    // TOGGLE CHATBOX
    const chatboxToggle = document.querySelector('.chatbox-toggle')
    const chatboxMessage = document.querySelector('.chatbox-message-wrapper')

    chatboxToggle.addEventListener('click', function() {
        chatboxMessage.classList.toggle('show')
    })

    function typing() {
        conn.send(JSON.stringify({
            'typing': 'y',
            'name': '<?= $cus_name ?>'
        }));
    }

    // MESSAGE INPUT
    const textarea = document.getElementById('chat-input')
    // const chatboxForm = document.querySelector('.chatbox-message-form')
    const chatboxForm = document.getElementById('chatform')
    // CHATBOX MESSAGE
    const chatboxMessageWrapper = document.querySelector('.chatbox-message-content')
    const chatboxNoMessage = document.querySelector('.chatbox-message-no-message')

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
            let message = `
                <div class="chatbox-message-item received">
                    <span class="chatbox-message-item-text">
                        ${data.message}
                    </span>
                    <span class="chatbox-message-item-time">${date} ${time}</span>
                </div>
            `
            chatboxMessageWrapper.insertAdjacentHTML('beforeend', message)
            chatboxNoMessage.style.display = 'none'
            scrollBottom()

        } else if (typeof data.typing !== 'undefined') {
            let typing = `
                <div class="chatbox-message-item received">
                    <span class="chatbox-message-item-text">
                        ${data.name} is typing...
                    </span>
                </div>
            `
            chatboxMessageWrapper.insertAdjacentHTML('beforeend', typing)
            chatboxNoMessage.style.display = 'none'
            // scrollBottom()

            // get last message inserted and scroll to it
            var lastMessage = document.querySelector('.chatbox-message-item:last-child');
            lastMessage.scrollIntoView();
            scrollBottom()
        }
    }

    textarea.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            btn.click();
            textarea.value = '';

            //get last message inserted and scroll to it
            var lastMessage = document.querySelector('.chatbox-message-item:last-child');
            lastMessage.scrollIntoView();
            scrollBottom()
        }
    })

    function send() {
        conn.send(JSON.stringify({
            'sent_by': '<?= $cus_name ?>',
            'message': textarea.value,
            'created_at': `${date} ${time}`
        }));



        sendMessage(textarea.value, <?= $chat_id ?>);
        let message = `
            <div class="chatbox-message-item sent">
                <span class="chatbox-message-item-text">
                    ${textarea.value}
                </span>
                <span class="chatbox-message-item-time">${date} ${time}</span>
            </div>
        `
        chatboxMessageWrapper.insertAdjacentHTML('beforeend', message)
        chatboxNoMessage.style.display = 'none'
        chatboxMessageWrapper.scrollTo(0, chatboxMessageWrapper.scrollHeight)
        textarea.value = ''


        // textarea.value = '';



    }

    function sendMessage(mzg, room) {

        let data = {
            connection: room,
            message: mzg,
            sent_by: '<?= $user_id ?>',
            created_at: `${date} ${time}`

        };

        $.ajax({
            url: '<?= ROOT ?>/add/chat_record',
            type: 'POST',
            data: data,
            success: function(response) {
                console.log(response);
            }
        });

    }


    function scrollBottom() {
        chatboxMessageWrapper.scrollTo(0, chatboxMessageWrapper.scrollHeight)
    }
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>