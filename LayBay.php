<?php
// Connection to the database
$connection = mysqli_connect('localhost', 'root', '', 'test');

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['rowId'])) {
    $id = $_GET['rowId'];
    $delete = mysqli_query($connection, "DELETE FROM `registration` WHERE `rowId` = $id");
}

$select = "SELECT * FROM registration";
$query = mysqli_query($connection, $select);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="LayB.css">
    <title>LayBays</title>
</head>
<body>
    <header>
        <nav>
            <div class="logo-container">
                <div class="logo">
                    <img src="image/a8e5ecdcec54441b9ab0d33727971cfb.png" alt="Your Logo">
                </div>
                <h1 id="layBays"></h1>
            </div>
            <div class="search-container">
                <label for="searchId"></label>
                <input type="text" id="searchId" placeholder="Search by ID">
                <button onclick="searchById()">Search</button>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="Make.html">Make LayBay</a></li>
                <li><a href="LayBay.php">Lay-Bays</a></li>
            </ul>
        </nav>
    </header>
    <table>
        <tr>
            <th>firstName</th>
            <th>lastName</th>
            <th>ID</th>
            <th>Telephone</th>
            <th>Price</th>
            <th>deposit</th>
            <th>BayArea</th>
            <th>laybayDate</th>
            <th>expireDates</th>
            <th>rowId</th>
        </tr>
        <?php
        $num = mysqli_num_rows($query);
        if ($num > 0) {
            while ($result = mysqli_fetch_assoc($query)) {
                echo "
                <tr data-rowId='" . $result['rowId'] . "' oncontextmenu='deleteRow(event, " . $result['rowId'] . "); return false;'>
                    <td>" . $result['firstName'] . "</td>
                    <td>" . $result['lastName'] . "</td>
                    <td>" . $result['id'] . "</td>
                    <td>" . $result['tel'] . "</td>
                    <td>" . $result['price'] . "</td>
                    <td>" . $result['deposit'] . "</td>
                    <td>" . $result['bayArea'] . "</td>
                    <td>" . $result['laybayDate'] . "</td>
                    <td>" . $result['expireDates'] . "</td>
                    <td>" . $result['rowId'] . "</td>
                </tr>
                ";
            }
        }
        ?>
    </table>

    <!-- Custom modal for deleting rows -->
    <div class="custom-modal" id="customModal" style="display: none;">
        <input type="password" id="adminPasswordInput" placeholder="Enter admin password">
        <button id="confirmButton">Confirm</button>
    </div>

    <script>
        function deleteRow(event, rowId) {
            event.preventDefault();

            // Display the custom modal
            const modal = document.getElementById("customModal");
            modal.style.display = "block";

            const confirmButton = document.getElementById("confirmButton");
            const adminPasswordInput = document.getElementById("adminPasswordInput");

            confirmButton.addEventListener('click', () => {
                const enteredPassword = adminPasswordInput.value;
                if (enteredPassword === '13169') {
                    // Authorized, proceed with deletion
                    window.location.href = 'LayBay.php?rowId=' + rowId;
                } else {
                    alert("Incorrect admin password. You are not authorized to remove this LayBay.");
                }

                // Hide the modal after use
                modal.style.display = "none";
            });
        }

        function searchById() {
            const searchId = document.getElementById("searchId").value.trim();
            const tableBody = document.querySelector("table tbody");

            if (tableBody) {
                const rows = tableBody.querySelectorAll("tr");

                rows.forEach(row => {
                    const idCell = row.querySelector("td:nth-child(3)");

                    if (idCell) {
                        const idCellValue = idCell.textContent.trim();

                        if (idCellValue === searchId) {
                            row.classList.add("highlight");
                        } else {
                            row.classList.remove("highlight");
                        }
                    }
                });
            }
        }
    </script>
</body>
</html>
