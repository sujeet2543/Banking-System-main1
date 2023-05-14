<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/Users.css">
    <title>Customers</title>
</head>
<body class ="background">
  <header>
    <div>
      <nav class="navbar bg-transparent navbar-expand-lg b px-4 ">
        <!-- main logo -->
        <a class="navbar-brand fs-2 text_prop" href="index.html">GripBank</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-5 text-center">
            <li class="nav-item">
              <a class="nav-link text_prop" aria-current="page" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text_prop" href="Send_Money.php">Send Money</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text_prop" href="Users.php">View Users</a>
            </li>  
        </div>
      </nav>
    </div>
  </header>
    

    <div class="d-flex justify-content-center main_txt_prop">
        <h1 class="text_prop">Transactions Data</h1>
    </div>
    
    
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
    crossorigin="anonymous"></script>



<?php

// Contains the Database Connection

include 'main.php';

// SQL query to retrieve data from the database
$sql = "SELECT * FROM `transactions`";

// Execute the query and get the results
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    //building the HTML table
    echo "<div class='container cont_prop'>";
    echo "<table class='table table-hover border-dark text_prop'>";
    echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Amount Transferred</th><th>Time</th></tr>";

    $id = 1; //--> Because the id==1 is our Main_User[Admin]

    // Loop through the rows and display the data in the table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $id . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["Amount_Transferred"] . "</td>";
        echo "<td>" . $row["TimeStamp"] . "</td>";
        echo "</tr>";
        $id++;
    }

    // Close the HTML table 
    echo "</table>";
    
} else {
    echo "0 results";
}
echo "</div>";
?>
</body>
</html>


