<?php
  
    require_once('../incl/dbconnection.php');

    $type = $_GET["type"];

    switch($type) {
       case "retrieveReportDetails":
        $sql = "SELECT d.deli_id AS NO, v.veh_no,v.veh_type, CONCAT(e.emp_fname,'  ', e.emp_lname) AS employee_name, d.start_date, d.end_date, d.status
        FROM delivery4	d
        LEFT JOIN vehicle  v ON  v.veh_id =d .veh_id
        LEFT JOIN employee2 e ON e.`emp_no`=d.`emp_no`  ";
        // $sql = "SELECT YEAR(ord_place_date) 
        // AS 'Year',MONTH(ord_place_date) AS 'Month',COUNT(ord_id) 
        // AS 'num of orders',SUM(ord_net_total) AS 'Total Income' FROM order_report GROUP BY YEAR(ord_place_date)";

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
                $search_query.=" WHERE(employee_name LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            // $sql="SELECT count(d.deli_id) AS NO, v.veh_no,v.veh_type, CONCAT(e.emp_fname,'  ', e.emp_lname) AS employee_name, d.start_date, d.end_date, d.status
            // FROM delivery4	d
            // LEFT JOIN vehicle  v ON  v.veh_id =d .veh_id
            // LEFT JOIN employee2 e ON e.`emp_no`=d.`emp_no` ".$search_query;
            // $sql="SELECT COUNT(d.deli_id) AS NO, v.veh_no,v.veh_type, CONCAT(e.emp_fname,'  ', e.emp_lname) AS employee_name, d.start_date, d.end_date, d.status
            // FROM delivery4	d
            // LEFT JOIN vehicle  v ON  v.veh_id =d .veh_id
            // LEFT JOIN employee2 e ON e.`emp_no`=d.`emp_no` ".$search_query;
             $sql="SELECT CONCAT(emp_fname,'  ', emp_lname) AS employee_name  FROM employee2   ".$search_query;


            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }


                 
        // $sql="SELECT * from order_report ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
           
        // $sql="SELECT p3.pro_code,pc.pro_cat_name,p3.pro_name,p3.pro_des,p3.pro_unit_price FROM product3  p3 INNER JOIN product_category  pc
        // ON p3.`pro_cat_code`=pc.`pro_cat_code` ORDER BY pc.`pro_cat_code` ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
        
        
       
        $sql="SELECT d.deli_id AS NO, v.veh_no,v.veh_type, CONCAT(e.emp_fname,'  ', e.emp_lname) AS employee_name, d.start_date, d.end_date, d.status
        FROM delivery4	d
        LEFT JOIN vehicle  v ON  v.veh_id =d .veh_id
        LEFT JOIN employee2 e ON e.`emp_no`=d.`emp_no`  ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";

        // ORDER BY product.`pro_cat_code`
            $result=mysqli_query($con,$sql);                                                                            

      

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(
                   
                    //  
                        'NO'=>$row['NO'],
                        'veh_no'=>$row['veh_no'],
                     
                        'veh_type'=>$row['veh_type'],
                        'employee_name'=>$row['employee_name'],
                        'start_date'=>$row['start_date'],
                        'end_date'=>$row['end_date'],
                        'status'=>$row['status']
                      
                      
                    


                      
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
