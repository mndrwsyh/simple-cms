<?php 

$database = connectToDB();

$name = $_POST["name"];
$email = $_POST["email"];
$password = $_POST["password"];
$confirm_password = $_POST["confirm_password"];

if (
    empty($name) ||
    empty($email) ||
    empty($password) ||
    empty($confirm_password)
) {
    $_SESSION["error"] = "All the fields are required";
        // redirect back to signup page
        header("Location: /signup");
        exit;
} else if ( $password !== $confirm_password) {
    $_SESSION["error"] = "Your password is not matched";
        // redirect back to signup page
        header("Location: /signup");
        exit;
} else {
    //panggil function yg check if email dah ada lom
    $user = getUserByEmail( $email ); 

    //5.1 SQL command
    //kat sini baru dia signup kan user YES
    //check is user exists or not
    if ( $user ) {
        $_SESSION["error"] = "The email provided already exists in our system";
            // redirect back to signup page
            header("Location: /signup");
            exit;
    } else {
    $sql = "INSERT INTO users (`name`, `email`, `password`) VALUES (:name, :email, :password)";
    //5.2 prepare
    $query = $database->prepare( $sql );
    //5.3 execute
    $query->execute([
        "name" => $name,
        "email" => $email,
        "password" => password_hash( $password, PASSWORD_DEFAULT )
    ]);
    

    // set success message
    $_SESSION["success"] = "Account created succesfully! Please login with your email and password";

    //6. redirect to login.php
    header("Location: /login");
    exit;
}

}
