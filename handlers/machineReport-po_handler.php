<?php
  
    require_once('../incl/dbconnection.php');

    $type = $_GET["type"];

    switch($type) {
       case "retrieveReportDetails":
        $sql = "SELECT mc. mac_config_id  AS NO,pl.plant_name AS PLANT_NAME, m.`mac_name` AS MACHINE_NAME,p.pro_name AS PRODUCT_NAME, 
        mc.mac_min_qty AS MIN_QTY, mc.mac_max_qty_per_day AS MAX_QTY
        FROM machine_config3 mc
        LEFT JOIN  machine3  m  ON mc.`mac_id`=m.`mac_id`
        LEFT  JOIN product3 p ON p.`pro_code`=mc.`pro_code` 
        LEFT JOIN plant pl ON pl.`plant_no`=m.`plant_no`  ";
        $result = mysqli_query($con,$sql);
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    
    break;

    case "retrieve":
        

        
        $offset=$_POST['start'];
            $limit=$_POST['length'];
            $search=$_POST['search'];
            $columns=$_POST['columns'];
            $order=$_POST['order'];
            $ord_col_id=$order['0']['column'];
            $ord_dir=$order['0']['dir'];
            $search_str=$search['value'];

            $search_query='';

             if($search_str!=""){      //coumn name - db
                $search_query.=" WHERE(mac_name LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT mc. mac_config_id  AS NO,pl.plant_name AS PLANT_NAME, m.`mac_name` AS MACHINE_NAME,p.pro_name AS PRODUCT_NAME, 
           mc.mac_min_qty AS MIN_QTY, mc.mac_max_qty_per_day AS MAX_QTY
           FROM machine_config3 mc
           LEFT JOIN  machine3  m  ON mc.`mac_id`=m.`mac_id`
           LEFT  JOIN product3 p ON p.`pro_code`=mc.`pro_code` 
           LEFT JOIN plant pl ON pl.`plant_no`=m.`plant_no` ".$search_query;
            // $sql="SELECT COUNT(mac_id) FROM machine INNER JOIN employee2 ON machine.emp_no= employee2.emp_no".$search_query;


            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }

            // $sql="SELECT machine.mac_id,machine.mac_name,machine.mac_min_qty,machine.mac_max_qty_per_day,machine.mac_status,machine.mac_availability,CONCAT (employee2.emp_fname ,' ',employee2.emp_lname) AS employee_name
            // FROM machine INNER JOIN employee2 ON machine.emp_no = employee2.emp_no ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            

           $sql="SELECT mc. mac_config_id  AS NO,pl.plant_name AS PLANT_NAME, m.`mac_name` AS MACHINE_NAME,p.pro_name AS PRODUCT_NAME, 
           mc.mac_min_qty AS MIN_QTY, mc.mac_max_qty_per_day AS MAX_QTY
           FROM machine_config3 mc
           LEFT JOIN  machine3  m  ON mc.`mac_id`=m.`mac_id`
           LEFT  JOIN product3 p ON p.`pro_code`=mc.`pro_code` 
           LEFT JOIN plant pl ON pl.`plant_no`=m.`plant_no`   ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            $result=mysqli_query($con,$sql);                                                                            

      

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(
                   
                     
                        'mac_config_id'=>$row['NO'],
                        'plant_no'=>$row['PLANT_NAME'],
                        'mac_id'=>$row['MACHINE_NAME'],
                       
                        'pro_code'=>$row['PRODUCT_NAME'],
                        'mac_min_qty'=>$row['MIN_QTY'],
                        'mac_max_qty_per_day'=>$row['MAX_QTY'],
                       
                      
                    );
                    array_push($data,$tmp);
                }
            }

            $ajax_response['data']= $data;
            $ajax_response['draw']= $_POST['draw'];
            $ajax_response['recordsTotal']=$count;
            $ajax_response['recordsFiltered']=$count;

            echo json_encode($ajax_response);
            break;
    }

    

?>