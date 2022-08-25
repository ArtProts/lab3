<?php
 include('conn.php');
 if(isset($_GET["date_profit"]))
 {
     $date_profit = $_GET["date_profit"];
 
     $res_rent = $dbh->query("SELECT * FROM iteh2lb1var7.rent");
     $result= "<table border =`1`><tr><th>Car</th><th>Profit for $date_profit</th><th>Profit from the beginning of the lease to $date_profit </th></tr>";
            
     
     foreach($res_rent as $row) 
     {
       if (($row['Date_start'] <= $date_profit) && ($row['Date_end'] >= $date_profit)){
             
       $sqlSelect = $dbh->prepare("SELECT * FROM iteh2lb1var7.cars WHERE ID_Cars= :FID_Car");
       $sqlSelect->execute((array(':FID_Car' => $row['FID_Car'])));
       $cursor_cars = $sqlSelect->fetchAll();

     foreach($cursor_cars as $cell){  
       $time_all_sec = floatval(strtotime($row['Date_end']) - strtotime($row['Date_start']) + strtotime($row['Time_end'])- strtotime($row['Time_start']));

       $profit_this_day = $row['Cost'] / $time_all_sec * 86400;

       if ($date_profit == $row['Date_start']){
         $profit_this_day = $profit_this_day - (strtotime($row['Time_start']) - strtotime("00:00:00")) * ($row['Cost'] / $time_all_sec);
       }
       else if ($date_profit==$row['Date_end']){
         $profit_this_day = $profit_this_day - ( 86400-strtotime($row['Time_end']) + strtotime("00:00:00")) * ($row['Cost'] / $time_all_sec);
       }

       $before_slctd_date_sec = floatval(strtotime($date_profit) - strtotime($row['Date_start']));
       $profit_before_this_day = $row['Cost'] / $time_all_sec * $before_slctd_date_sec;
       
       $result = $result."<tr><td>{$cell['Name']}</td><td>$profit_this_day</td><td>$profit_before_this_day</td></tr>";
     
       }

       }
           
     }
      
      echo  $result;
      
      
  }    
?>
