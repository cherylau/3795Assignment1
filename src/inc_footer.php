</br>
</br>
</div>
<footer class="footer mt-auto py-3 bg-light fixed-bottom">
    <div class="container">
        <div class="d-flex justify-content-end">
            <?php
            if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                echo '<a href="' . htmlspecialchars($_SERVER['HTTP_REFERER']) . '" class="btn btn-light me-3">Back</a>';
            }
            ?>
            <a href="../actions/login/logout.php" class="btn btn-dark">Logout</a>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/js/bootstrap.min.js"></script>

</body>
</html>
