  
<?php
   
   require_once('../incl/dbconnection.php');
   
   $type = $_GET["type"];
   
   switch($type) {
      
       
       
   
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
                   $search_query.=" WHERE(available_qty LIKE '%{$search_str}%' or pro_name LIKE '%{$search_str}%' )";
               }
   
               $ord_column=$columns[$ord_col_id]['data'];
               $order_by=" ORDER BY {$ord_column} ".$ord_dir;
   
               $sql="SELECT s.stock_id, p.pro_code,pro_name, s.available_qty,s.actual_qty FROM stock3 s
               LEFT JOIN product3 p ON  s.pro_code=p.pro_code ".$search_query;
               $c_result=mysqli_query($con, $sql);
               $rec=mysqli_fetch_row($c_result);
               $count=0;
   
               if(isset($rec[0])){
                   $count=$rec[0];
               }
   
            //    $sql="SELECT stock_id, pro_code,available_qty,actual_qty FROM stock3 ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
           
        $sql=" SELECT s.stock_id, p.pro_code,p.pro_name, s.available_qty,s.actual_qty FROM stock3 s
        LEFT JOIN product3 p ON  s.pro_code=p.pro_code ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
               $result=mysqli_query($con,$sql);
   
            //    echo($sql);
               $data=array();
               $ajax_response=array();
           
            $count = mysqli_num_rows($result);
   
               if(mysqli_num_rows($result)>0){
   
                   while($row=mysqli_fetch_assoc($result)){
   
                       $tmp=array(
   
                                                                      
                           'stock_id'=>$row['stock_id'],
                           'pro_code'=>$row['pro_code'],
                           'pro_name'=>$row['pro_name'],
                           'available_qty'=>$row['available_qty'],
                           'actual_qty'=>$row['actual_qty'],
                           
                        //    'pro_cat_code'=>$row['pro_cat_code']    //option colmn
   
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