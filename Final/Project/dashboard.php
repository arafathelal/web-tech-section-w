<?php
session_start();

require_once __DIR__ . "/../../controller/DashboardController.php";

$user_name = $_SESSION['user_name'] ?? "Arafat";
$user_id   = $_SESSION['user_id'] ?? 1;  // TEMP user id until login works

$page = "dashboard";
$page_title = "Dashboard - AutoPulse";

// Get all data from controller
$data = getDashboardData($user_id);

$total_vehicles    = $data['stats']['total_vehicles'];
$active_services   = $data['stats']['active_services'];
$parts_orders      = $data['stats']['parts_orders'];
$total_spent       = $data['stats']['total_spent'];
$recent_activities = $data['recent'];

include_once __DIR__ . "/../layout/header.php";
?>

<div class="page-header">
    <div class="welcome-msg">
        <h1>Welcome back, <?= htmlspecialchars($user_name) ?>!</h1>
        <p>Here is an overview of your vehicles and service status.</p>
    </div>
    <button class="btn-main" onclick="location.href='book_home_service.php'">+ New Booking</button>
</div>

<div class="stats-grid">
    <div class="stat-card blue"><div class="stat-info"><span>My Vehicles</span><h3><?= $total_vehicles ?></h3></div><i class="fa-solid fa-car stat-icon"></i></div>
    <div class="stat-card green"><div class="stat-info"><span>Active Services</span><h3><?= $active_services ?></h3></div><i class="fa-solid fa-wrench stat-icon"></i></div>
    <div class="stat-card orange"><div class="stat-info"><span>Parts Orders</span><h3><?= $parts_orders ?></h3></div><i class="fa-solid fa-box-open stat-icon"></i></div>
    <div class="stat-card red"><div class="stat-info"><span>Total Spent</span><h3><?= $total_spent ?></h3></div><i class="fa-solid fa-receipt stat-icon"></i></div>
</div>

<div class="content-area">
    <aside>
        <div class="widget-box">
            <div class="widget-title">Quick Actions</div>
            <button class="action-link" onclick="location.href='add_vehicle.php'"><i class="fa-solid fa-car"></i> Add Vehicle</button>
            <button class="action-link" onclick="location.href='book_home_service.php'"><i class="fa-solid fa-house"></i> Book Home Service</button>
            <button class="action-link" onclick="location.href='book_dropoff_service.php'"><i class="fa-solid fa-shop"></i> Book Drop-off</button>
            <button class="action-link btn-emergency" onclick="location.href='book_emergency.php'"><i class="fa-solid fa-truck"></i> Emergency Tow</button>
            <button class="action-link" onclick="location.href='parts.php'"><i class="fa-solid fa-gear"></i> Buy Parts</button>
        </div>

        <div class="help-widget">
            <div class="help-header"><i class="fa-solid fa-circle-info"></i> Need Help?</div>
            <p class="help-body">Contact support for issues with your bookings or orders.</p>
            <a href="support.php" class="help-link">Visit Support Center →</a>
        </div>
    </aside>

    <main class="activity-panel">
        <div class="panel-head"><h3>Recent Activity</h3><a href="booking_history.php" class="view-all-link">View All</a></div>

        <div class="table-responsive">
            <table>
                <thead><tr><th>Type</th><th>Description</th><th>Date</th><th>Status</th><th>Action</th></tr></thead>
                <tbody>
                <?php if(empty($recent_activities)): ?>
                    <tr><td colspan="5" class="empty-state">No recent activity found.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php include_once __DIR__ . "/../layout/footer.php"; ?>
