<?php include "inc/header.view.php"; ?>
<?php
// echo "Inquiries"

$url = ROOT . "/fetch/chat";
$response = file_get_contents($url);
$chats = json_decode($response, true);
// show($chats);

$url2 = ROOT . "/fetch/chat_rec_all";
$response2 = file_get_contents($url2);
$chat_records = json_decode($response2, true);

$rev_chat_records = array_reverse($chat_records);
// show($rev_chat_records);

$unique_connections = array();
foreach ($rev_chat_records as $chat_record) {
    $unique_connections[$chat_record['connection']] = $chat_record['connection'];
}
// show($unique_connections);

$last_chat_rec_each_connection = array();
foreach ($unique_connections as $unique_connection) {
    foreach ($rev_chat_records as $rev_chat_record) {
        if ($rev_chat_record['connection'] == $unique_connection) {
            $last_chat_rec_each_connection[$unique_connection] = $rev_chat_record;
            break;
        }
    }
}
// show($last_chat_rec_each_connection);

// if customer_user_id in chats == sent_by in last_chat_rec_each_connection add cus_name from chats to last_chat_rec_each_connection
foreach ($chats as $chat) {
    foreach ($last_chat_rec_each_connection as $key => $value) {
        if ($chat['customer_user_id'] == $value['sent_by']) {
            $last_chat_rec_each_connection[$key]['cus_name'] = $chat['cus_name'];
        }
    }
}


// foreach ($last_chat_rec_each_connection as $chat_rec) {
//     echo "<a href='".ROOT."/osr/inquiries/".$chat_rec['sent_by']."'><div class='chat-record'><p>{$chat_rec['cus_name']}</p><p>{$chat_rec['message']}</p><p>{$chat_rec['created_at']}</p></div></a>";
// }

?>
<div class="table-section">
    <h2 class="table-section__title">inquiries</h2>
    <div id="chat-records">


    </div>
</div>

<script>
    function UpdateLastChatRecord() {
        fetch('<?php echo ROOT ?>/fetch/chat_rec_all')
            .then(response => response.json())
            .then(data => {
                // console.log(data);
                let chat_records = data;
                let rev_chat_records = chat_records.reverse();
                let unique_connections = [];
                rev_chat_records.forEach(chat_record => {
                    unique_connections[chat_record.connection] = chat_record.connection;
                });
                let last_chat_rec_each_connection = [];
                for (let unique_connection in unique_connections) {
                    for (let i = 0; i < rev_chat_records.length; i++) {
                        if (rev_chat_records[i].connection == unique_connection) {
                            last_chat_rec_each_connection[unique_connection] = rev_chat_records[i];
                            break;
                        }
                    }
                }
                // console.log(last_chat_rec_each_connection);
                fetch('<?php echo ROOT ?>/fetch/chat')
                    .then(response => response.json())
                    .then(data => {
                        let chats = data;
                        for (let chat in chats) {
                            for (let key in last_chat_rec_each_connection) {
                                if (chats[chat].customer_user_id == last_chat_rec_each_connection[key].sent_by) {
                                    // last_chat_rec_each_connection[key].cus_name = chats[chat].cus_name;
                                    if (chats[chat].cus_name) {
                                        last_chat_rec_each_connection[key].cus_name = chats[chat].cus_name;
                                    } else {
                                        last_chat_rec_each_connection[key].cus_name = 'OSR';
                                    }
                                }
                            }
                        }
                        // console.log(last_chat_rec_each_connection);
                        let chat_records_div = document.getElementById('chat-records');

                        chat_records_div.innerHTML = '';

                        // console.log(last_chat_rec_each_connection);
                        for (let chat_rec in last_chat_rec_each_connection) {
                            let chat_record = last_chat_rec_each_connection[chat_rec];
                            // console.log(chat_record.connection);
                            let chat_id = chat_record.connection;
                            //fetch chat records by chat_id
                            let customer_id;
                            let customer_name;
                            fetch('<?php echo ROOT ?>/fetch/chat/' + chat_id)
                                .then(response => response.json())
                                .then(data => {
                                    customer_id = data.customer_user_id;
                                    customer_name = data.cus_name;
                                    // console.log(customer_id);
                                    // console.log(customer_name);

                                    // console.log(customer_id);
                                    // console.log(customer_name);

                                    let chat_record_div = document.createElement('div');
                                    chat_record_div.classList.add('chat-record');
                                    chat_record_div.innerHTML = `<a href='<?php echo ROOT ?>/osr/inquiries/${customer_id}'><p>${customer_name}</p><p>${chat_record.message}</p><p>${chat_record.created_at}</p></a>`;
                                    chat_records_div.appendChild(chat_record_div);


                                })
                                .catch(error => console.error(error));


                        }
                    })
                    .catch(error => console.error(error));
            })
            .catch(error => console.error(error));
    }

    document.addEventListener('DOMContentLoaded', function() {
        UpdateLastChatRecord();
        setInterval(UpdateLastChatRecord, 1000);
    });

    // document.addEventListener('DOMContentLoaded', function() {
    //     updateChatRecords();
    //     setInterval(updateChatRecords, 1000);
    // });
</script>



<?php include "inc/footer.view.php"; ?>