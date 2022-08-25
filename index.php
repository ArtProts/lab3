<?php
 include('conn.php');
?>
<!DOCTYPE HTML>
<html>

<head>
    <title>LAB3</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="src.js"></script>
</head>
<body>
<div class="container">
    <p>Select date to get profit
        <input name="date_profit" type=date id="date_profit">
        <button onclick="text()" >Get profit</button>



    <p>Select vendor to get all his cars
        <select name='vendor' id="vendor">
    <?php
        $sqlSelect = "SELECT * FROM iteh2lb1var7.vendors";

        foreach($dbh->query($sqlSelect ) as $cell)
        {
            echo "<option> $cell[1]</option>";
        }
    ?>
        </select>
    <button onclick="J_SON()">Get vendor's</button>



    <p>Select date to get available car's
        <input name="date_available" type=date id="date_available">
        <button onclick="XML()" >Get available car's</button>



<form method="GET" action="rent_info.php">
    <p>Select date/time start rent:
        <input type="date" name= "date_start">
        <input type="time" name = "time_start"><br>

    <p>Select date/time end rent:
        <input type="date" name="date_end">
        <input type="time" name="time_end" ><br>
        
    <p>Select car:
        <select name='rent_car'>  
            <?php
                $sqlSelect = "SELECT * FROM iteh2lb1var7.cars";
                    foreach ($dbh->query($sqlSelect) as $cell) {
                        echo "<option>$cell[1]</option>";
                    }
            ?>
        </select>
       
    <p>Input price rent:
        <input name="price_rent" type="number" value="0" >
        <input type="submit" value="Rent" />
</form>



<form method="get" action="change_race.php">
    <p>Select car for change race:
        <select name='car_change_race'>
            <?php
                $sqlSelect = "SELECT * FROM iteh2lb1var7.cars";
                foreach ($dbh->query($sqlSelect) as $cell) {
                    echo "<option> $cell[1]</option>"; 
                }
            ?>
        </select>
    <p>Input race
        <input name="new_race"  type="text" value="0">
    <input type="submit" value="Change">   

</form> 
    </div>


<div id="result_table"></div>
</body>

</html>