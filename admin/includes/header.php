<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../styles/main.css">
    <link rel="stylesheet" href="../../assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/bootstrap/bootstrap.rtl.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="@sweetalert2/theme-dark/dark.css">

    <style type="text/tailwindcss">
        .my-container {
            @apply bg-mainColor text-white p-4;
        }
        .nav-btn {
            @apply w-full  py-2 px-4 rounded-sm ;
        }
        .nav-btn-active {
            @apply text-white bg-thirdColor;
        }
        .title-text {
            @apply text-2xl font-semibold;
        }
        .main-color {
            @apply text-red-600;
        }
        .form-group {
            @apply flex flex-col gap-2
        }
        .input {
            @apply bg-mainColor  text-white border rounded-md focus:outline-none border-thirdColor px-4 py-2;
        }
        .btn-danger {
            @apply bg-redColor border-none text-white hover:bg-redColor hover:text-white;
        }
        .btn-success {
            @apply bg-greenColor border-none text-white hover:bg-greenColor hover:text-white;
        }
        .alert-success {
            @apply bg-greenColor border-none text-white hover:bg-greenColor hover:text-white;
        }
        .btn-warning {
            @apply bg-yellowColor border-none text-white hover:bg-yellowColor hover:text-white;
        }
        .btn-primary {
            @apply bg-blueColor border-none text-white hover:bg-blueColor hover:text-white;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        mainColor: '#0B1437',
                        secondColor: '#111C44',
                        thirdColor: '#7551FF',
                        yellowColor: '#FFB547',
                        blueColor: '#3965FF',
                        greenColor: '#01B574',
                        redColor: '#EE5D50',
                    }
                }
            }
        }
    </script>
</head>

<body>

    <?php include "sidebar.php" ?>