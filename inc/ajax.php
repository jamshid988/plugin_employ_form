<?php


add_action('wp_ajax_employ_user_delete','employ_user_delete');

add_action('wp_ajax_emoloy_user_selected','emoloy_user_selected');



function employ_user_delete(){



    global $wpdb,$table_prefix;




    if(isset($_POST['eid'])){

        $eid=$_POST['eid'];

        $exist_product=$wpdb->get_row("select * from {$table_prefix}employ_form where id=$eid ");

        if(empty($exist_product)){
            $message=array('text'=>" این کاربر وجود ندارد  ",'result'=>"0");

            die(json_encode($message));
        }







        $del= $wpdb->query("delete from {$table_prefix}employ_form where id=$eid ");




        if($del==0) {
            $message=array('text'=>" مشکلی در پاک کردن کاربر به وجود آمده  ",'result'=>"0");

            die(json_encode($message));
        }











            if(!empty($exist_product->doc_url)){



                if(file_exists(EMPLOY_DOC_DIR . $exist_product->doc_url)){


                    unlink(EMPLOY_DOC_DIR . $exist_product->doc_url);

                }
            }





            $message=array('text'=>"این سالن با موفقیت پاک شد .",'result'=>'1');

            die(json_encode($message));

        }
}

//end function


function emoloy_user_selected(){

    global $wpdb,$table_prefix;




    if(isset($_POST['eid'])){

        $eid=$_POST['eid'];

        $exist_product=$wpdb->get_row("select * from {$table_prefix}employ_form where id=$eid ");

        if(empty($exist_product)){
            $message=array('text'=>" این کاربر وجود ندارد  ",'result'=>"0");

            die(json_encode($message));
        }







        $toggle= $wpdb->query("update {$table_prefix}employ_form set `bookmark`=NOT bookmark where id=$eid ");




        if($toggle==0) {
            $message=array('text'=>" مشکلی در تغییر وضعیت  کاربر به وجود آمده است . ",'result'=>"0");

            die(json_encode($message));
        }







        $message=array('text'=>"تغییر وضعیت با موفقیت انجام شد .",'result'=>'1');

        die(json_encode($message));

    }



}













