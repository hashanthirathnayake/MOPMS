<?php

        case "filter":

            $from=$_POST['from'];
            $to=$_POST['to'];

            $offset=$_POST['start'];
            $limit=$_POST['length'];
            $search=$_POST['search'];
            $columns=$_POST['columns'];
            $order=$_POST['order'];
            $ord_col_id=$order['0']['column'];
            $ord_dir=$order['0']['dir'];
            $search_str=$search['value'];
    
            $search_query='';
    
            if($search_str!=""){
                $search_query.=" AND ('reserved_from' LIKE '%{$search_str}%')";
            }
    
            $ord_column=$columns[$ord_col_id]['data'];
            $order_by=" ORDER BY {$ord_column} ".$ord_dir;
    
            // $sql="SELECT COUNT(empCal_time_start) FROM docappointment INNER JOIN empcal ON docappointment.`empCal_id`=empcal.`empCal_id` WHERE apt_paidStatus=1
            //  AND DATE(empCal_time_start) BETWEEN '$from' AND '$to' GROUP BY DATE(empCal_time_start)".$search_query;

            $sql="SELECT COUNT(ms.reserved_from) FROM machine_schedule3 ms LEFT JOIN machine3 m  ON ms.mac_id=m.mac_id WHERE mac_sche_status='1'
            AND DATE(ms.reserved_from) BETWEEN '$from' AND '$to' GROUP BY DATE(ms.reserved_from)".$search_query;

            $c_result=mysqli_query($conn,$sql);
            $rec=mysqli_fetch_row($c_result);
            $count=0;
    
            if(isset($rec[0])){
                $count=$rec[0];
            }
    
            // $sql="SELECT DATE(empCal_time_start) AS 'date',COUNT(apt_id) AS 'aptCount',SUM(org_fee) AS 'orgTot',SUM(doc_fee) AS 'docTot',SUM(apt_fee) AS 'tot' FROM docappointment INNER JOIN empcal ON docappointment.`empCal_id`=empcal.`empCal_id` WHERE apt_paidStatus=1 AND DATE(empCal_time_start) BETWEEN '$from' AND '$to' GROUP BY DATE(empCal_time_start)".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            

            $sql="SELECT ms.mac_sche_id, ms.ord_detail_id, ms.mac_id,m.mac_name,ms.reserved_from, ms.reserved_to
            FROM machine_schedule3 ms
            LEFT JOIN machine3 m
            ON ms.mac_id=m.mac_id where mac_sche_status='1' ".$search_query.$order_by." LIMIT ".$offset.",".$limit."";
            
            
            $result=mysqli_query($conn,$sql);
   
            $data=array();
            $ajax_response=array();
    
            if(mysqli_num_rows($result)>0){
    
                while($row=mysqli_fetch_assoc($result)){
    
                    $tmp=array(
                        'mac_sche_id'=>$row['mac_sche_id'],
                        'ord_detail_id'=>$row['ord_detail_id'],
                        'mac_id'=>$row['mac_id'],
                        'mac_name'=>$row['mac_name'],
                        'reserved_from'=>$row['reserved_from'],
                        'reserved_to'=>$row['reserved_to']
                      
                        // 
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

?>

