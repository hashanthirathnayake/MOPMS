
<?php
require_once('../incl/dbconnection.php');

$type = $_GET["type"];

switch($type) {


    case "loadEditForm": 
        $productCode = $_POST['id'];
        
        $sql = "select * from product3 where pro_code = '$productCode'";
        
        $result = mysqli_query($con,$sql);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode($data);
    break;  
        

    case "saveProduct":
        
        $data = array();
        
    

            $productCode = $_POST['productCode'];  
            $productCatName = $_POST['productCatName'];    
            $productName = $_POST['productName'];   
            // $productType = $_POST['productType']; 
            $productDescription = $_POST['productDescription'];   
           
            $productUnitPrice = $_POST['productUnitPrice'];   
            $productWastage = $_POST['productWastage'];   
            
            $productStatus = $_POST['productStatus'];  
            // $productImage = $_POST['productImage']; 
            $mode = $_POST['mode'];

        $has_errors = FALSE;
        $error_messages = array();
        
                    // form txt box name
        if($productName == '' || $productName == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'pro name is required');
        }
        if($productUnitPrice == '' || $productUnitPrice == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'unit price is required');
        }


        if($productWastage == '' || $productWastage == NULL){
            $has_errors = TRUE;
            array_push($error_messages,'wastage is required');
        }

    
        if($has_errors == TRUE)
        {
            echo json_encode($error_messages);
        }
        
        else{     
            //pro_stock


            if($mode == "add"){



                // file upload
            $target_dir = "../uploads/"; //path of the folder that stores uploded imgs
            $target_file = $target_dir . basename($_FILES["productImage"]["name"]); //name of the text box (img upload) and img name
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $file_name = basename($_FILES["productImage"]["name"]);

                if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {




                $sql = "INSERT INTO product3 (pro_cat_code,pro_name,pro_des, pro_unit_price, pro_wastage,pro_status,pro_image) 
                VALUES ('$productCatName','$productName','$productDescription','$productUnitPrice','$productWastage','$productStatus','$file_name')";


        //$target_file is used instead of $productImage
                $result = mysqli_query($con,$sql);

                            if($result) {
                                //echo "success";

                                array_push($data, "success"); //0
                            }
                             else {
                                echo "error";
                            }


                            //echo "The file ". htmlspecialchars(basename( $_FILES["productImage"]["name"])). " has been uploaded.";
                        }

                        else {
                            echo "Sorry, there was an error uploading your file."; 
                        }

            //  }

    }




    // else if($mode="edit"){
        else if($mode="edit"){
        $sql = "update product3 set pro_cat_code='$productCatName',pro_name = '$productName', pro_des='$productDescription', pro_unit_price='$productUnitPrice', 
        pro_wastage='$productWastage', pro_status = '$productStatus',pro_image='$target_file' where pro_code = '$productCode'  ";

        $result = mysqli_query($con,$sql);

        echo $sql;

        if($result) {
            echo "success";
        } else {
            echo "error";
        }



    }
                                                                            
        }
            //  {
            //     echo "Sorry, there was an error uploading your file."; 
            // }
        
        array_push($data, $mode); //1
        
        echo json_encode($data);
    break;

    case "getProductCategory": 
           $sql = "SELECT * FROM product_category";
           $result = mysqli_query($con,$sql);
           while($row = mysqli_fetch_assoc($result)) {
             $data[] = $row;
            }
            echo json_encode($data);
    break; 

    
    

    case "retrieveProduct":
        
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
                $search_query.=" WHERE(pro_name LIKE '%{$search_str}%')";
            }

            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;

            $sql="SELECT COUNT(pro_code) FROM product3 ".$search_query;
            $c_result=mysqli_query($con, $sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;

            if(isset($rec[0])){
                $count=$rec[0];
            }

            $sql="SELECT p.pro_code,pc.pro_cat_name,p.pro_name ,  p.pro_des,p.pro_unit_price, p.pro_wastage,p.pro_status,p.pro_image
            FROM product3 p LEFT JOIN product_category  pc ON p.`pro_cat_code`=pc.`pro_cat_code` ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            $result=mysqli_query($con,$sql);

            $data=array();
            $ajax_response=array();

            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){

                    $tmp=array(

                     
                        'pro_code'=>$row['pro_code'],
                        'pro_cat_name'=>$row['pro_cat_name'],   // for product  cat des
                        
                        'pro_name'=>$row['pro_name'],
                       
                        // 'pro_type'=>$row['pro_type'],
                        'pro_des'=>$row['pro_des'],
                        
                        'pro_unit_price'=>$row['pro_unit_price'],
                        // 'pro_stock'=>$row['pro_stock'],
                        
                        // 'pro_image'=>$row['pro_image'],
                        'pro_wastage'=>$row['pro_wastage'],
                        'pro_status'=>$row['pro_status'],
                        'pro_image'=>$row['pro_image'],
                        'pro_code'=>$row['pro_code']    //option column

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

        // case "deleteProduct":

        //     $pro_code= $_POST[''];
            
           
        //     // $sql="DELETE FROM product WHERE pro_code=$pro_code";       for delete permenntly from DB

        //     $sql = "UPDATE product3  SET pro_status=FALSE WHERE pro_code=$pro_code";
        //     $result = mysqli_query($con, $sql);

        //     if($result) {
        //         echo "deleted";
        //     }
        // break;



        case "deleteProduct":
   
            $pro_code= $_POST['pro_code'];
            
            $sql = "UPDATE product3  SET pro_status=FALSE WHERE pro_code=$pro_code";

       

            $result = mysqli_query($con, $sql);

            if($result) {
                echo "deleted";
            }
            break;



        
        case "viewProduct":

            $pro_code = $_POST["pro_code"];
            
            $sql = "SELECT p.*, pc.pro_cat_name, 
                    case 
                        when p.pro_status = 0 then 'Disabled' 
                        when p.pro_status = 1 then 'Active' 
                        else '' 
                        end as status_label 
                    FROM product3 p 
                    left join product_category pc on p.pro_cat_code = pc.pro_cat_code 
                    where 
                    p.pro_code = '$pro_code'";
    
            $result = mysqli_query($con,$sql);
            
            while($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            
            echo json_encode($data);
        break; 
}

?>
