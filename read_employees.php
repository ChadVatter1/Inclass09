<?php
require "db.php";

$result = $conn->query(
    "SELECT emp_name,
            job_name,
            salary,
            id
     FROM employees
     ORDER BY emp_name"
);
?>

<!DOCTYPE html>

<html>

<head>

<title>Employees</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body class="demo-page">

<div class="demo-shell">

<div class="demo-card">

<h2 class="demo-title">
Employee Records
</h2>

<table border="1" cellpadding="8">

<tr>
    <th>Name</th>
    <th>Job</th>
    <th>Salary</th>
</tr>

<?php

while($row = $result->fetch_assoc())
{
?>

<tr>

<td><?php echo htmlspecialchars($row["emp_name"]); ?></td>

<td><?php echo htmlspecialchars($row["job_name"]); ?></td>

<td>$<?php echo number_format($row["salary"],2); ?></td>

</tr>

<?php
}
?>

</table>

<br>

<a class="demo-link" href="employee_demo.php">
Back to Form
</a>

</div>

</div>

</body>

</html>

<?php
$conn->close();
?>