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
show($last_chat_rec_each_connection);






// show($chats);


?>
<?php

foreach ($last_chat_rec_each_connection as $chat_rec) {
    echo "<a href='".ROOT."/osr/inquiries/".$chat_rec['sent_by']."'><div class='chat-record'><p>{$chat_rec['cus_name']}</p><p>{$chat_rec['message']}</p><p>{$chat_rec['created_at']}</p></div></a>";
}

?>


<?php include "inc/footer.view.php"; ?>