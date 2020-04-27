<!DOCTYPE html>
<html>
	<head>
		<title>Assignment #1</title>
		<style type="text/css">
			body {font-family: "Verdana"}
			td, th {padding:5px;}
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
		<h1> Widget Ordering System </h1>
		<hr />
		<h2> Customer Information </h2>
		<form method="post" action="widgets2.php">
			<p> <table>
			<tr>
				<td>Customer Type: </td>
				<td><input type="radio" name="customer" value="premier" > Premier
					<input type="radio" name="customer" value="elite" checked> Elite</td>
  			</tr>
  			<tr>
				<td>Customer First Name:</td>
				<td><input type="text" name="firstname"></td>
			</tr>
			<tr>
				<td>Customer Last Name:</td>
				<td><input type="text" name="lastname"></td>
			</tr>
			<tr>
				<td>Street:</td>
				<td><input type="text" name="street"></td>
			</tr>
			<tr>
				<td>City:</td>
				<td><input type="text" name="city"></td>
			</tr>
			<tr>
				<td>State:</td>
				<td><select name="state">
    				<option value="ct">CT</option>
  					<option value="me">ME</option>
 			   		<option value="ma">MA</option>
    				<option value="nh">NH</option>
					<option value="ri" selected>RI</option>
    				<option value="vt">VT</option>
				</select></td>
			</tr>
			<tr>
				<td>Zip Code:</td>
				<td><input type="text" name="zip" size=4></td>
			</tr>
				<table/>
				<h2> Order Information </h2><br>
				<table class = 'mytable' style="width:26%">
  					<tr>
						<th>QTY</th>
						<th>Item</th>
						<th>Item Price</th>
					</tr>
					<tr>
						<td><input type="text" name="ExtraC" value=0 size=3></td>
						<td>Widget #8493 - Extra Crunchy</td>
						<td>$ 5.71</td>
					</tr>
					<tr>
						<td><input type="text" name="SuperS" value = 0 size=3></td>
						<td>Widget #3423 - Super Slippery</td>
						<td>$ 4.21</td>
					</tr>
					<tr>
						<td><input type="text" name="VeryW" value=0 size=3></td>
						<td>Widget #2382 -Very Wobbly</td>
						<td>$ 2.51</td>
					</tr>
					<tr>
						<td><input type="text" name="ExtremelyS" value = 0 size=3></td>
						<td>Widget #4523 - Extremely Sticky</td>
						<td>$ 1.21</td>
					</tr>
					<tr>
						<td><input type="text" name="WonderfullyW" value = 0 size=3></td>
						<td>Widget #6851 - Wonderfully Wacky</td>
						<td>$ 8.51</td>
					</tr>
				</table>
				<br>
				<input type="submit" value="Submit your Order">
				<input type="reset" value="Reset your Order Form"><br>
			</p>
		</form>
		<hr />
		<h2> Order Summary </h2>
		<?php
			if($_POST) {
				"</p>";
			}
			else {
				die("<p> No order information supplied. </p>");
			}
			
			$first = $_POST['firstname'];
			$city = $_POST['city'];
			$custom = $_POST['customer'];
		
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
			
			echo "<p> Dear $first,</p>";
			echo "<p> Thank you for placing an order. You can expect to receive your widgets in $city by the end of the week.</p>";
			echo "<h3> Order Statement </h3>";
			echo "<table class = 'mytable' style='width:26%'>
  					<tr>
						<th>QTY</th>
						<th>Item</th>
						<th>Total Price</th>
					</tr>
					<tr>
						<td> $extra </td>
						<td>Widget #8493 - Extra Crunchy</td>
						<td> $pextra</td>
					</tr>
					<tr>
						<td> $super </td>
						<td>Widget #3423 - Super Slippery</td>
						<td> $psuper </td>
					</tr>
					<tr>
						<td> $very </td>
						<td>Widget #2382 -Very Wobbly</td>
						<td> $pvery</td>
					</tr>
					<tr>
						<td> $extrem </td>
						<td>Widget #4523 - Extremely Sticky</td>
						<td> $pextrem</td>
					</tr>
					<tr>
						<td> $wonder </td>
						<td>Widget #6851 - Wonderfully Wacky</td>
						<td> $pwonder</td>
					</tr>
					<tr>
						<td colspan='2'>Product Total</td>
						<td> $total</td>
					</tr>
					<tr>
						<td colspan='2'>Final Cost</td>
						<td> $finalC</td>
					</tr>
					
				</table><br/>";
			
		?>
	</body>
</html>
