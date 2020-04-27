<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
	<h1> Widget Ordering System </h1>
		<hr />
		<h2> Order Confirmation </h2>
<style type="text/css">
				body {font-family: "Verdana"}
				td, th {padding:5px;}
				table.mytable2 {
					border:1px solid black;
				}
				table.mytable2 tr td, th {
    				width:1%;
    				white-space:nowrap;
				}
				table.mytable tr td, th{
					width:1%;
    				white-space:nowrap;
				}

				table.mytable2 td, th{
					border:1px solid black;
				}
				table.mytable2 td:nth-child(4){
					text-align:right;
				}
				table.mytable2 td:nth-child(1){
					width='100%';
				}
				table.mytable2 td:nth-child(2){
					width:300px
				}
				table.mytable2 td:nth-child(3){
					width:120px
				}
				table.mytable2 td:nth-child(4){
					width:120px
				}
	
				table.mytable {
				border:1px solid black;
				}

				table.mytable td, th{
					border:1px solid black;
				}
				table.mytable td:nth-child(3){
					text-align:right;
				}
				table.mytable tr:nth-child(7)
				{
					text-align:right;
				}
				table.mytable tr:nth-child(8)
				{
					text-align:right;
				}
		</style>
		</head>
		<body>
			


			
			<?php
				if($_POST) {
					"</p>";
				}
				else {
					die("<p> No order information supplied. </p>");
				}

				$first = $_POST['firstname'];
				$last = $_POST['lastname'];
				$city = $_POST['city'];
				$custom = $_POST['customer'];
				$zip = $_POST['zip'];
				$addr = $_POST['street'];
				$state = $_POST['state'];

				$extra = $_POST['ExtraC'];
				$super = $_POST['SuperS'];
				$very = $_POST['VeryW'];
				$extrem = $_POST['ExtremelyS'];
				$wonder = $_POST['WonderfullyW'];

				$pextra = $extra * 5.71;
				$pextra = number_format($pextra,2);
				$psuper = $super * 4.21;
				$psuper = number_format($psuper,2);
				$pvery = $very * 2.51;
				$pvery = number_format($pvery,2);
				$pextrem = $extrem * 1.21;
				$pextrem =  number_format($pextrem,2);
				$pwonder = $wonder * 8.51;
				$pwonder = number_format($pwonder,2);
				$total = $pextra + $psuper + $pvery + $pextrem + $pwonder;
				$total = number_format($total, 2);
				if($custom == 'premier')
					$finalC = $total;
				else{
					$finalC = $total * .8;
					$finalC = number_format($finalC, 2);
				}


			
			//Create a connection to the MySQL server and store DB resource handle
			$handle = mysql_connect('localhost','root');
			
			//Check to see if connection established and exit on error
			if($handle == FAlSE)
			{
				die("No database connection available: ".mysql_error());
			}
			
			//Select the database that you want to use
			$db = mysql_select_db('store');
			if($db == FALSE)
			{
				die("Unable to select database: ".mysql_error());
			}
			
			$query = "SELECT cfname, cid
						FROM customers
						WHERE cfname = '$first' AND clname = '$last' AND czip = $zip";
	
			$result= mysql_query($query, $handle);
			if($result==FALSE) {
				echo "<p>QUERY ERROR: ". mysql_error() ."</p>";
			}
	
			$row=mysql_fetch_assoc($result);

			if($row != NULL)
			{
				echo "<p> Welcome back ".$row['cfname']."!</p>";
				$cid = $row['cid'];
			}
			else
			{
				$insert = "INSERT INTO customers VALUES
							(NULL, '$first', '$last', '$addr', '$city', '$state', '$zip', '$custom')";
				$rofinsert = mysql_query($insert, $handle);
				
				if($rofinsert==FALSE) {
					echo "<p>QUERY ERROR: ". mysql_error() ."</p>";
				}
				
				$query = "SELECT cid
							FROM customers
							WHERE cfname = '$first' AND clname = '$last' AND czip = $zip";
				
				$result= mysql_query($query, $handle);
				if($result==FALSE) {
					echo "<p>QUERY ERROR: ". mysql_error() ."</p>";
				}

				$row=mysql_fetch_assoc($result);
				$cid = $row['cid'];
				
				
				echo "<p> Welcome  to our store ".$first."! We have added you to our customer database.</p>"; 
			}
			
			
			//Insert order
				
			$insert = "INSERT INTO orders VALUES
						(NULL, $cid, $extra, $super, $very, $extrem, $wonder, NOW(), $finalC)";
				
			$rofinsert = mysql_query($insert, $handle);
				
			if($rofinsert==FALSE) {
				echo "<p>QUERY ERROR: ". mysql_error() ."</p>";
			}
			else{
				echo "<p> Thank you. Your order was submitted successfully!</p>";
			}
			
			$query = "SELECT SUM(qty_8493) AS exSold, SUM(qty_3423) AS suSold, SUM(qty_2382) AS veSold, SUM(qty_4523) AS etSold, SUM(qty_6851) AS woSold
						FROM orders";
			
			$result= mysql_query($query, $handle);
			
			if($result==FALSE) {
				echo "<p>QUERY ERROR: ". mysql_error() ."</p>";
			}
			

			$row=mysql_fetch_assoc($result);
			
			$pextraT = 5.71 * $row['exSold'];
			$psuperT = 4.21 * $row['suSold'];
			$pveryT = 2.51 * $row['veSold'];
			$pextremT = 1.21 * $row['etSold'];
			$pwonderT = 8.51 * $row['woSold'];
				
			//Output Sales Report
			echo "<hr />";
			echo "<h3> Sales Report for All Orders </h3>";
			echo "<table class = 'mytable' style='width:26%'>
  					<tr>
						<th>QTY Sold</th>
						<th>Item</th>
						<th>Total Sales</th>
					</tr>
					<tr>
						<td> ".$row['exSold']." </td>
						<td>Widget #8493 - Extra Crunchy</td>
						<td>$ ".number_format($pextraT,2)."</td>
					</tr>
					<tr>
						<td> ".$row['suSold']." </td>
						<td>Widget #3423 - Super Slippery</td>
						<td>$ ".number_format($psuperT,2)."  </td>
					</tr>
					<tr>
						<td> ".$row['veSold']." </td>
						<td>Widget #2382 -Very Wobbly</td>
						<td>$ ".number_format($pveryT,2)." </td>
					</tr>
					<tr>
						<td> ".$row['etSold']." </td>
						<td>Widget #4523 - Extremely Sticky</td>
						<td>$ ".number_format($pextremT,2)." </td>
					</tr>
					<tr>
						<td> ".$row['woSold']." </td>
						<td>Widget #6851 - Wonderfully Wacky</td>
						<td>$ ".number_format($pwonderT,2)."</td>
					</tr>
					
				</table><br/>";
			
			
			$query = "SELECT orderno, cfname, clname, orderdate, fprice
						FROM orders, customers
						WHERE orders.cid = customers.cid
						ORDER BY orderno DESC";
			
			$result= mysql_query($query, $handle);
			
			if($result==FALSE) {
				echo "<p>QUERY ERROR: ". mysql_error() ."</p>";
			}
			
			echo "<table class = 'mytable2' style='width:26%'>
  					<tr>
						<th>Order Number</th>
						<th>Order Date</th>
						<th>Customer</th>
						<th>Final Total</th>
					</tr>";
			
			while($row=mysql_fetch_assoc($result))
			{
					echo "<tr>
						<td> ".$row['orderno']." </td>
						<td>".$row['orderdate']."</td>
						<td> ".$row['cfname']." ".$row['clname']."</td>
						<td> $".number_format($row['fprice'],2)."</td>
					</tr>";
			}
			
			echo "</table><br/>";
		?>
	
	<a href="http://localhost/widgets.php">Click here to submit another order!</a>
			
<body>
</body>
</html>