<?php
   
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {
    case "addPlant":
        
      

            $plantNo = $_POST['plantNo'];  
            $plantName = $_POST['plantName'];    
            $plantContactNo = $_POST['plantContactNo'];
           
          
            $plantStatus = $_POST['plantStatus'];
            $plantAvailability = $_POST['plantAvailability'];

        $has_errors = FALSE;
        $error_messages = array();
        
                    // form txt box name
        if($plantName == '' || $plantName == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Username is required');
        }

        if($plantContactNo == '' || $plantContactNo == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'Password is required');
        }
        
       
    
        if($has_errors == TRUE)
        {
            echo json_encode($error_messages);
        }
        
        else{     

          
            $sql = "INSERT INTO plant ( plant_name,plant_contact_no,plant_status,plant_avilability) 
            VALUES ('$plantName','$plantContactNo','$plantStatus','$plantAvailability')";

            $result = mysqli_query($con,$sql);

            echo $sql;

            if($result) {
                echo "success";
            } else {
                echo "error";
            }

        }
    break;
    
    // case "getUserCategory": 
    //        $sql = "SELECT * FROM user_category";
    //        $result = mysqli_query($con,$sql);
    //         while($row = mysqli_fetch_assoc($result)) {
    //             $data[] = $row;
    //         }
    //         echo json_encode($data);
    // break; 

    case "retrievePlant":
        
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
                $search_query.=" WHERE(plant_name LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(plant_no) FROM plant".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }

            $sql="SELECT * FROM plant".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(

               

                        'plant_no'=>$row['plant_no'],
                        'plant_name'=>$row['plant_name'],
                        'plant_contact_no'=>$row['plant_contact_no'],
                        'plant_status'=>$row['plant_status'],
                        'plant_availability'=>$row['plant_availability'],
                        
                        'plant_no'=>$row['plant_no']   // last entry has no comma
                      

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

        case "deletePlant":

            $plant_no= $_POST['plant_no'];
            
            $sql = "DELETE FROM plant WHERE plant_no=$plant_no";
            $result = mysqli_query($con, $sql);

            if($result) {
                echo "deleted";
            }
        break;
}

?>


