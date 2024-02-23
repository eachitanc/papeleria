<?php
session_start();
include 'Conexion.php';
$con = new Conexion();
if (!isset($_SESSION['id_user'])) {
    header('Location: ' . $con->urlin . '/index.php');
    exit;
}
require 'autoload.php';
?>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Papelería</title>
    <!-- MDB icon -->
    <link rel="stylesheet" href="<?php echo $con->urlin ?>/css/mdb.min.css?v=<?php echo date('YmdHis') ?>" />
    <link rel="icon" href="<?php echo $con->urlin ?>/img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <link rel="stylesheet" href="<?php echo $con->urlin ?>/css/style.css?v=<?php echo date('YmdHis') ?>" />
    <link rel="stylesheet" href="<?php echo $con->urlin ?>/css/jquery.dataTables.min.css?v=<?php echo date('YmdHis') ?>" />
    <link rel="stylesheet" href="<?php echo $con->urlin ?>/css/button.min.css" />
    <?php
    if ($_SESSION['sidebar'] == '0') {
    ?>
        <style>
            :root {
                --vh-adjust: 118px;
                --hide-time-sidebar: width 0s;
                --hide-time-content: width 0s;
            }
        </style>
    <?php
    } else {
    ?>
        <style>
            :root {
                --vh-adjust: 118px;
                --hide-time-sidebar: all 0.3s ease-in-out;
                --hide-time-content: margin-left 0.3s ease-in-out;
            }
        </style>

    <?php
    }
    ?>
    <style>
        body {
            background-color: #fbfbfb;
        }

        @media (min-width: 991.98px) {
            main {
                padding-left: 240px;
            }
        }

        @media (max-width: 991.98px) {
            .sidebar {
                width: 100%;
            }
        }

        .sidebar .active {
            border-radius: 5px;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
        }

        .sidebar-sticky {
            position: relative;
            top: 0;
            height: calc(100vh - 48px);
            padding-top: 0.5rem;
            overflow-x: hidden;
            overflow-y: auto;
            /* Scrollable contents if viewport is shorter than content. */
        }

        #sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 240px;
            height: 100vh;
            color: #fff;
            transition: var(--hide-time-sidebar);
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            z-index: 600;
        }

        #sidebar.active {
            left: 0;
        }

        #content {
            transition: var(--hide-time-content);
        }

        .content-container-100 {
            flex-grow: 1;
            height: 100vh;
        }

        #content.active {
            margin-left: 250px;
        }

        .vh-full {
            min-height: calc(100vh - var(--vh-adjust));
        }

        .text-light:hover {
            color: black !important;
        }

        .color-base {
            background-color: #D1F2EB4d !important;
        }

        #contenido {
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
        }

        .shadow {
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
        }

        .opcionesUser {
            position: fixed;
            top: 4px;
            right: 20px;
            z-index: 1000;
        }

        .profile {
            width: 45px;
            height: 45px;
            overflow: hidden;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
            /*hacer que se vea mas grande */

        }

        .profile img {
            width: 100%;
            height: 100%;
            transition: transform 0.3s;
            box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
        }

        .profile:hover {
            background-color: #f0f0f0;
            transform: scale(1.1);
            transition: transform 0.2s;
        }

        .enfocar:hover {
            transform: scale(1.03) !important;
            transition: transform 0.1s !important;
            background-color: #2e73a630;
        }
    </style>
</head>