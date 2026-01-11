<?php
if (!isset($page_title)) $page_title = "AutoPulse";
if (!isset($user_name)) $user_name = "Guest";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($page_title) ?></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/layout.css">
<link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/<?= $page ?>.css">






</head>
<body>

<nav class="navbar">
    <div class="brand"><i class="fa-solid fa-car-side"></i> AutoPulse</div>

    <div class="menu-toggle" id="mobile-menu"><i class="fa-solid fa-bars"></i></div>

    <ul class="nav-links" id="nav-list">
        <li><a href="dashboard.php" class="<?= $page=='dashboard'?'active':'' ?>">Dashboard</a></li>
        <li><a href="vehicles.php" class="<?= $page=='vehicles'?'active':'' ?>">My Vehicles</a></li>
        <li><a href="booking_history.php" class="<?= $page=='bookings'?'active':'' ?>">Bookings</a></li>
        <li><a href="parts.php" class="<?= $page=='parts'?'active':'' ?>">Parts Store</a></li>
        <li><a href="profile.php" class="<?= $page=='profile'?'active':'' ?>">Profile</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>

    <div class="user-section">
        <div class="profile-icon"><i class="fa-solid fa-user"></i></div>
    </div>
</nav>

<div class="container"><!-- PAGE CONTENT START -->
