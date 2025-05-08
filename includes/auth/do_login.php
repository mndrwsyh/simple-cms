<?php 

$database = connectToDB();

//3. get all the data from the login page
$email = $_POST["email"];
$password = $_POST["password"];

//4. check for errer (make sure all the field are filled )
if (
    empty($email) ||
    empty($password) 
) {
    $_SESSION["error"] = "All fields are required";
    // redirect back to login page
    header("Location: /login");
    exit;
} else {
    $user = getUserByEmail( $email ); 

    //check if the user exist or not
    if ( $user ){
        //6. check if password correct or not
        if ( password_verify( $password, $user["password"] ) ) {
            //7. store the user data in the session storage to login the user
            $_SESSION["user"] = $user;

            //8. set success message
            $_SESSION["success"] = "Welcome back, ". $user["name"] . "!";

            //9. redirect user back to index php
            header("Location:/dashboard");
            exit;
        } else {
            $_SESSION["error"] = "The password provided is incorrect";
        
            // redirect back to login page
            header("Location: /login");
            exit;
        }
    } else {
        $_SESSION["error"] = "The email provided does not exist";

        // redirect back to login page
        header("Location: /login");
        exit;
    }

}
