<?php
require_once '../../src/classes/User.php';
require_once '../../src/classes/Database.php';
require_once '../../src/classes/Admin.php';
require_once '../../inc_header.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: /src/errors/error.php?type=admin_only');
    exit;
}
$message = ''; 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['approve_user_id'])) {
    $userIdToApprove = $_POST['approve_user_id'];
    if (Admin::approveUser($userIdToApprove)) {
        $message = "<div class='alert alert-success'>User has been successfully approved.</div>";
    } else {
        $message = "<div class='alert alert-danger'>There was an error approving the user.</div>";
    }
}

$pendingUsers = User::fetchAllPendingApproval();
?>

<h2>Pending User Approvals</h2>

<?php echo $message; ?>

<?php if (!empty($pendingUsers)): ?>
<table class="table">
    <thead>
        <tr>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($pendingUsers as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['email']); ?></td>
            <td>
                <form action="admin.php" method="post">
                    <input type="hidden" name="approve_user_id" value="<?= $user['id']; ?>">
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php else: ?>
    <div class="alert alert-info">There are no pending users for approval.</div>
<?php endif; ?>
