<?php
include "../../inc_header.php";
?>

<h2>Register</h2>
<?php if (isset($_GET['message'])): ?>
    <div class="alert alert-info">
        <?= htmlspecialchars(urldecode($_GET['message'])); ?>
    </div>
<?php endif; ?>

<form action="register_process.php" method="post">
    <div class="form-group">
        <label for="email">Email address:</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Register</button>
</form>

<?php
include('../../inc_footer.php');
?>