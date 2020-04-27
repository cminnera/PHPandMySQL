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
		<h1> Lab #2 - Part #1 </h1>
		<p> Note:This labs assumes that the "company.sql" file has been properly imported into MySQL. </p>
		<hr />
		<h2> Section I </h2>
		<h3> Establish database connection and open "company" database. </h3>
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
		<hr />
		<h2> Section II </h2>
		<h3> Formulate basic query and display output in HTML tables. </h3>
		<h4> Query: List all of the projects for department number "6". <br />
			Output columns: Project Name, Project Number, Project Location. <br />
			Output display: Utilize a TABLE to display your output, similar to the following.
		</h4>
		<table border="1">
			<tr>
				<th>Project Name</th>
				<th>Project Number</th>
				<th>Project Location</th>
			</tr>
			<tr>
				<td>Example Project</td>
				<td>123</td>
				<td>Providence</td>
			</tr>
		</table>
		<?php
			//Step #1 - Formulate your query
			$query = "SELECT Pname, Pnumber, Plocation
						FROM PROJECT
						WHERE Dnum = '6'";
			
			//Step #2 - Run query and store result
			$result= mysql_query($query, $handle);
			if($result==FALSE) {
				echo "<p>QUERY ERROR: ". mysql_error() ."</p>";
			}
			//Step #3 - Working with the results
			
			echo "</br>";
			echo '<table border="1">';
			echo "<tr>";
				echo "<th>Project Name</th>";
				echo "<th>Project Number</th>";
				echo "<th>Project Location</th>";
			echo "</tr>";
			while($row=mysql_fetch_assoc($result))
			{
				echo "<tr> <td>".$row['Pname'] . "</td>";
				echo "<td>".$row['Pnumber'] . "</td>";
				echo "<td>".$row['Plocation'] . "</td>";
				echo "</tr>";
			}
			echo "</table>";
			
		?>
		<hr />
		
		   
		<h2> Section III </h2>
		<h3> Formulate sub-query that runs for each result row and add output to the HTML table. </h3>
		<h4> Query: List all of the projects for department number "6" and the employees associated to the project. <br />
			Output columns: Project Name, Project Number, Project Location, Employees(SSN). <br />
			Output display: Utilize a TABLE to display your output, similar to the following.
		</h4>
		<table border="1">
			<tr>
				<th>Project Name</th>
				<th>Project Number</th>
				<th>Project Location</th>
				<th>Employees (SSN)</th>
			</tr>
			<tr>
				<td>Example Project</td>
				<td>123</td>
				<td>Providence</td>
				<td>
					123456789 <br />
					234567890 <br />
				</td>
			</tr>
		</table>
		<?php
			//Step #1 - Formulate your query  (Same as Section II)
			$query = "SELECT Pname, Pnumber, Plocation
						FROM PROJECT
						WHERE Dnum = '6'";
			
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
			// When you get to the last column of a row, run a new subquery.
			// Remember to use different names for your subquery and its result
			// Try using the prefix "sub" for the variables: $subquery, $subresult, $subrow
			
			
		?>
		<hr />
		<h2> End </h2>
		<h3> Close connection to database. </h3>
		<?php
			mysql_close($handle);
		?>
		
	</body>
</html>