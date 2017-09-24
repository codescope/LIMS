<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
if(isset($_GET['customer_id'])){
    $customer =get_customer_by_id($_GET['customer_id']);

    if(!$customer){
        redirect_to("reception.php");
    }
}
else {
    redirect_to("reception.php");

}

$id = $customer['customer_id'];
$query = "DELETE FROM commercial_customers WHERE customer_id = '{$id}' LIMIT 1";
$result = mysqli_query($connection, $query);

if ($result && mysqli_affected_rows($connection) == 1) {
    // Success
    $_SESSION["message"] = "Sample record deleted.";
    redirect_to("reception.php");
} else {
    // Failure
    $_SESSION["message"] = "Sample record deletion failed.";
    redirect_to("reception.php");
}

?>
