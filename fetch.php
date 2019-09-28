<?php
//Create Connection
$conn = mysqli_connect("localhost", "guest", "interview", "interview");

//Checks for connection
if($conn-> connect_error){
	die("Connection to db failed:". $conn-> connect_error);
}
//Checks submit botton
if(isset($_POST["submit"])){
	if(!empty($_POST["search"])){
        $condition = ' ';
        $query = explode(" ", $_POST["search"]);
        foreach($query as $text){
            $condition .= "message LIKE %" .mysqli_real_escape_string($conn, $text). "% OR";
        }
        //$condition = substr($condition, 0, -4);
        $sql = "SELECT * FROM messages LIMIT 30 WHERE" .$condition;
        $result = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($result);
        if($count > 0){
            while($row = mysqli_fetch_assoc($result )){
                echo '<tr><td>'.$row["message"].'</td></tr>';
            }

        }
        else{
            echo 'No result found';
        }
    }
    else{
        echo 'Please enter data to search';
    }
}

?>