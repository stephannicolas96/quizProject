<?php

session_start();

if (!isset($_SESSION['id']))
    header('Location: Error404');

session_write_close();

