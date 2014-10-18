<?php
    class DatabaseHandler{
      private static $_mHandler;
      private function __construct(){}
      private static function GetHandler(){
        if(!isset(self::$_mHandler))
        {
          try{
            self::$_mHandler=new PDO(PDO_DSN,DB_USERNAME,DB_PASSWORD,array(PDO::ATTR_PERSISTENT=>DB_PERSISTENCY));
            self::$_mHandler->exec("set names utf8");
            self::$_mHandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e){
            self::Close();
            echo "Class DatabaseHandler.GetHandler: ".$e->getMessage();
          }
        }
        return self::$_mHandler;
      }
      public static function Close(){
        self::$_mHandler=null;
      }
      public static function Prepare($queryString){
        try{
          $database_handler=self::GetHandler();
          $statement_handler=$database_handler->prepare($queryString);
          return $statement_handler;
        }catch(PDOException $e){
          self::Close();
          echo "Class DatabaseHandler.Prepare: ".$e->getMessage();
        }
      }
      public static function Execute($statementHandler,$params=null){
        try{
          $statementHandler->execute($params);
        }catch(PDOException $e){
          self::Close();
          echo "Class DatabaseHandler.Execute: ".$e->getMessage();
        }
      }
      //fast but more memory
      public static function GetAll($statementHandler,$params=null,$fetchStyle=PDO::FETCH_ASSOC)
      { $result=null;
        try{
          self::Execute($statementHandler,$params);
          $result=$statementHandler->fetchAll($fetchStyle);
        }catch(PDOException $e){
          self::Close();
          echo "Class DatabaseHandler.GetAll: ".$e->getMessage();
        }
        return $result;
      }
      //slow but less memory
      public static function GetRow($statementHandler,$params=null,$fetchStyle=PDO::FETCH_ASSOC)
      { $result=null;
        try{
          self::Execute($statementHandler,$params);
          $result=$statementHandler->fetch($fetchStyle);
        }catch(PDOException $e){
          self::Close();
          echo "Class DatabaseHandler.GetRow: ".$e->getMessage();
        }
        return $result;
      }
      public static function GetOne($statementHandler,$params=null)
      {
        $result=null;
        try{
          self::Execute($statementHandler,$params);
          $result=$statementHandler->fetch(PDO::FETCH_NUM);
          $result=$reult[0];
        }catch(PDOException $e){
          self::Close();
          echo "Class DatabaseHandler.GetOne: ".$e->getMessage();
        }
        return $result;
      }
      public static function GetInsert($statementHandler,$params=null,$fetchStyle=PDO::FETCH_ASSOC)
      { $result=null;
        try{
          self::Execute($statementHandler,$params);
        }catch(PDOException $e){
          self::Close();
          echo "Class DatabaseHandler.GetInsert: ".$e->getMessage();
        }
      }
    }
?>