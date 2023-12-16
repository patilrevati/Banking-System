<?php
function connectToDatabase() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sparks_bank";

    try {
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            throw new Exception("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
}

function getCustomers() {
    $conn = connectToDatabase();
    $sql = "SELECT * FROM customers";
    $result = $conn->query($sql);

    $customers = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $customers[] = $row;
        }
    }

    $conn->close();
    return $customers;
}

$customers = getCustomers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>View All Customers</title>
</head>
<body>
    <div class="container">
        <h1>View All Customers</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Balance</th>
            </tr>

            <?php
            foreach ($customers as $customer) {
                echo "<tr>";
                echo "<td>" . $customer["id"] . "</td>";
                echo "<td>" . $customer["name"] . "</td>";
                echo "<td>" . $customer["email"] . "</td>";
                echo "<td>" . $customer["balance"] . "</td>";
                echo "</tr>";
            }

            if (empty($customers)) {
                echo "<tr><td colspan='4'>No customers found</td></tr>";
            }
            ?>

        </table>
        <br>
        <button onclick="location.href='transfer_money.html'">Send Money</button>
        <button onclick="location.href='transactions.php'">See all Transactions</button>
        <button onclick="location.href='index.html'">Back to Home</button>
    </div>
</body>
</html>
