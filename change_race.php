<!DOCTYPE html>
<html>
<head>
    <title>Chanhe race</title>
</head>
<body>  
    <?php
        include('conn.php');
        $new_race = $_GET["new_race"];
        $car_change_race = $_GET["car_change_race"];
        $result_table = "";

        $sqlSelect = $dbh->query("SELECT * FROM iteh2lb1var7.cars");
		            
        foreach($sqlSelect as $row) {
            $iter[$row["ID_Cars"]] = $row["ID_Cars"];
            $old_race[$row["ID_Cars"]] = $row["Race"];
        }

        if(is_numeric($new_race)){   
            $sqlUpdate = $dbh->query("UPDATE iteh2lb1var7.cars SET Race='$new_race' WHERE Name='$car_change_race'"); 
        }

        $sqlSelect = $dbh->query("SELECT * FROM iteh2lb1var7.cars");
		            
        foreach($sqlSelect as $row) {
            $iter[$row["ID_Cars"]] = $row["ID_Cars"];
            $result_table = $result_table."<tr><td>{$row['Name']}</td><td>{$old_race[$row["ID_Cars"]]}</td><td>{$row['Race']}</td></tr>";
        }

        echo "<table border ='1'>";
        echo "<tr><th>Car</th><th>Old race</th><th>New race</th></tr>";
           
        echo $result_table;
            
    ?>
</body>
</html> 