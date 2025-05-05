<?php
//start the session
session_start();

require "includes/functions.php";

/* 
decide what page to load depending on the url the user visit
localhost:9000/ -> home.php
localhost:9000/login -> login.php
localhost:9000/signup -> signup.php
localhost:9000/logout -> logout.php

action routes :
localhost:900/auth/login -> includes/auth/do_login.php
localhost:900/auth/signup -> includes/auth/signup.php
localhost:900/task/add -> includes/task/add.php
localhost:900/task/complete -> includes/task/compelted.php
localhost:900/task/delete -> includes/task/del.php

*/

//global variable = $_
//figure out what path the user is visiting
$path = $_SERVER["REQUEST_URI"];

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
  
  default:
  require "pages/home.php";
    break;
}
