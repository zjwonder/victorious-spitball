<?php
require_once 'connection.php'

$AdvTitle=isset($_POST['AdvTitle'])?$_POST['AdvTitle']:"";
$AdvDetails=isset($_POST['AdvDetails'])?$_POST['AdvDetails']:"";
$AdvDate=date("Y-m-d");
$AdvPrice=isset($_POST['AdvPrice'])?$_POST['AdvPrice']:"";
$User_ID=; // needs to reference the logged in user somehow
// mod ID added when it is reviewed by logged in moderator
$Category_ID=isset($_POST['Category_ID'])?$_POST['Category_ID']:"";
$Status_ID='PN';

$SQL = "INSERT INTO Advertisements(AdvTitle, AdvDetails, AdvDate, AdvPrice, User_ID, Category_ID, Status_ID) VALUES (";
$SQL.= "'".$AdvTitle."', '".$AdvDetails"', '".$AdvDate."', '".$AdvPrice."', '".$User_ID."', '".$Category_ID."', '".$Status_ID."')";
$result = mysqli_query($connection, $SQL);

if (!$result)
    die ("Unable to connect: " . mysqli_error($connection));

    if ($AdvTitle != '' && $AdvDetails != '' && $AdvDate != '' && $AdvPrice != '' && $User_ID != '' && $Category_ID != '' && $Status_ID != '' &&)
    {
        header("Location: success.php")
    }
?>
