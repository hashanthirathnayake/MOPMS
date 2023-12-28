<?php
    require_once('../incl/dbconnection.php');

  
      
    // $empId = $_POST['empId'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $designation = $_POST['designation'];
    $emp_jdate = $_POST['join_date'];
    $address = $_POST['address'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $status = $_POST['status'];
   
    

    $sql = "INSERT INTO employee2 ( emp_fname, emp_lname, emp_desig, emp_jdate, emp_address,emp_nic,emp_email,emp_contact_no,emp_status) 
    VALUES ('$fname','$lname','$designation','$emp_jdate','$address','$nic','$email','$contact_no','$status')";

    // echo $sql;


    $result = mysqli_query($con,$sql);

    if($result) {
        echo "success";
    } else {
        echo "error";
    }



    
$type = $_GET["type"];

switch($type) {
    case "getEmployees":
        
        $offset = $_POST['start']; //start point in the current data set
        $limit = $_POST['length']; //Number of records that the table can display in the current draw.
        $search= $_POST['search'];
        $columns = $_POST['columns']; //all columns in the table
        $order = $_POST['order'];
        $ord_col_id= $order['0']['column']; //an array defining the number of columns  being ordered upon along with their ids
        $ord_dir = $order['0']['dir']; //Ordering direction for the columns
        $search_str = $search['value'];
        
        $search_query="";
        if($search_str != "")
            {
                $search_query.= " WHERE(emp_fname LIKE '%{$search_str}%')";
            }
        
        $ord_column = $columns[$ord_col_id]['data'];
        $order_by = " ORDER BY {$ord_column} ".$ord_dir;
        
        $sql="SELECT COUNT(id) FROM datatables".$search_query;
        $d_result = mysqli_query($con, $sql);
        $rec = mysqli_fetch_row($d_result);
        $count = 0;
        if(isset($rec[0])){
            $count = $rec[0];
        }
        
        $sql = "SELECT * FROM datatables".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
        $result = mysqli_query($con,$sql);
        
        $data = array();
        $ajax_response = array();
        
        if(mysqli_num_rows($result) > 0 ){
            while($row = mysqli_fetch_assoc($result)){
               $tmp = array(
                   //colmn names db 
                'name'=>$row["name"],
                
               );
               array_push($data,$tmp);
            }
        }
        
        // Returned data
            $ajax_response['data'] = $data;
            $ajax_response['draw'] = $_POST['draw'];
            $ajax_response['recordsTotal'] = $count; //Total records, before filtering (i.e. the total number of records in the database)
            $ajax_response['recordsFiltered'] = $count; //Total records, after filtering 
        
            echo json_encode($ajax_response);


        break;

        
    
    case "get_product_details":
        $id = $_POST["id"];
        $sql = "SELECT * from products WHERE product_id='$id'";
        $result = mysqli_query($con,$sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
        break;

}
?>