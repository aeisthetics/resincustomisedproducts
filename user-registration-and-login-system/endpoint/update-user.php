<?php
include ('../conn/conn.php');

$updateUserID = $_POST['tbl_user_id'];
$updatename = $_POST['name'];
$updateEmail = $_POST['email'];
$updatePassword = $_POST['password'];

try {
    $stmt = $conn->prepare("SELECT `name` FROM `tbl_user` WHERE `name` = :name");
    $stmt->execute([
        'name' => $updatename,
    ]);
    $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($nameExist)) {
        $conn->beginTransaction();

        $updateStmt = $conn->prepare("UPDATE `tbl_user` SET `name` = :name,`email` = :email, `password` = :password WHERE `tbl_user_id` = :userID");
        $updateStmt->bindParam(':name', $updatename, PDO::PARAM_STR);
        $updateStmt->bindParam(':email', $updateemail, PDO::PARAM_STR);
        $updateStmt->bindParam(':password', $updatePassword, PDO::PARAM_STR);
        $updateStmt->bindParam(':userID', $updateUserID, PDO::PARAM_INT);
        $updateStmt->execute();

        echo "
        <script>
            alert('Updated Successfully');
            window.location.href = 'http://localhost/user-registration-and-login-system/home.php';
        </script>
        ";

        $conn->commit();
    } else {
        echo "
        <script>
            alert('User Already Exist');
            window.location.href = 'http://localhost/user-registration-and-login-system/index.html';
        </script>
        ";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}



?>

