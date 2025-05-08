<?php

    // 1. connect to database

    $database = connectToDB();

    // 2. get the user_id from the form

    $name = $_POST["name"];
    $role = $_POST["role"];
    $id = $_POST["id"];
    
    // 3. delete the user

    if ( empty($name) || empty($role) || empty($id) ) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /users-edit?id=" . $id);
        exit;
    }

    $sql = "UPDATE users SET name = :name, role = :role WHERE id=:id";
    $query = $database->prepare( $sql );
    $query->execute([
        "name" => $name,
        "role" => $role,
        "id" => $id
    ]);

    // 4. redirect to manage users
    $_SESSION["success"] = "User has been updated.";
    header("Location: /users"); 
    exit;
?>