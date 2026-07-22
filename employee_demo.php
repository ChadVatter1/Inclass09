<?php
require "db.php";

$message = "";
$type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = trim($_POST["name"]);
    $job = trim($_POST["job"]);
    $salary = trim($_POST["salary"]);

    if ($name == "" || $job == "" || $salary == "")
    {
        $message = "Please fill in all fields.";
        $type = "error";
    }
    else
    {
        $stmt = $conn->prepare(
            "INSERT INTO employees (emp_name, job_name, salary)
             VALUES (?, ?, ?)"
        );

        $stmt->bind_param("ssd", $name, $job, $salary);

        if ($stmt->execute())
        {
            $message = "Employee added successfully.";
            $type = "success";
        }
        else
        {
            $message = "Unable to add employee.";
            $type = "error";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Demo</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="demo-page">

<div class="demo-shell">

<div class="demo-card">

<h2 class="demo-title">Employee Form</h2>

<p class="demo-subtitle">
Enter a new employee below.
</p>

<form method="post">

<div class="demo-grid">

<div class="demo-field">
<label>Name</label>
<input
class="demo-input"
type="text"
name="name">
</div>

<div class="demo-field">
<label>Job Title</label>
<input
class="demo-input"
type="text"
name="job">
</div>

<div class="demo-field">
<label>Salary</label>
<input
class="demo-input"
type="number"
step="0.01"
name="salary">
</div>

</div>

<div class="demo-actions">

<button class="demo-btn">
Add Employee
</button>

<a class="demo-link" href="read_employees.php">
View Employees
</a>

</div>

</form>

<?php
if ($message != "")
{
    echo "<div class='demo-msg $type'>$message</div>";
}
?>

</div>

</div>

</body>
</html>

<?php
$conn->close();
?>