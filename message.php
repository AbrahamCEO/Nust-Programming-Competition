
<?php
include "db_connection.php"; // Ensure you have a valid connection

$getMesg = mysqli_real_escape_string($conn, $_POST['text']);

// Split the queries by pipe to check multiple variations
$check_data = "SELECT replies FROM chatbot WHERE queries LIKE '%$getMesg%' OR queries LIKE BINARY '%$getMesg%'";
$run_query = mysqli_query($conn, $check_data) or die("Error");

if(mysqli_num_rows($run_query) > 0){
    $fetch_data = mysqli_fetch_assoc($run_query);
    $replay = $fetch_data['replies'];
    echo $replay;
}else{
    echo "I apologize, but I don't have information about that. Please contact our support team for more specific assistance.";
}