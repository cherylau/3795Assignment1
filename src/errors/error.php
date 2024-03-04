<?php include_once '../../inc_header.php'; ?>

<div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="text-center">
        <h1 class="display-1 ">Oops!</h1>
        <p class="lead">
            <?php
            $errorMessage = "We can't seem to find the page you're looking for.";

            if (isset($_GET['type'])) {
                switch ($_GET['type']) {
                    case 'admin_only':
                        $errorMessage = "This area is reserved for administrators only.";
                        break;
                    case 'unauthorized_access':
                        $errorMessage = "You're not authorized to view this page.";
                        break;
                    case 'invalid_credentials':
                        $errorMessage = "Invalid login credentials provided.";
                        break;
                    case 'pending_approval':
                        $errorMessage = "Your account is pending approval by an administrator.";
                        break;
                    case 'not_found':
                    default:
                        $errorMessage = "We can't seem to find the page you're looking for.";
                        break;
                }
            }

            echo $errorMessage;
            ?>
        </p>
        <a href="/" class="btn btn-primary">Go to Homepage</a>
    </div>
</div>

<?php include_once '../../inc_footer.php'; ?>
