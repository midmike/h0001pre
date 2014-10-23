<?php
    require_once("controls_feature.php");
    require_once("../models/BaseModel.php");
    require_once("../models/User.php");
    $callfunction = key($_GET);

    UserControl::$callfunction();


    //create class for control
    class UserControl {
        public Static function login() {
          $user = new User();
          if (isset($_POST["username"]) && !empty($_POST["username"])) {
            $user->setUsername($_POST["username"]);
            //echo $user->getUserName();
          }
          if (isset($_POST["password"]) && !empty($_POST["password"])) {
            $user->setPassword($_POST["password"]);
            //echo $user->getPassword();
          }
          if ($user->isExist()) {
            header("Location:../");
          } else {
            //header("Location:../?fail");
          }
          die();
        }
        public Static function Logout() {
        }
        public Static function Create() {
          $user = new User();
          if (isset($_POST["username"]) && !empty($_POST["username"])) {
            $user->setUsername($_POST["username"]);
          }
          if (isset($_POST["password"]) && !empty($_POST["password"])) {
            $user->setPassword($_POST["password"]);
          }
          if (isset($_POST["name"]) && !empty($_POST["name"])) {
            $user->setName($_POST["name"]);
          }
          if (isset($_POST["status"]) && !empty($_POST["status"])) {
            $user->setStatus($_POST["status"]);
          }
          if (isset($_POST["address"]) && !empty($_POST["address"])) {
            $user->setAddress($_POST["address"]);
          }
          if (isset($_POST["phone"]) && !empty($_POST["phone"])) {
            $user->setPhone($_POST["phone"]);
          }
          $user->insertDatabase();
          header("Location:../");
        }
    }

?>