
<?php
    include 'getIP.php';  

    $servername = "localhost";
    $username = "root";
    $password = "";
    $db_name="contador";

    // Create connection
    $conn = new mysqli($servername, $username, $password,$db_name);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    
    //Adding new Visit
    getUserIP();
    echo "<br>";
    echo "<br>";

   /*  $visitor_ip=$_SERVER['REMOTE_ADDR'];
    echo $visitor_ip; */
    //Checking if visitor is UNIQUE
    $query="SELECT * FROM counter_table WHERE ip_adress='$visitor_ip'";
    $result=mysqli_query($conn,$query);
    //Check Query error
    if (!$result){
       die("ERROR EN BUSQUEDA DE IP<br>" ); 
    }

    $total_visitors=mysqli_num_rows($result);
    if($total_visitors<1){
        $query="INSERT INTO counter_table (ip_adress) VALUES ('$visitor_ip')";
        $result=mysqli_query($conn,$query);
    }
    if (!$result){
        die("ERROR EN INSERT<br>" ); 
     }

    //Retriving existing visitor

    $query="SELECT * FROM counter_table";
    $result=mysqli_query($conn,$query);
    //Check Query error
    if (!$result){
       die("ERROR EN CONSURLTA<br>" ); 
    }
    $total_visitors=mysqli_num_rows($result);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style type="text/css">
            .wrapper {
                height: 300px;
                width: 300px;
                background-color: skyblue;
                margin: auto;
                text-align: center;
                border: 1px solid white;
                box-shadow: 2px 2px 10px gray;
            }
            
            h1 {
                background-color: mediumseagreen;
                color: white;
                border-bottom: 2px solid white;
            }
            
            h3 {
                font-size: 5em;
            }
            
            h1,
            h3 {
                padding: 20px;
                margin: 0px;
            }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <h1>
                Visitor Count
            </h1>
            <h3>
                <?php 
                    echo $total_visitors;
                ?>
            </h3>
        </div>
    </body>

    </html>