<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');


$host = 'localhost';
$user = 'root';
$password = 'root';
$db_name = 'anecdot.com';

$link = mysqli_connect($host, $user, $password, $db_name);
mysqli_query($link, "SET NAMES 'utf8'");

function addNewAnecdot($link) {

    if(isset($_GET['added'])) {
        $id = $_GET['added'];
        $query = "SELECT * FROM checking WHERE id='$id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
        $anecdot = mysqli_fetch_assoc($result);
    
        $text = $anecdot['text'];
        $date = $anecdot['date'];
        $subject_id = $anecdot['subject_id'];
    
        $query = "INSERT INTO anecdot SET text='$text', subject_id='$subject_id', date='$date'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
    
        $query = "DELETE FROM checking WHERE id='$id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
    
        echo '<p>Запись добавленна в поток!</p>';
    }
}

function deleteAnecdot($link) {
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query = "DELETE FROM checking WHERE id='$id'";
        $result = mysqli_query($link, $query) or die(mysqli_error($link));
    
        echo '<p>Анекдот удален!!!</p>';
    }
}




include 'elems/loyaut.php';