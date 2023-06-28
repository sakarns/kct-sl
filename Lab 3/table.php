<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}

ini_set('display_errors', 1);
include_once('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once('header.php'); ?>
    <title>CRUD | Table</title>
</head>

<body>
    <!-- Table -->
    <div class="flex justify-center my-36">
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium bg-teal-200 text-gray-500 uppercase tracking-wider">
                                        #
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium bg-teal-200 text-gray-500 uppercase tracking-wider">
                                        Username
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium bg-teal-200 text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium bg-teal-200 text-gray-500 uppercase tracking-wider">
                                        Phone no.
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium bg-teal-200 text-gray-500 uppercase tracking-wider">
                                        Address
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium bg-teal-200 text-gray-500 uppercase tracking-wider">
                                        Edit
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php
                                $sn = 1;
                                $query = "SELECT id, username, email, address, mobile FROM `users` order by id DESC";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_array($result)) {
                                        echo
                                            "<tr>
                                                <td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>" . $sn . "</td> 
                                                <td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>" . $row['username'] . "</td>
                                                <td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>" . $row['email'] . "</td>
                                                <td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>" . $row['mobile'] . "</td>
                                                <td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>" . $row['address'] . "</td>
                                                <td class='px-6 py-4 whitespace-nowrap text-right text-sm font-medium'>                                              
                                                <a class='text-indigo-600 hover:text-indigo-900' href='update_form.php?id=" . $row['id'] . " ' id='btnEditUser_" . $row['id'] . " '>
                                                Edit
                                                </a>
                                                <a class='text-red-600 hover:text-red-900 mx-2' href='delete_user.php?id=" . $row['id'] . "' id='btnDeleteUser'>
                                                Delete
                                                </a>
                                                </td>
                                            </tr>";
                                        $sn++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Table -->
</body>

</html>