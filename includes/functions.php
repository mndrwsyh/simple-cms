<?php 

//connect to database
function connectToDB() {
    //connet to dtabase
//1. databoace size
$host = "127.0.0.1";
$database_name = "CMS";
$database_user = "root";
$database_password = "";

//2. coone tphp with the database
//pdo - php database object
$database = new PDO(
    "mysql:host=$host;dbname=$database_name", 
    $database_user, 
    $database_password
);

return $database;
}

//get user data by email
function getUserByEmail( $email ) {

    $database = connectToDB();
    //5. get the user data by email
    //5.1 SQL
    $sql = "SELECT * FROM users WHERE email = :email";
    //5.2 prepare
    $query = $database->prepare( $sql );
    //5.3 execute
    $query->execute ([
        "email" => $email
    ]);
    //5.4 fetch
    $user = $query->fetch();
    
return $user;
}

//check if user is logedn in
function isUserLoggedIn() {
    return isset( $_SESSION["user"]);
}