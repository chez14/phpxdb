<?php
    /**
     * It's important to filter the inputs.
     */
    $post = array_intersect_key(
        $_POST,
        array_flip([
            'name',
            'email',
            'comment'
        ])
    );

    if(
        !isset($post['name']) ||
        !isset($post['email']) ||
        !isset($post['comment']) ){
            die("Name, email, and comment are required fields.");
    }

    //done checking, now add it into our database!
    require "inc/app.php";

    if(insert_comment($post['name'], $post['email'], $post['comment'])) {
        header('Location: index.php');
    } else {
        die('Failed to insert to the DB.');
    }
