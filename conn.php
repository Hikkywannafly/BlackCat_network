<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'nguyenchitam123');
define('DB_NAME', 'blackcat_network');
//connect to the database
function connect()
{
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME) or die('could not connect to database');
    header("Content-type: text/html; charset=utf-8");
    mysqli_set_charset($conn, 'UTF8');
    return $conn;
}
function disconnect($conn)
{
    mysqli_close($conn);
}

function insert($table, $data)
{
    $conn = connect();
    $field_list = ''; //ten truong
    $value_list = ''; //data cua moi truong
    foreach ($data as $key => $value) {
        $field_list .= ",$key";
        $value_list .= ",'" . $conn->real_escape_string($value) . "'"; //real_escape_string: chống sql injection loai bo cac ky tu dac biet
    }
    $query = 'INSERT INTO ' . $table . '(' . trim($field_list, ',') . ') VALUES (' . trim($value_list, ',') . ')';
    $result = $conn->query($query);
    disconnect($conn);
    return $result;
}


function get_list($sql)
{
    $conn = connect();

    $result = mysqli_query($conn, $sql);

    if (!$result) die('[Database class - get_list] Truy vấn sai');

    $return = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $return[] = $row;
    }

    mysqli_free_result($result);
    disconnect($conn);
    return $return;
}
// dem so tai
function count_records()
{
    $conn = connect();
    $query = 'select count(id) as total from user';
    $result = mysqli_query($conn, $query);
    if (!$result) die('Truy vấn sai');
    $row = mysqli_fetch_assoc($result);
    $total_records = $row['total'];
    disconnect($conn);
    return $total_records;
}

function get_count($sql)
{
    $conn = connect();

    $result = mysqli_query($conn, $sql);
    if (!$result) die('[Database class - get_count] Truy vấn sai');

    $result = mysqli_fetch_array($result)['count(*)'];
    return $result;
}

function update($sql){
    $conn = connect();
    $result = mysqli_query($conn, $sql);
    if (!$result) die('[Database class - update] Truy vấn sai');
}
