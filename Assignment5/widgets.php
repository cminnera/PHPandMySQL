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
		<form method="post" action="processA5.php">
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

			
	</body>
</html>