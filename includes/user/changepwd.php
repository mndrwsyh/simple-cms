<?php

    // 1. connect to database

    $database = connectToDB();

    // 2. get the user_id from the form

    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $id = $_POST["id"];
    
    // 3. check for error

    if (empty($password) || empty($confirm_password)) {
        $_SESSION["error"] = "Please fill up all fields";
        header("Location: /users-changepwd?id=" . $id);
        exit;
    } else if ( $password !== $confirm_password ) {
        $_SESSION["error"] = "Password does not match";
        header("Location: /users-changepwd?id=" . $id);
        exit;
    }

    //4. update pass for the user

    $sql = "UPDATE users SET password = :password WHERE id=:id";
    $query = $database->prepare( $sql );
    $query->execute([
        "password" => password_hash( $password, PASSWORD_DEFAULT ),
        "id" => $id
    ]);

    // 5. redirect to manage users
    $_SESSION["success"] = "User password has been updated.";
    header("Location: /users"); 
    exit;
?>