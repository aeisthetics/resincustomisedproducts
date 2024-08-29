<?php
include ('../conn/conn.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];


try {
    $stmt = $conn->prepare("SELECT `name`,  FROM `tbl_user` WHERE `name` = :name");
    $stmt->execute([
        'name' => $name,
    ]);
    $nameExist = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($nameExist)) {
        $conn->beginTransaction();

        $insertStmt = $conn->prepare("INSERT INTO `tbl_user` (`name`,`email`, `password`) VALUES (NULL, :name, :email, :password)");
        $insertStmt->bindParam(':name', $name, PDO::PARAM_STR);
        $insertStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $insertStmt->bindParam(':password', $password, PDO::PARAM_STR);
        $insertStmt->execute();


        echo "
        <script>
            alert('Registered Successfully');
            window.location.href = 'http://localhost/user-registration-and-login-system/index.html';
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