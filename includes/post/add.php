<?php

    // TODO: 1. connect to database
    $database = connectToDB();

    // TODO: 2. get all the data from the form using $_POST
    

    $title = $_POST["post-title"];
    $content = $_POST["post-content"];

    
    if (empty($title) || empty($content) ) {
        $_SESSION["error"] = "You cannot post without any content.";
        header("Location: /posts-add");
        exit;
    } else {
            $sql = "INSERT INTO posts (`title`, `content`, `user_id`) VALUES (:title, :content, :user_id)";
            $query = $database->prepare($sql);
            $query -> execute([ 
                "title" => $title,
                "content" => $content,
                "user_id" => $_SESSION["user"]["id"]
            ]);
            //step 4 display success message aka garnish
            $_SESSION["success"] = "Your post has been posted!";
        // TODO: 5. Redirect back to the /manage-users page
        
        header("Location: /posts");
        exit;
        }
    
   

    



    // TODO: 4. create the user account. You need to assign the role to the user
    /*
        role options:
        - user
        - editor
        - admin

*/ 
?>


