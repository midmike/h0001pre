<?php
  //Session_Handler::destroySession();
  Session_Handler::checkSession();
  $user = new User();
  //$user->setUserName("d");
  //$user->setPassword("asdf");
  $d=$user->readAllDatabase();
  $result = $user->readDatabase('where username=? and password=?',array('asdf','asdf'));
  print_r($result);
  echo key($_GET);


  echo $user->isExist();
  print_r($user);
  echo $user::isLogin();
  print_r($user);
  /*
  if ($user->isExist()) {
    echo "login";
  } else {
    echo "no user!";
  } */
?>