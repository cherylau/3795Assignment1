<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit;
}
?>

<?php include($_SERVER['DOCUMENT_ROOT'] . "/inc_header.php");?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/inc_db.php"); ?>


<?php
$dataPoints = [];

$sql = "SELECT buckets.category as category, COUNT(transactions.transaction_id) as count";
$sql .= " FROM transactions INNER JOIN buckets ON transactions.bucket_id = buckets.id";
$sql .= " GROUP BY buckets.category";

$res = $db->query($sql);

while ($row = $res->fetchArray()) {
  $arrayItem = array("label" => $row['category'], "y" => $row['count']);
  array_push($dataPoints, $arrayItem);
}
$db->close();
echo "<a href='/actions/display/display.php' class='btn btn-primary'>Back to Display</a><br/><br/>";
?>
<script>
  window.onload = function() {
    var chart = new CanvasJS.Chart("chartContainer", {
      animationEnabled: true,
      title: {
        text: "Transactions by Category"
      },
      data: [{
        type: "pie",
        yValueFormatString: "#,##0.00\"\"",
        indexLabel: "{label} ({y})",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      }]
    });
    chart.render();
  }
</script>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

