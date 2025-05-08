<?php
//start the session
session_start();

require "includes/functions.php";
//global variable = $_
//figure out what path the user is visiting
$path = $_SERVER["REQUEST_URI"];
//remove all query string from url
$path = parse_url( $path, PHP_URL_PATH);

//once u figure out the path, then need to load the relevant content based on the path

//fir switch, sequence?? doesnt matter, for else if semau tu matter
switch ($path) {
  //pages routes
  case '/login':
    require "pages/login.php";
    break;
  case '/signup':
    require "pages/signup.php";
    break;
  case '/logout':
    require "pages/logout.php";
    break;
  case '/post':
    require "pages/post.php";
    break;
  case '/dashboard':
    require "pages/dashboard.php";
    break;
  case '/posts-add':
    require "pages/manage-posts-add.php";
    break;
  case '/posts-edit':
    require "pages/manage-posts-edit.php";
    break;
  case '/posts':
    require "pages/manage-posts.php";
    break;
  case '/users-add':
    require "pages/manage-users-add.php";
    break;
  case '/users-edit':
    require "pages/manage-users-edit.php";
    break;
  case '/users-changepwd':
    require "pages/manage-users-changepwd.php";
    break;
  case '/users':
    require "pages/manage-users.php";
    break;


    //action routes
  case '/auth/login':
    require "includes/auth/do_login.php";
    break;
  case '/auth/signup':
    require "includes/auth/do_signup.php";
    break;
    //setup action route for add user
    // TODO: setup the action route for add user
    case '/user/add':
      require "includes/user/add.php";
      break;
    //setup action route for delete user
    case '/user/delete':
      require "includes/user/delete.php";
      break;
      case '/user/update':
        require "includes/user/update.php";
        break;

  default:
  require "pages/home.php";
    break;
}
