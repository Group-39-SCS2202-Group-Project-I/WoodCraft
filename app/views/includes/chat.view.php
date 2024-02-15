<link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="<?php echo ROOT; ?>/assets/css/style.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
<style>

    :root {
        --blue: var(--primary);
        --grey: #F5F5F5;
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
        background: var(--white);
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
        background: var(--grey);
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
        background: var(--white);
        border-radius: 0 .75rem .75rem .75rem;
        box-shadow: .25rem .25rem 1.5rem rgba(0, 0, 0, .05);
    }

    .chatbox-message-item-time {
        float: right;
        font-size: .75rem;
        margin-top: .5rem;
        display: inline-block;
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

<div class="chatbox-wrapper">
    <div class="chatbox-toggle">
        <i class='bx bx-message-dots'></i>
    </div>
    <div class="chatbox-message-wrapper">
        <div class="chatbox-message-header">
            <div class="chatbox-message-profile">
                <!-- <img src="https://images.unsplash.com/photo-1570295999919-56ceb5ecca61?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8bWFufGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                        alt="" class="chatbox-message-image"> -->
                <div>
                    <span class="material-symbols-outlined">
                        support_agent
                    </span>
                </div>
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
            <h4 class="chatbox-message-no-message">You don't have message yet!</h4>
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
        </div>
        <div class="chatbox-message-bottom">
            <form action="#" class="chatbox-message-form">
                <textarea rows="1" placeholder="Type message..." class="chatbox-message-input"></textarea>
                <button type="submit" class="chatbox-message-submit"><i class='bx bx-send'></i></button>
            </form>
        </div>
    </div>
</div>

<script>
    // MESSAGE INPUT
    const textarea = document.querySelector('.chatbox-message-input')
    const chatboxForm = document.querySelector('.chatbox-message-form')

    textarea.addEventListener('input', function() {
        let line = textarea.value.split('\n').length

        if (textarea.rows < 6 || line < 6) {
            textarea.rows = line
        }

        if (textarea.rows > 1) {
            chatboxForm.style.alignItems = 'flex-end'
        } else {
            chatboxForm.style.alignItems = 'center'
        }
    })



    // TOGGLE CHATBOX
    const chatboxToggle = document.querySelector('.chatbox-toggle')
    const chatboxMessage = document.querySelector('.chatbox-message-wrapper')

    chatboxToggle.addEventListener('click', function() {
        chatboxMessage.classList.toggle('show')
    })



    // DROPDOWN TOGGLE
    // const dropdownToggle = document.querySelector('.chatbox-message-dropdown-toggle')
    // const dropdownMenu = document.querySelector('.chatbox-message-dropdown-menu')

    // dropdownToggle.addEventListener('click', function() {
    //     dropdownMenu.classList.toggle('show')
    // })

    // document.addEventListener('click', function(e) {
    //     if (!e.target.matches('.chatbox-message-dropdown, .chatbox-message-dropdown *')) {
    //         dropdownMenu.classList.remove('show')
    //     }
    // })


    // CHATBOX MESSAGE
    const chatboxMessageWrapper = document.querySelector('.chatbox-message-content')
    const chatboxNoMessage = document.querySelector('.chatbox-message-no-message')

    chatboxForm.addEventListener('submit', function(e) {
        e.preventDefault()

        if (isValid(textarea.value)) {
            writeMessage()
            setTimeout(autoReply, 1000)
        }
    })


    function addZero(num) {
        return num < 10 ? '0' + num : num
    }

    function writeMessage() {
        const today = new Date()
        let message = `
		<div class="chatbox-message-item sent">
			<span class="chatbox-message-item-text">
				${textarea.value.trim().replace(/\n/g, '<br>\n')}
			</span>
			<span class="chatbox-message-item-time">${addZero(today.getHours())}:${addZero(today.getMinutes())}</span>
		</div>
	`
        chatboxMessageWrapper.insertAdjacentHTML('beforeend', message)
        chatboxForm.style.alignItems = 'center'
        textarea.rows = 1
        textarea.focus()
        textarea.value = ''
        chatboxNoMessage.style.display = 'none'
        scrollBottom()
    }

    function autoReply() {
        const today = new Date()
        let message = `
		<div class="chatbox-message-item received">
			<span class="chatbox-message-item-text">
				Thank you for your awesome support!
			</span>
			<span class="chatbox-message-item-time">${addZero(today.getHours())}:${addZero(today.getMinutes())}</span>
		</div>
	`
        chatboxMessageWrapper.insertAdjacentHTML('beforeend', message)
        scrollBottom()
    }

    function scrollBottom() {
        chatboxMessageWrapper.scrollTo(0, chatboxMessageWrapper.scrollHeight)
    }

    function isValid(value) {
        let text = value.replace(/\n/g, '')
        text = text.replace(/\s/g, '')

        return text.length > 0
    }
</script>