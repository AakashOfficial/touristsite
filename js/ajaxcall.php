<?php
    $hostname = 'localhost'; 
    $username = 'root'; 
    $password = ''; 
    $databaseName = 'tourist'; 

    //Open the database connection - exit with error message otherwise 

    $connection = mysqli_connect($hostname, $username, $password, $databaseName) 
    or exit("Unable to connect to database!");
    
    $u = $_REQUEST['u'];
    //echo $u;

    $sql_query = "select * from customers where customer_email='$u'";
    $result = mysqli_query($connection, $sql_query); 
    $answer = mysqli_num_rows($result) ;
    if($answer > 0){
        echo "found";
    }else{
        echo "not found";
    }


?>