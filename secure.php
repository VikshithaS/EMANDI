<?php
session_start();

if (!isset($_SESSION['chef_username'])) {
    header("Location: login.html");
    exit();
}
