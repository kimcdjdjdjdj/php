<?php

require_once '../../../includes/session.php';

start_session();
try_to_logout();
if (isset($_GET['logout'])){
    destroy_session();
    header("Location:../../../index.php");
} else if (isset($_GET['post'])){
    $post_id = $_SESSION['post_id'];
    destroy_session();
    header("Location: view_db_post_fk.php?post_id=$post_id");
} else if (isset($_SESSION['board_id'])) {
    $board_id = $_SESSION['board_id'];
    destroy_session();
    header("Location: index_db_fk.php?board_id=$board_id");
} else {
    destroy_session();
    header('Location: board_number.php');
}