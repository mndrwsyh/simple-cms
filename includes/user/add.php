<?php

    // TODO: 1. connect to database
    $database = connectToDB();

    // TODO: 2. get all the data from the form using $_POST
    

    $name = $_POST["name"];
    $email =  $_POST["email"];
    $password =  $_POST["password"]; 
    $confirm_password =  $_POST["confirm_password"]; 
    $role = $_POST["role"]; 

    
    /*
        TODO: 3. error checking
        - make sure all the fields are not empty 
        - make sure the password is match
        - make sure the email provided does not exist in the system
    */
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password) || empty($role)) {
        $_SESSION["error"] = "All fields are required";
        header("Location: /users-add");
        exit;
    } else if ($password !== $confirm_password) {
        $_SESSION["error"] = "Password does not match";
        header("Location: /users-add");
        exit;
    } else { 
        if ( $user ) {
            $_SESSION["error"] = "The email provided already exists in our system";
                // redirect back to add page
                header("Location: /users-add");
                exit;
        } else {
            //step 1 recipe
            $sql = "INSERT INTO users (`name`, `email`, `password`, `role`) VALUES (:name, :email, :password, :role)";
            //step 2 prepare
            $query = $database->prepare($sql);
            //step 3 let them cook
            $query->execute([ // add more
                "email" => $email,
                "name" => $name,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "role" => $role
            ]);
            //step 4 display success message aka garnish
            $_SESSION["success"] = "User password has been updated.";
        // TODO: 5. Redirect back to the /manage-users page
        
        header("Location: /users");
        exit;
        }

    }
   

    



    // TODO: 4. create the user account. You need to assign the role to the user
    /*
        role options:
        - user
        - editor
        - admin

*/ 
?>


