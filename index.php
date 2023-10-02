<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>My Shop</title>
</head>
<body>
    <div class="container my-5">
        <h2>List of Clients</h2>
        <a class="btn btn-primary" href="/myshop/create.php" role="button">New Client</a>
        <br>
        <table>
             <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
             </thead>
             <tbody>
                <?php
                $servername = "localhost";
                $username="root";
                $password="tiger";
                $database="myshop";

                // Create Connection
                $connection = new mysqli($servername, $username, $password, $database);

                // Check connection
                if($connection->connect_error){
                    die("Connection failed:" . $connection->connection_error);
                }

                // read all row from database table
                $sql = "SELECT * from clients";
                $result = $connection->query($sql);

                if(!$result){
                    die("Invalid query: " . $connection->error);
                }

                // read data of each row
                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                        <td>$row[id]</td>
                        <td>$row[name]</td>
                        <td>$row[email]</td>
                        <td>$row[phone]</td>
                        <td>$row[address]</td>
                        <td>$row[created_at]</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href='/myshop/edit.php?id=$row[id]'>Edit</a>
                            <a class="btn btn-primary btn-sm" href='/myshop/delete.php?id=$row[id]'>Delete</a>
                        </td>
                     </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>