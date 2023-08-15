<?php

// Include the database connection file
require_once 'connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $midName = $_POST['mid_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $comment = $_POST['comment'];

    // Prepare the insert query
    $query = "INSERT INTO people (first_name, last_name, mid_name, address, contact, comment) VALUES ('$firstName', '$lastName', '$midName', '$address', '$contact', '$comment')";

    // Execute the insert query
    if (mysqli_query($connection, $query)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);

?>

<!DOCTYPE html>
<html>

<head>
    <title>People DB - Register</title>
    <style>
        /* CSS Styling for the page */
        * {
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            max-height: 100%;
        }

        .container {
            max-width: 100%;
            max-height: 100%;
            text-align: center;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        nav {
            background-color: #333;
            padding: 10px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }

        nav ul li {
            display: inline-block;
        }

        nav ul li a {
            display: block;
            padding: 10px 20px;
            text-decoration: none;
            color: #fff;
        }

        nav ul li a:hover {
            background-color: #ddd;
        }

        .content {
            flex: 1;
            padding: 20px;
            margin-top: 50px;
            /* Adjust the margin as needed */
            margin-bottom: 50px;
            /* Adjust the margin as needed */
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        input[type="text"],
        textarea {
            width: 300px;
            padding: 5px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            padding: 10px;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <h1>mainali.com</h1>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Services</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <h1>Register New Person</h1>
        <form action="register.php" method="POST">
            <label for="first_name">First Name:</label><br>
            <input type="text" name="first_name" required><br>
            <label for="last_name">Last Name:</label><br>
            <input type="text" name="last_name" required><br>
            <label for="mid_name">Middle Name:</label><br>
            <input type="text" name="mid_name" required><br>
            <label for="address">Address:</label><br>
            <input type="text" name="address" required><br>
            <label for="contact">Contact:</label><br>
            <input type="text" name="contact" required><br>
            <label for="comment">Comment:</label><br>
            <textarea name="comment" rows="4" required></textarea><br>
            <input type="submit" value="Register">
        </form>
    </div>
    <footer>
        <p>&copy; 2023 mainali.com. All rights reserved.</p>
    </footer>
</body>

</html>