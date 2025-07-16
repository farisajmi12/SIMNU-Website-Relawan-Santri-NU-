<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>
        <?= $title;  ?>
    </title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #8B0000; /* Warna latar belakang merah gelap */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .container {
        max-width: 800px;
        display: flex;
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.3);
    }

    .left-panel {
        background-color: #8B0000;
        color: white;
        width: 50%; /* Pastikan panel kiri memenuhi setengah dari container */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 20px;
        text-align: center;
    }

    .left-panel h1 {
        font-size: 22px;
        font-weight: bold;
    }

    .left-panel p {
        color: white;
    }

    .right-panel {
        width: 50%; /* Seimbang dengan panel kiri */
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .right-panel h2 {
        color: #8B0000;
        font-size: 22px;
        font-weight: bold;
    }

    .right-panel p {
        color: #333;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ccc;
        color: black;
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
        background-color: #8B0000;
        color: white;
        border: none;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #B22222;
    }

    .text-center a {
        display: block;
        margin-top: 10px;
        color: #8B0000;
        text-decoration: none;
        font-weight: bold;
    }

    .text-center a:hover {
        text-decoration: underline;
    }
</style>
</head>

<body>
