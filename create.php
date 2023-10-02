<?php

$servername="localhost";
$username="root";
$password="tiger";
$database="myshop";

// Create Connection
$connection = new mysqli($servername, $username, $password, $database)

$name = "";
$email = "";
$phone = "";
$address = "";

$errorMsg = "";
$successMsg = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do{
        if(empty($name) || empty($email || empty($phone) || empty($address))){
            $errorMsg = "All Fields are required";
            break;
        }

        // add new client to database
        $sql = "INSERT INTO clients (name, email, phone, address)".
                "VALUES('$name', '$email', '$phone', '$address')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMsg = "Invalid Query: " . $connection->error;
            break;
        }

        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMsg = "Client added successfully";

        header("location: /myshop/index.php");
        exit();

    }while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>My Shop</title>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>
        <?php 
        if(!empty($errorMsg)){
            echo"
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>$errorMsg</strong>
                <button type="button" class="btn-close" data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
       
        <form action="" method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>

            <?php 
            if(!empty($successMsg)){
                echo"
                <div class="row mb-3">
                    <div class='offset-sm-3 col-sm-6'>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>$errorMsg</strong>
                        <button type="button" class="btn-close" data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>