<?php

require_once "config.php";

function emoticonate($texts){
    $emot = get_all_emoticons();
    foreach($emot as $emo){
        // htmlentities will convert any & into &amp; without contaminate the real url.
        $texts = str_replace($emo['emo_tag'],
            '<img src="' . htmlentities($emo['emo_location']) . '" class="emo">',
            $texts);
    }
    return $texts;
}

function get_all_emoticons() {
    global $db;
    $sql_statement = $db->prepare("SELECT emo_tag, emo_location FROM emoticons WHERE is_active = ?");
    $is_active = 1;
    $sql_statement->bind_param("i", $is_active);
    $sql_statement->execute();
    $result = $sql_statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $sql_statement->close();
    return $result;
}

function get_all_comments() {
    global $db;
    $sql_statement = $db->prepare("SELECT * FROM comments WHERE is_active = ?");
    $is_active = 1;
    $sql_statement->bind_param("i", $is_active);
    $sql_statement->execute();
    $result = $sql_statement->get_result()->fetch_all(MYSQLI_ASSOC);
    $sql_statement->close();
    return $result;
}


/**
 * For inserting things, always use the prepared statement
 * to prevent the SQL Injection.
 * 
 * Learn more: https://en.wikipedia.org/wiki/SQL_injection
 */


function insert_emoticon($emo_tag, $emo_location) {
    global $db;
    $sql_statement = $db->prepare("INSERT INTO emoticons(emo_tag, emo_location, is_active) VALUES(?, ?, ?)");
    $is_active = 1;
    $sql_statement->bind_param("ssi", $emo_tag, $emo_location, $is_active);
    $result = $sql_statement->execute();
    $sql_statement->close();
    return $result;
}

function insert_comment($display_name, $email, $comment, $time = NULL) {
    global $db;
    if(!$time) {
        $time = time();
    }
    $sql_statement = $db->prepare("INSERT INTO comments(display_name, email, comments, is_active, created_date) VALUES(?, ?, ?, ?, ?)");
    $is_active = 1;
    $timestamp = date("Y-m-d H:i:s", $time);
    $sql_statement->bind_param("sssis", $display_name, $email, $comment, $is_active, $timestamp);
    $result = $sql_statement->execute();
    $sql_statement->close();
    return $result;
}