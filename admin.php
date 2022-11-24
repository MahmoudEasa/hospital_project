<?php

    include "header.php";

?>

<table>
    <th>الرقم</th>
    <th>إسم المريض</th>
    <th>البريد الإلكتروني</th>
    <th>التاريخ</th>
    <th></th>

<?php

    $host               = "localhost";
    $user               = "root";
    $password           = "";
    $dbName             = "hospital";

    $conn = mysqli_connect($host, $user, $password,$dbName);

    // إستيراد معلومات المرضى من قاعدة البيانات

    $query = "SELECT * FROM patients";
    $result = mysqli_query($conn,$query);
    
    if(isset($_GET["delete"])){
        $queryDelete = "delete from patients where id='{$_GET['id']}'";
        $deleted = mysqli_query($conn, $queryDelete);

        if($deleted) {
            header("Location: admin.php");
        }else {
            echo "<p style='color:red'>" . "عفواً حدث خطأ ما .. حاول مجدد " . "</p>";
        }
    }

    if ($result){
        while($row = mysqli_fetch_assoc($result)){
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . md5($row['email']) . "</td>
                    <td>" . $row['date'] . "</td>
                    <td>
                        <a href='admin.php?delete=true&id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
        }
        echo "</table>";
    }
    else{
        echo "يوجد خطا ما";
    }


?>