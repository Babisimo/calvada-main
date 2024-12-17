<?php
// Database connection details
$servername = "localhost";
$username = "contact_form_db";
$password = "MariContact_US@DB2023";
$dbname = "contact_form_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the contacts table, including the service field
$sql = "SELECT id, name, email, phone, service, message, timestamp FROM contacts ORDER BY timestamp DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact Submissions</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">

    <!-- jQuery first, then DataTables and Buttons JS in the correct order -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <link rel="icon" href="/images/logos/favicon.ico" type="/image/x-icon" />
    <style>
        /* General styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #365e32;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .content-wrapper {
            flex: 1;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #f1f1f1;
            margin-top: 60px;
            font-size: 28px;
            font-weight: 600;
        }

        /* DataTable styling */
        #contactTable_wrapper {
            width: 90%;
            margin: 0 auto;
        }

        #contactTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #182b16;
            color: white;
            font-weight: bold;
        }

        td {
            background-color: #e9f5e9;
        }

        .sorting_1 {
            background-color: #C9DAC7 !important;
            color: #4b8446;
        }

        #contactTable tbody tr:nth-child(even) {
            background-color: #f7faf7;
        }

        #contactTable tbody tr:hover {
            background-color: #cfe6cf;
            cursor: pointer;
        }

        .dataTables_filter input {
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 6px 12px;
            margin: 4px;
            border-radius: 4px;
            background-color: #365e32;
            color: white;
            border: none;
            cursor: pointer;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #4b8446;
        }

        .dataTables_wrapper .dataTables_length select {
            padding: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Styling for Export Button */
        .dt-buttons {
            display: inline-block !important;
            margin-bottom: 10px;
        }

        /* Button styling */
        .dt-buttons .buttons-html5 {
            background-color: #365e32;
            /* Dark green background */
            color: #ffffff;
            /* White text color */
            border: 1px solid #4b8446;
            /* Border matches theme */
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: bold;
            transition: background-color 0.3s;
            margin-right: 5px;
            cursor: pointer;
        }

        /* Hover effect for Export Button */
        .dt-buttons .buttons-html5:hover {
            background-color: #4b8446;
            /* Lighter green on hover */
            color: #ffffff;
        }
    </style>
</head>

<body>
    <?php include 'header.html'; ?>

    <div class="content-wrapper">
        <h1>Contact Form Submissions</h1>
        <div id="contactTable_wrapper">
            <table id="contactTable" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Service</th>
                        <th>Message</th>
                        <th>Timestamp</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["service"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["message"]) . "</td>";
                            echo "<td>" . htmlspecialchars($row["timestamp"]) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No submissions found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include 'footer.html'; ?>

    <script>
        $(document).ready(function () {
            $('#contactTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "order": [[6, "desc"]],
                "dom": 'Bfrtip', // "B" for buttons
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        text: 'Export to Excel',
                        title: 'Contact_Submissions',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });
        });
    </script>
</body>

</html>

<?php
$conn->close();
?>