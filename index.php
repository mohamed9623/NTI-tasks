<!DOCTYPE html>

<head>

	<title>Calculate Electricity Bill</title>

</head>

<?php


$result_str = $result = '';
if (isset($_POST['unit-submit'])) {
    $units = $_POST['units'];
    if (!empty($units)) {
        $result = calculate_bill($units);
        $result_str = 'Total amount of ' . $units . ' - ' . $result;
    }
}

 //  calculate electricity bill as per unit cost
 
function calculate_bill($units) {
    $first_cost = 3.50;
    $second_cost = 4.00;
    $third_cost =  6.50;
   

    if($units <= 50) {
        $bill = $units * $first_cost;
    }
    else if($units > 50 && $units <= 100) {
        $temp = 50 *  $first_cost;
        $remaining_units = $units - 50;
        $bill = $temp + ($remaining_units * $second_cost);
    }
    else  {
        $temp = (50 * 3.5) + (100 * $second_cost );
        $remaining_units = $units - 150;
        $bill = $temp + ($remaining_units * $third_cost);
    }
  
    
    return number_format((float)$bill, 2, '.', '');
}

?>

<body>

<style>
    h1{
        color:red;
        margin-left:800px;
    }
    form{
        margin-left:800px;
    }
 
    #output{
        margin-left:800px;
        font-weight:bold;
        color:darkblue;
    }

</style>

	<div id="page-wrap">
		<h1>Calculate Electricity Bill</h1>

		<form action="" method="post" >
            	<input  name="units" id="units" placeholder=" no. of Units" />
            	<input type="submit" name="unit-submit" id="unit-submit" value="Submit" />
		</form>

		 <div id="output">
		    <?php echo '<br />' . $result_str; ?>
		</div> 
	</div>
</body>
</html>