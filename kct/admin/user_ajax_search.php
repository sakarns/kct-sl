<?php
include_once __DIR__. '/../config/connection.php';
if(isset($_POST['input'])){
    $searchVal = $_POST['input'];

    $query = "SELECT * FROM `users` WHERE username 
            LIKE '".$searchVal."%'";

    $result = mysqli_query($conn,$query);

    if(mysqli_num_rows($result) > 0){
        
     $sn=1;    
            while($row = mysqli_fetch_array($result)){
                $username = $row['username'];
                $email = $row['email'];
                $isActive = $row['is_active'];
?>

                <tr>
                    <td>
                        <?php echo $sn;?>
                    </td>
                    <td>
                        <?php echo $username;?>
                    </td>
                    <td>
                        <?php echo $email;?>
                    </td>                    
                </tr>
<?php
        $sn ++;
            }
            
    }
}
?>