<!DOCTYPE html>
<html>
<head>
    <title>Rent info</title>
</head>
<body>
    <?php
        include('conn.php');
        
        $date_start = $_GET["date_start"];
        $time_start = $_GET["time_start"];
        $date_end = $_GET["date_end"];
        $time_end = $_GET["time_end"];
        $rent_car = $_GET["rent_car"];
        $price_rent = $_GET["price_rent"];

        $result_table = "";
                  
        foreach($dbh->query("SELECT * FROM iteh2lb1var7.cars") as $row) {
            if($rent_car == $row["Name"]){
                $car_id = $row['ID_Cars'];
            }
            $cars[$row["ID_Cars"]] = $row["Name"];
            $car_available[$row["ID_Cars"]] = 1;
            $iter[$row["ID_Cars"]] = $row["ID_Cars"];
        }

        $sqlSelect = $dbh->query("SELECT * FROM iteh2lb1var7.rent");

        foreach($sqlSelect as $row) {
            if (($row['Date_start'] <= $date_start)&&($row['Date_end'] >= $date_start)){ 
                $car_available[$row["FID_Car"]] = 0;       
            }
        }

        if($car_available[$car_id]){
            $dbh->query("INSERT INTO iteh2lb1var7.rent (FID_Car,Date_start,Time_start,Date_end,Time_end,Cost) VALUES('$car_id','$date_start','$time_start','".$date_end."','$time_end','$price_rent')");
            echo "$rent_car was rented from $date_start to $date_end";
        }
        else{
            echo "This car is not available";
        }           
        
        $sqlSelect = $dbh->query("SELECT * FROM iteh2lb1var7.rent");  
        foreach($sqlSelect as $row) {
           
            $result_table = $result_table."<tr><td>{$cars[$row['FID_Car']]}</td><td>{$row['Date_start']}</td><td>{$row['Date_end']}</td></tr>";
        }
        echo "<table border ='1'>";
        echo "<tr><td>Car</td><td>Rent start</td><td>Rent end</td></tr>";
        echo $result_table;

    ?>
</body>
</html>
