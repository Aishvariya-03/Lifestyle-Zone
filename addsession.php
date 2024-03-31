<?php
    // Connect to your MySQL database (replace placeholders with actual values)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "life";

    $conn = new mysqli($servername, $username, $password, $dbname);
    session_start();
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sess_name = $_POST['sess_name'];
        $start_sess = $_POST['start_sess'];
        $end_sess = $_POST['end_sess'];
        $des = $_POST['des'];
        $url = $_POST['url'];

        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO session (sess_name, start_sess, end_sess, des, url) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $sess_name, $start_sess, $end_sess, $des, $url);

        // Execute the statement
        if ($stmt->execute()) {
            echo "New session added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Session</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        #add-session-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        /* Form styles */
        form {
            width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<section id="header">
    <h2>Add New Session</h2>
</section>

<section id="add-session-form">
    <form action="addsession.php" method="post">
        <label for="sess_name">Session Name:</label><br>
        <input type="text" id="sess_name" name="sess_name" required><br>

        <label for="start_sess">Start Time:</label><br>
        <input type="time" id="start_sess" name="start_sess" required><br>

        <label for="end_sess">End Time:</label><br>
        <input type="time" id="end_sess" name="end_sess" required><br>

        <label for="des">Description:</label><br>
        <textarea id="des" name="des" rows="4" required></textarea><br>

        <label for="url">URL:</label><br>
        <input type="text" id="url" name="url" required><br>

        <input type="submit" value="Add Session">
    </form>
</section>

</body>
</html>
