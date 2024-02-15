<!-- Connect to the database and display the contents of the buckets and transactions tables. -->
<?php
require 'Database.php';

$db = Database::getConnection();

$bucketsQuery = $db->query("SELECT * FROM buckets");
$buckets = [];
while ($row = $bucketsQuery->fetchArray(SQLITE3_ASSOC)) {
    $buckets[] = $row;
}
$transactionsQuery = $db->query("SELECT * FROM transactions");
$transactions = [];
while ($row = $transactionsQuery->fetchArray(SQLITE3_ASSOC)) {
    $transactions[] = $row;
}
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Database Display</title>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js" integrity="sha384-oesi62hOLfzrys4LpLZRJWXQdnrsMsvTFq2mC0KciP8F4LKVT5uHjHtqEe2PjF0o" crossorigin="anonymous"></script>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h2>Buckets Table</h2>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Category</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($buckets as $bucket) : ?>
                <tr>
                    <td><?= htmlspecialchars($bucket['transaction_id']) ?></td>
                    <td><?= htmlspecialchars($bucket['category']) ?></td>
                    <td><?= htmlspecialchars($bucket['description']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Transactions Table</h2>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Bucket ID</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) : ?>
                <tr>
                    <td><?= htmlspecialchars($transaction['transaction_id']) ?></td>
                    <td><?= htmlspecialchars($transaction['date']) ?></td>
                    <td><?= htmlspecialchars($transaction['amount']) ?></td>
                    <td><?= htmlspecialchars($transaction['bucket_id']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


</body>

</html>