<?php

    // 1. connect to database

    $database = connectToDB();

    // 2. get the user_id from the form

    $title = $_POST["post-title"];
    $content = $_POST["post-content"];
    $status = $_POST["post-status"];
    $id = $_POST["id"];
    
    // 3. delete the user

    if (empty($title) || empty($content) || empty($status)) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /posts-edit?id=" . $id);
        exit;
    }

    $sql = "UPDATE posts SET title = :title, content = :content, status = :status WHERE id=:id";
    $query = $database->prepare( $sql );
    $query->execute([
        "title" => $title,
        "content" => $content,
        "status" => $status,
        "id" => $id
    ]);

    // 4. redirect to manage users
    $_SESSION["success"] = "Post has been updated.";
    header("Location: /posts"); 
    exit;
?>