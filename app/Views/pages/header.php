<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> | Tasks Management System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            color: #222;
        }

        nav {
            background: #1f2937;
            padding: 16px 40px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin-right: 25px;
        }

        nav a:hover {
            color: #93c5fd;
        }

        main {
            max-width: 1000px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 24px;
            margin-bottom: 16px;
            border-radius: 8px;
            box-shadow: 0 2px 8px #00000012;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #e5e7eb;
        }

        .pending {
            color: #b45309;
            font-weight: bold;
        }

        .completed {
            color: #15803d;
            font-weight: bold;
        }

        .empty {
            padding: 20px;
            background: white;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<nav>
    <a href="<?= site_url('/') ?>">Welcome</a>
    <a href="<?= site_url('tasks') ?>">Task List</a>
    <a href="<?= site_url('profile') ?>">Profile</a>
    <a href="<?= site_url('about') ?>">About</a>
</nav>

<main>
