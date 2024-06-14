<?php
class ToDo {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo = null;
  private $stmt = null;
  public $error = "";
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    if ($this->stmt!==null) { $this->stmt = null; }
    if ($this->pdo!==null) { $this->pdo = null; }
  }

  // (C) HELPER - RUN SQL QUERY
  function query ($sql, $data=null) : void {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }

  // (D) SAVE TO-DO TASK
  function save ($name, $type, $id=null) {
    if ($id===null) {
      $sql = "INSERT INTO `media` (`media_title`, `media_type`) VALUES (?,?)";
      $data = [$name, $type];
    } else {
      $sql = "UPDATE `media` SET `media_title`=?, `media_type`=? WHERE `todo_id`=?";
      $data = [$name, $type, $id];
    }
    $this->query($sql, $data);
    return true;
  }

  // (E) GET ALL TASKS
  function getAll () {
    $this->query("SELECT * FROM `media`");
    return $this->stmt->fetchAll();
  }

  // (F) DELETE TASK
  function del ($id) {
    $this->query("DELETE FROM `media` WHERE `media_id`=?", [$id]);
    return true;
  }
}

// (G) DATABASE SETTINGS - CHANGE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (H) NEW TO-DO OBJECT
$TODO = new ToDo();