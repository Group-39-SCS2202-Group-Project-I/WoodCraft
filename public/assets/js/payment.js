function paymentGateway() {
    event.preventDefault();
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = () => {
        if(xhttp.readyState == 4 && xhttp.status == 200){
            alert(xhttp.responseText);

            var res = xhttp.responseText;
            var obj = JSON.parse(xhttp.responseText);

            var mail = obj["mail"];
            var amount = obj["amount"];
        

        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
            // Send a request to the server to handle the completion
            var paymentCompletedXhttp = new XMLHttpRequest();

            paymentCompletedXhttp.onreadystatechange = function () {
                if (paymentCompletedXhttp.readyState == 4 && paymentCompletedXhttp.status == 200) {
                    console.log("Payment completed. OrderID:" + orderId);
                    // Redirect to the invoice page
                    window.location = "invoice.php";
                }
            };

            paymentCompletedXhttp.open("GET", "paymentUpdate.php?orderId=" + orderId, true);
            paymentCompletedXhttp.send();
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
            // Note: Prompt user to pay again or show an error page
            //add a payment unsuccessful popup and retry button
            console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
            // Note: show an error page
            console.log("Error:"  + error);
        };

        // Put the payment variables here
        var payment = {
            "sandbox": true,
            "merchant_id": obj["merchant_id"],    // Replace your Merchant ID
            "return_url": "http://localhost/cart-and-checkout-php-mysql/cart.php",     // Important
            "cancel_url": "http://localhost/cart-and-checkout-php-mysql/checkout.php",     // Important
            "notify_url": "http://localhost/cart-and-checkout-php-mysql/notify.php",    // check this
            "order_id": obj["order_id"],
            "items": "Door bell wireles",
            "amount": obj["amount"],
            "currency": obj["currency"],
            "hash": obj["hash"], // *Replace with generated hash retrieved from backend
            "first_name": "Saman",
            "last_name": "Perera",
            "email": "samanp@gmail.com",
            "phone": "0771234567",
            "address": "No.1, Galle Road",
            "city": "Colombo",
            "country": "Sri Lanka",
            "delivery_address": "No. 46, Galle road, Kalutara South",
            "delivery_city": "Kalutara",
            "delivery_country": "Sri Lanka",
            "custom_1": "",
            "custom_2": ""
        };

        payhere.startPayment(payment);
        }
    }

    xhttp.open("GET", "payhereProcess.php", true);
    xhttp.send();
}