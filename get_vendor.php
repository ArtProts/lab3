<?php
        include('conn.php');
        $vendor = $_GET["vendor"];
        $result = "";
        foreach($dbh->query("SELECT * FROM iteh2lb1var7.vendors") as $row){
            if ($vendor == $row['Name']){
                $id_vendor = $row['ID_Vendors'];
            }
        }
              
        $sqlSelect = $dbh->prepare("SELECT * FROM iteh2lb1var7.cars WHERE FID_Vendors= :id_vendor");
        $sqlSelect->execute((array(':id_vendor' => $id_vendor)));
        // echo $vendor ." manufacturer cars";
        $cursor = $sqlSelect->fetchAll(PDO::FETCH_OBJ);
          
        echo json_encode($cursor);
?>
