<!DOCTYPE html>
<html>
	<head>
		<title>Lab #2 - Part #1</title>
		<style type="text/css">
			body {font-family:"Courier New";}
			table {border:2px solid black; border-collapse:collapse;}
			th, td {border:2px solid black;text-align:left; vertical-align:top;}
		</style>
	</head>
	<body>

		<?php
			//Create a connection to the MySQL server and store DB resource handle
			$handle = mysql_connect('localhost','root');
			
			//Check to see if connection established and exit on error
			if($handle == FAlSE)
			{
				die("No database connection available: ".mysql_error());
			}
			
			//Select the database that you want to use
			$db = mysql_select_db('company');
			if($db == FALSE)
			{
				die("Unable to select database: ".mysql_error());
			}
			
		?>


			

		
		   

		<?php
			if($_POST) {
				"</p>";
			}
			else {
				die("<p> No order information supplied. </p>");
			}
			$depart = $_POST['dnum'];
			//Step #1 - Formulate your query  (Same as Section II)
			$query = "SELECT Pname, Pnumber, Plocation
						FROM PROJECT
						WHERE Dnum = $depart";
			
			//Step #2 - Run query and store result  (Same as Section II)
			$result= mysql_query($query, $handle);
			if($result==FALSE) {
				echo "<p>QUERY ERROR: ". mysql_error() ."</p>";
			}
			
			//Step #3 - Working with the results  (Some will be the same as Section II)
			echo "</br>";
			echo '<table border="1">';
			echo "<tr>";
				echo "<th>Project Name</th>";
				echo "<th>Project Number</th>";
				echo "<th>Project Location</th>";
				echo "<th>Employees (SSN)</th>";
			echo "</tr>";
			while($row=mysql_fetch_assoc($result))
			{
				echo "<tr> <td>".$row['Pname'] . "</td>";
				echo "<td>".$row['Pnumber'] . "</td>";
				echo "<td>".$row['Plocation'] . "</td>";
				
				$subquery = "SELECT Essn
							FROM WORKS_ON
							WHERE Pno =" .$row['Pnumber'];
				
				$subresult = mysql_query($subquery, $handle);
				
				if($subresult == FALSE)
				{
					echo "<p>QUERY ERROR: ". mysql_error() ."</p>";
				}
				echo "<td>";
				while($subrow = mysql_fetch_assoc($subresult))
				{
					echo $subrow['Essn'] ."<br />";
				}
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			
		?>
			
			


		<?php
			mysql_close($handle);
		?>
		
	</body>
</html>