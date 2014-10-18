<?php
    class BaseModel {
      private $sql = "";
      public function ExecuteSql() {
      }

      public function prepare($result) {

      }

      protected function setSQL($sql) {
        $this->sql = $sql;
      }

      public function excuteSql($where=null,$params=null) {
        $result=DatabaseHandler::Prepare($this->sql);
        $result=DatabaseHandler::GetRow($result,$params);
        return $result;
      }

      public function excuteUpdate($where=null,$params=null) {
        $sql = $this->sql . "" . $where;
        $result=DatabaseHandler::Prepare($sql);
        $result=DatabaseHandler::GetRow($result,$params);
        return $result;
      }

      public function excuteInsert($tablename=null,$fieldsname=null,$params,$user) {
        $prepareparams = "?";
        for ($i = 1; $i < count($params) + 4; $i++) {
          $prepareparams = $prepareparams . ",?";
        }
        $fieldsname = $fieldsname . ",createdate,modifydate,editedby,cache";
        $today = date('Y-m-d');
        array_push($params,$today,$today,$user->getId(),"0");
        $this->sql = "INSERT INTO `$tablename` ($fieldsname) VALUES ($prepareparams);";
        $result=DatabaseHandler::Prepare($this->sql);
        DatabaseHandler::GetInsert($result,$params);
      }
    }
?>