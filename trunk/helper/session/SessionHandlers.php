<?php
    class SessionHandlers {
        public static function checkSession() {
          if (session_status() == PHP_SESSION_NONE) {

            session_start();
            session_regenerate_id(true);
            //echo "Session start<br>";
            return true;
          }
          //echo "Session already start<br>";
          return false;
        }
        public static function destroyAllSession() {
          $_SESSION = array();
          session_unset();
          session_destroy();
          //echo "run destroy all session<br>";
        }
        public static function destroySession($sessionName) {
          unset($_SESSION[$sessionName]);
          //echo "run destroy session by name<br>";
        }
    }
?>