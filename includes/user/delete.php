<?php

    // 1. connect to database

    $database = connectToDB();

    // 2. get the user_id from the form

    $user_id = $_POST["user_id"];
    
    // 3. delete the user

    if(empty($user_id)) {
        header("Location: /users");
        exit;
    }

    $sql = "DELETE FROM users WHERE id = :id";
    $query = $database->prepare( $sql );
    $query->execute([
        "id" => $user_id
    ]);

    // 4. redirect to manage users
    header("Location: /users"); 
    exit;
?>