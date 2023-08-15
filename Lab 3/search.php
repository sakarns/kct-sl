<?php
include_once 'connection.php';
if (isset($_POST['input'])) {
    $searchVal = $_POST['input'];

    if (!empty($searchVal)) {
        $query = "SELECT * FROM `people` WHERE first_name LIKE '%" . $searchVal . "%' OR CONCAT(first_name, ' ', mid_name, ' ', last_name) LIKE '%" . $searchVal . "%' OR address LIKE '%" . $searchVal . "%'";
        $result = mysqli_query($connection, $query);

        if (mysqli_num_rows($result) > 0) {
            $sn = 1;
?>

            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Contact</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_array($result)) {
                $firstname = $row['first_name'];
                $midname = $row['mid_name'];
                $lastname = $row['last_name'];
                $address = $row['address'];
                $contact = $row['contact'];
            ?>

                <tr>
                    <td><?php echo $sn; ?></td>
                    <td><?php echo $firstname . ' ' . $midname . ' ' . $lastname; ?></td>
                    <td><?php echo $address; ?></td>
                    <td><?php echo $contact; ?></td>
                </tr>
<?php
                $sn++;
            }
        }
    }
}
?>