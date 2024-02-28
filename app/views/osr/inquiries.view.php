<?php include "inc/header.view.php"; ?>

<style>
    #chat-records {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .chat_record {
        width: 100%;
        margin: 10px 0;
        padding: 10px;
        /* border: 1px solid #ccc; */
        border-radius: 10px;
        text-decoration: none;
        /* color: black; */
        color : var(--blk);
    }

    .chat_record__info {
        display: flex;
        justify-content: space-between;
    }

    .chat_record__info__name {
        /* font-weight: bold; */
        font-weight: 500;
        /* color: var(--blk); */
        /* font-size: 1rem; */
    }

    .chat_record__info__time {
        color: var(--light);
        font-size: 0.7rem;
    }

    .chat_record__message {
        margin-top: 10px;
        display: flex;
        flex-direction: row;
    }

    .unresponded {
        background-color: var(--secondary);
    }

    .responded {
        background-color: var(--primary);
    }

    .responded:hover {
        background-color: var(--blk);
        color: var(--light);
    }

    .unresponded:hover {
        background-color: var(--blk);
        color: var(--light);
    }

    
    .sp
    {
        background-color: var(--light);
        color:var(--blk);
        padding: 5px;
        border-radius: 10px;
    }
    .chat_record__message p {
        margin: 0;
        padding: 5px 0;
    }

   
</style>


<div class="table-section">
    <h2 class="table-section__title">inquiries</h2>
    <div id="chat-records">
        <!-- <a href="#" class="chat_record unresponded">
            <div class="chat_record__info">
                <div class="chat_record__info__name">Ahmed</div>
                <div class="chat_record__info__time">2020-12-12</div>
            </div>
            <div class="chat_record__message">
                <span class="material-symbols-outlined">
                    person
                </span>
                <p>&nbsp; :&nbsp; </p>
                <p>Hi, I want to know more about your products</p>
            </div>
        </a>
        <a href="#" class="chat_record responded">
            <div class="chat_record__info">
                <div class="chat_record__info__name">Ahmed</div>
                <div class="chat_record__info__time">2020-12-12</div>
            </div>
            <div class="chat_record__message">
                <span class="material-symbols-outlined">
                    support_agent
                </span>
                <p>&nbsp; :&nbsp; </p>
                <p>sure</p>
            </div>
        </a>
    </div> -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let url = "<?= ROOT . '/fetch/inquiry_list' ?>";
                let chat_records = document.getElementById('chat-records');

                function updateInq() {

                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            data.forEach(record => {
                                let chat_record = document.createElement('a');
                                chat_record.href = "<?= ROOT . '/osr/inquiries/' ?>" + record.customer_user_id;
                                chat_record.classList.add('chat_record');
                                if (record.resp == 0) {
                                    chat_record.classList.add('unresponded');
                                } else {
                                    chat_record.classList.add('responded');
                                }
                                let chat_record_info = document.createElement('div');
                                chat_record_info.classList.add('chat_record__info');
                                let chat_record_info_name = document.createElement('div');
                                chat_record_info_name.classList.add('chat_record__info__name');
                                chat_record_info_name.textContent = record.cus_name;
                                let chat_record_info_time = document.createElement('div');
                                chat_record_info_time.classList.add('chat_record__info__time');
                                chat_record_info_time.textContent = record.created_at;
                                chat_record_info.appendChild(chat_record_info_name);
                                chat_record_info.appendChild(chat_record_info_time);
                                chat_record.appendChild(chat_record_info);
                                let chat_record_message = document.createElement('div');
                                chat_record_message.classList.add('chat_record__message');
                                let chat_record_message_icon = document.createElement('span');
                                chat_record_message_icon.classList.add('sp');
                                chat_record_message_icon.classList.add('material-symbols-outlined');
                                if(record.resp == 0)
                                {
                                    chat_record_message_icon.textContent = "person";
                                }
                                else
                                {
                                    chat_record_message_icon.textContent = "support_agent";
                                }
                                // chat_record_message_icon.textContent = "person";
                                let chat_record_message_p1 = document.createElement('p');
                                chat_record_message_p1.innerHTML = `&nbsp; :&nbsp; `;
                                let chat_record_message_p2 = document.createElement('p');
                                chat_record_message_p2.textContent = record.message;
                                chat_record_message_p1.classList.add('chat_record__message');
                                chat_record_message_p2.classList.add('chat_record__message');
                                chat_record_message.appendChild(chat_record_message_icon);
                                chat_record_message.appendChild(chat_record_message_p1);
                                chat_record_message.appendChild(chat_record_message_p2);
                                chat_record.appendChild(chat_record_message);
                                chat_records.appendChild(chat_record);
                            });
                        });
                }

                updateInq();

                // setInterval(() => {
                //     let chat_records = document.getElementById('chat-records');
                //     chat_records.innerHTML = "";
                //     updateInq();
                // }, 1000);

                let url2 = "<?= ROOT . '/fetch/last_chat_record_id' ?>";
                let last_chat_record_id = 0;

                setInterval(() => {
                    fetch(url2)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            if (data != last_chat_record_id) {

                                last_chat_record_id = data;
                                let chat_records = document.getElementById('chat-records');
                                chat_records.innerHTML = "";
                                updateInq();
                            }
                        });
                }, 1000);


            });
        </script>
    </div>






    <?php include "inc/footer.view.php"; ?>