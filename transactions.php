<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sparks_bank";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM transactions";
$result = $conn->query($sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Banking System - All Transactions</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="container">
        <h1>All Transactions</h1>
        <?php
        if ($result && $result->num_rows > 0) {
            echo '<table>
                    <tr>
                        <th>Transaction ID</th>
                        <th>From Customer</th>
                        <th>To Customer</th>
                        <th>Amount</th>
                    </tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>
                        <td>' . $row['transaction_id'] . '</td>
                        <td>' . $row['from_customer_name'] . '</td>
                        <td>' . $row['to_customer_name'] . '</td>
                        <td>' . $row['amount'] . '</td>
                    </tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No transactions available.</p>';
        }
        ?>
        <br>
        <button onclick="location.href='index.html'">Back to Home</button>
    </div>
</body>
</html>
