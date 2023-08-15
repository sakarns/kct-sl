<?php

// Include the database connection file
require_once 'connection.php';
include_once 'search.php';

// Fetch all records from the people table
$query = "SELECT * FROM people";
$result = mysqli_query($connection, $query);

?>
<!DOCTYPE html>
<html>

<head>
    <title>People DB - Display</title>
    <style>
        /* CSS Styling for the page */
        * {
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            max-height: 100vh;
        }

        .container {
            max-width: 100%;
            max-height: 100%;
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

        .search-bar {
            text-align: right;
            margin-top: 10px;
        }

        .search-bar input[type="search"] {
            padding: 5px;
            border-radius: 5px;
            border: 2px solid black;
        }

        .add {
            margin-left: 100px;
            border-radius: 5px;
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

        div a {
            padding: 5px;
            text-decoration: none;
            border: 2px solid red;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            margin-right: 10px;
        }

        a.edit {
            color: blue;
        }

        a.delete {
            color: red;
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
        <h1>People List</h1>
        <div class="search-bar">
            <input type="search" id="user_search" onclick="searchPeople()" placeholder="Search.....">
            <a href='register.php' class="add">Add New Person</a>
        </div>
        <table id="usertable">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Middle Name</th>
                <th>Address</th>
                <th>Contact</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['people_id']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['mid_name']; ?></td>
                    <td><?php echo $row['last_name']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td><?php echo $row['comment']; ?></td>
                    <td>
                        <a class="edit" href="update.php?id=<?php echo $row['people_id']; ?>">Edit</a>
                        <a class="delete" href="delete.php?id=<?php echo $row['people_id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <footer>
        <p>&copy; 2023 mainali.com. All rights reserved.</p>
    </footer>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        var mainContent = $('#usertable tbody').html(); // Store the main page content

        $('#user_search').keyup(function() {
            var input = $(this).val();
            if (input != "") {
                $.ajax({
                    url: "search.php",
                    method: "POST",
                    data: {
                        input: input
                    },
                    success: function(response) {
                        $('#usertable tbody').html(response);
                    }
                });
            } else {
                // Display the main page content when the input is empty
                $('#usertable tbody').html(mainContent);
            }
        });
    });
</script>

</html>