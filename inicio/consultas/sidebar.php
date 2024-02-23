<?php
session_start();
$_SESSION['sidebar'] = $_SESSION['sidebar'] == 0 ? 1 : 0;
echo $_SESSION['sidebar'];
