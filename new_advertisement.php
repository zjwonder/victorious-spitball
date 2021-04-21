<?php?>
<html>
	<head>
		<title>Advertisements Manager Database</title>
		<link rel="stylesheet" type="text/css" href="home.css">
	</head>
	
	<body>
		<div class="navigationBar">
			<a href="home.html">Home</a>
			<a href="employeeInformation.php">Employees</a>
			<a href="home.html">Customers</a>
			<a href="home.html">Accounts</a>
			<a href="home.html">Transactions</a>
		</div>
		
		<div style = "padding-left: 16px">
			<h2>Create new ad listing</h2>
			<form method="post" action="add_advertisement.php">
                <table>
                    <tr><td>Ad Title: </td><td><input type="varchar(30)" name="AdvTitle"></td><tr>
                    <tr><td>Price: </td><td><input type="varchar(30)" name="AdvPrice"></td><tr>
                    <tr><td>Details: </td><td><textarea type="varchar(50)" name="AdvDetails"></td><tr>
		    <!-- <tr><td>Details:</td><td><textarea rows="5" cols="50" name="AdvDetails"></textarea></td><tr> -->	
                    <tr><td>Category: </td>
                        <td>
                            <input type="radio" name="Category_ID" value="CAT">Cars and Trucks
                            <input type="radio" name="Category_ID" value="HOU">Housing
                            <input type="radio" name="Category_ID" value="ELC">Electronics
                            <input type="radio" name="Category_ID" value="CCA">Child Care
                        </td><tr>
                </table>
            </form>
	</body>
	
</html>
