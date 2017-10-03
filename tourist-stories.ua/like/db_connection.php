<?php
    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWORD", "");
    define("DB_NAME", "test_db");
    $db_connect = mysql_connect(HOST, USER, PASSWORD, TRUE); 
    mysql_selectdb(DB_NAME,$db_connect);
    mysql_set_charset('utf8');
?>