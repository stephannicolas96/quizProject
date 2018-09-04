<?php

if (isset($_GET['logout'])) {
    unset($_GET['logout']);
    session_unset();
}