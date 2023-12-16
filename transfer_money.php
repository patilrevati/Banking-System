<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sparks_bank";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$from_customer = $_POST['from'] ?? 0;
$to_customer = $_POST['to'] ?? 0;
$amount = $_POST['amount'] ?? 0;

$sql_check_balance = "SELECT balance FROM customers WHERE id = $from_customer";
$result = $conn->query($sql_check_balance);

if ($result) {
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $balance = $row['balance'];

        if ($balance >= $amount) {
            $sql_deduct = "UPDATE customers SET balance = balance - $amount WHERE id = $from_customer";
            $result_deduct = $conn->query($sql_deduct);

            $sql_add = "UPDATE customers SET balance = balance + $amount WHERE id = $to_customer";
            $result_add = $conn->query($sql_add);

            $sql_record_transaction = "INSERT INTO transactions (from_customer_name, to_customer_name, amount) VALUES ($from_customer, $to_customer, $amount)";
            $result_transaction = $conn->query($sql_record_transaction);

            if ($result_deduct && $result_add && $result_transaction) {
                echo "Transaction successfull redirecting...!";
                header("refresh:3;url=index.html");
            } else {
                echo "Error updating accounts or recording transaction.";
            }
        } else {
            echo "Insufficient balance in the sender's account.";
        }
    } else {
        echo "No customer found with ID: $from_customer";
    }
} else {
    echo "Error fetching balance information: " . $conn->error;
}

$conn->close();
?>
