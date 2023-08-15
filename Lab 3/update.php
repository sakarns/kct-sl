<?php

// Include the database connection file
require_once 'connection.php';

// Check if the ID parameter is provided
if (!isset($_GET['id'])) {
    echo "ID parameter is missing.";
    exit();
}

$personId = $_GET['id'];

// Fetch the record for the given ID
$query = "SELECT * FROM people WHERE people_id = $personId";
$result = mysqli_query($connection, $query);

$row = mysqli_fetch_assoc($result);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $middleName = $_POST['mid_name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $comment = $_POST['comment'];

    // Update the record in the database
    $query = "UPDATE people SET first_name = '$firstName', last_name = '$lastName', mid_name = '$middleName', address = '$address', contact = '$contact', comment = '$comment' WHERE people_id = $personId";
    $updateResult = mysqli_query($connection, $query);

    if ($updateResult) {
        header('location:index.php');
    } else {
        echo "Error updating record: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);


?>

<!DOCTYPE html>
<html>

<head>
    <title>People DB - Update</title>
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
        <h1>Update Person</h1>
        <form action="update.php?id=<?php echo $personId; ?>" method="POST">
            <label for="first_name">First Name:</label><br>
            <input type="text" name="first_name" value="<?php echo $row['first_name']; ?>" required><br>
            <label for="last_name">Last Name:</label><br>
            <input type="text" name="last_name" value="<?php echo $row['last_name']; ?>" required><br>
            <label for="mid_name">Middle Name:</label><br>
            <input type="text" name="mid_name" value="<?php echo $row['mid_name']; ?>" required><br>
            <label for="address">Address:</label><br>
            <input type="text" name="address" value="<?php echo $row['address']; ?>" required><br>
            <label for="contact">Contact:</label><br>
            <input type="text" name="contact" value="<?php echo $row['contact']; ?>" required><br>
            <label for="comment">Comment:</label><br>
            <textarea name="comment" rows="4" required><?php echo $row['comment']; ?></textarea><br>
            <input type="submit" value="Update">
        </form>
    </div>
    <footer>
        <p>&copy; 2023 mainali.com. All rights reserved.</p>
    </footer>
</body>

</html>