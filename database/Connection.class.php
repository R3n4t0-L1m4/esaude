<?php
require_once('config.php');
class Connection {
  private static $instance;

  public static function getInstance(){
    if(!isset(self::$instance)){
      try{
        self::$instance = new PDO('mysql:host='.HOST.';dbname='.BASE,USER, PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
      }catch(PDOException $e){
        echo $e->getMessage();
      }
    }
    return self::$instance;
  }

  public static function prepare($sql){
    return self::getInstance()->prepare($sql);
  }

  public static function exec($sql){
    return self::getInstance()->exec($sql);
  }

  public static function query($sql){
    return self::getInstance()->query($sql);
  }

  public static function ultimoId(){
    return self::getInstance()->lastInsertId();
  }

  public static function quote($str){
    return self::getInstance()->quote($str);
  }

  public static function beginTransaction(){
    return self::getInstance()->beginTransaction();
  }

  public static function rollBack(){
    return self::getInstance()->rollBack();
  }

  public static function commit(){
    return self::getInstance()->commit();
  }

}







 ?>
