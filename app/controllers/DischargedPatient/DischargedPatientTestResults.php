<?php

if (!(isset($_SESSION))) {
    session_start();
    if ((!(isset($_SESSION["username"]))) || ($_SESSION["type"] != "Doctor")) {
        header("Location: ../../../restricted/index");
        return;
    }
}
