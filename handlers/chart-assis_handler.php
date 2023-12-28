
<?php
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {


    case "orderIncome": 
        // $productCode = $_POST['id'];
        
        $sql = "select MONTHNAME(ord_place_date) AS 'Month', sum(ord_net_total) AS 'TotalIncome' from tbl_orders3 
                where YEAR(ord_place_date) = YEAR(CURDATE()) 
                group by MONTHNAME(ord_place_date) order by ord_place_date";
        
        $result = mysqli_query($con,$sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        
        echo json_encode($data);
    break;
        
    case "loadStatistics": 
        $orderCount=0;
        $machineCount = 0;
        $productCount = 0;
        $plantCount=0;


          //today orders 
          $sql = "SELECT ord_place_date,COUNT(0) as ORDER_COUNT FROM tbl_orders3 
          WHERE ord_place_date =DATE(CURDATE())";
          $result = mysqli_query($con,$sql);
          
          $row = mysqli_fetch_assoc($result);
          
          $orderCount = $row['ORDER_COUNT'];
          
          $data["orderCount"] = $orderCount;
        
        //start counting machines
        $sql = "select count(0) as MAC_COUNT from machine3 where mac_status = 1";
        $result = mysqli_query($con,$sql);
        
        $row = mysqli_fetch_assoc($result);
        
        $machineCount = $row['MAC_COUNT'];
        
        $data["machineCount"] = $machineCount;
        
        //start counting products

        $sql = "select count(0) as PRO_COUNT from product3 where pro_status = 1";
        $result = mysqli_query($con,$sql);
        
        $row = mysqli_fetch_assoc($result);
        
        $productCount = $row['PRO_COUNT'];
        
        $data["productCount"] = $productCount;
        

        //counting plants
        

        $sql = "select count(0) as PLANT_COUNT from plant where plant_status = 1";
        $result = mysqli_query($con,$sql);
        
        $row = mysqli_fetch_assoc($result);
        
        $productCount = $row['PLANT_COUNT'];
        
        $data["plantCount"] = $productCount;
        


        
        echo json_encode($data);
    break;  
        
     
    
    case "machineInPlant": 
        // $productCode = $_POST['id'];
        
        $sql = "SELECT COUNT(m.`mac_id`) AS NO_OF_MACHINE ,pl.plant_name AS PLANT_NAME
       
        FROM machine3  m
       
        LEFT JOIN plant pl ON pl.`plant_no`=m.`plant_no`  GROUP BY pl.plant_name";
        
        $result = mysqli_query($con,$sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        
        echo json_encode($data);
    break;


    case "productCategory": 
        $sql = "SELECT pro_cat_name  AS categoryName, COUNT(pro_code)  AS noOfProducts FROM product_category LEFT JOIN product3
        ON product_category .pro_cat_code=product3.`pro_cat_code` GROUP BY pro_cat_name";

        
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)) {
          $data[] = $row;
         }
         echo json_encode($data);
    break; 





    case "totDogs":
        $sql = "SELECT COUNT(dog_id) AS tot_dogs  FROM dog WHERE dog_reg_status=1";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);   
    break;


    case "totProducts":
        $sql = "SELECT COUNT(pro_code) AS tot_products  FROM product3 WHERE pro_status=1";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);   
    break;


 
     




   
}

?>


