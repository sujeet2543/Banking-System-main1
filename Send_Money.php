<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/Send_Money.css">
</head>

<body>
    <!-- Navbar Starts -->
    <nav class="navbar bg-transparent navbar-expand-lg b px-4 ">
        <!-- main logo -->
        <a class="navbar-brand fs-2 txt_prop" href="index.html">GripBank</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-5 text-center">
                <li class="nav-item">
                    <a class="nav-link txt_prop" aria-current="page" href="index.html">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link txt_prop" href="Users.php">View Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link txt_prop" href="Transactions.php">Transactions</a>
                </li>
        </div>
    </nav>
    <!-- Navbar Ends Here -->


    <div class="container usr_bal d-flex justify-content-center txt_prop">
        <span>
            <h2 style="display: inline;"> My Balance : </h2>
            <?php
            include 'main.php';
            $sql_Q_1 = "select * from `users` where id=1";
            $result1 = mysqli_query($conn, $sql_Q_1);
            $row_1 = $result1->fetch_assoc();
            $main_bal = $row_1["Balance"];
            echo "<h2 style='display : inline'>" . $main_bal . "</h2>";
            ?></h2>
        </span>
    </div>



    <div class="container cont_prop ">
        <form action="Send_Money.php" method="post">
            <div>
                <div class="form-group form_ele">
                    <label for="Usr_req_name" class="form_ele">Name</label>
                    <input type="text" class="form-control form_ele" name="Usr_req_name" placeholder="Enter Name : ">
                </div>
                <div class="form-group form_ele">
                    <label for="Usr_req_amount" class="form_ele">Amount</label>
                    <input type="number" class="form-control form_ele" name="Usr_req_amount" placeholder="Enter Amount : ">
                </div>
                <input type="Submit" class="btn btn-light form_ele" name="submit">
            </div>
        </form>
    </div>

    <!-- PHP Code -->
    <?php
    if (isset($_POST['submit'])) {

        // Includes the Database Connection
        include 'main.php';


        if ((isset($_POST["Usr_req_name"]) || isset($_POST["Usr_req_amount"])) && $_POST["submit"]) {

            // Input From User
            $input_name = $_POST["Usr_req_name"];
            $input_amount = intval($_POST["Usr_req_amount"]);

            //Validations and Operations:
            if($main_bal > 0){
                if(is_string($input_name) && is_int($input_amount)){
                    if($input_amount < $main_bal){

                        //Fetching the User Information
                        $query1 = "select * from `users` where name= '$input_name'";
                        $result1 = $conn->query($query1);
                        $user_res = $result1->fetch_assoc();
                        
                        // Updating the User's Account
                        $new_usr_bal = $user_res["Balance"] + ($input_amount);
                        $query2 = "update `users` set Balance = '$new_usr_bal' where name= '$input_name'";
                        mysqli_query($conn, $query2);
            
                        // //Updating the main user
                        $main_bal = ($main_bal - $input_amount);
                        $query3 = "update `users` set Balance = '$main_bal' where id = 1";
                        mysqli_query($conn, $query3);
                    
                        //updating the transactions table
                        $email = $user_res["Email"];
                        $query4 = "INSERT INTO `transactions` (id ,name ,email ,Amount_Transferred ,TimeStamp ) VALUES ('','$input_name','$email','$input_amount',CURRENT_TIMESTAMP())";
                        mysqli_query($conn,$query4);
                    }
                    else{
                        echo "<script>alert('Not Enough Balance');</script>";
                    }
                }
                else{
                    echo "<script>alert('Please Enter Valid Input');</script>";
                }
            }
            else{
                echo "<script> alert('Oops Not Enough Balance !'); </script>";
            }


        echo "<script> 
        alert('Transaction Successfull');
        window.location = 'Users.php' </script>";

        }
    }

    // Close the database connection
    $conn->close();
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
</body>

</html>