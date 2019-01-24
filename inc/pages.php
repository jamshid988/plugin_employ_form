<?php

function employ_manage_page()
{
    global $wpdb, $table_prefix;


    if (isset($_GET['view'])) {


        $eid = $_GET['view'];

        $exist_emoloy = $wpdb->get_row("select * from {$table_prefix}employ_form where id=$eid ");

        if (empty($exist_emoloy)) {

            die('<div class="error_message_employ">' . 'این کاربر وجود ندارد ' . '</div>');
        }

        echo "
            <h2>نام :</h2>
        
            <div>$exist_emoloy->name_user </div>
            
            <h2>  نام خانوادگی :</h2>
            <div>$exist_emoloy->family_user </div>
            
            <h2>میزان سابقه ی کاری :</h2>
            <div>$exist_emoloy->experience_user </div>
            
            <h2>کدملی :</h2>
            <div>$exist_emoloy->national_code </div>
            
            <h2>  فایل رزومه : </h2>
            <div><a href=" . EMPLOY_URL_DOC . "$exist_emoloy->doc_url > 
            دانلود فایل  رزومه
             </a> 
            </div>
            
            
            ";


    } else {


        ?>
        <div id="wp_employ_loader"> لطفا صبر کنید ...</div>

        <table id="table-manage-employ">
            <tr>
                <th> نام</th>
                <th> نام خانوادگی</th>
                <th> میزان سابقه کار</th>
                <th> کد ملی</th>
                <th> دانلود</th>
                <th> عملیات</th>
                <th> برگزیده</th>
            </tr>

        <?php
        $forms = $wpdb->get_results("select * from {$table_prefix}employ_form ORDER BY `timestamp` DESC ");

        foreach ($forms as $form) {

            echo "    <tr>
   
   <td> $form->name_user   </td>
   <td> $form->family_user </td>
   <td> $form->experience_user </td>
   <td>$form->national_code </td>
   <td><a href=" . EMPLOY_URL_DOC . "$form->doc_url>
    فایل  رزومه
    </a></td>
    ";
            $uri_first = $_SERVER['REQUEST_URI'];
            $aruri = explode('&', $uri_first);
            $uri_view = $aruri[0] . "&view=$form->id";


            echo "
   
       <td>
         <div class='icon_employ'><a href='#' class='employ_user_delete' title='حذف' data-id='$form->id'><img src=" . EMPLOY_URL_IMG . "delete.png ></a></div>
  <div class='icon_employ'> <a href='$uri_view' style='margin-top: 10px' class='employ_user_view' title='مشاهده' data-id='$form->id'><img src=" . EMPLOY_URL_IMG . "view.png ></a> </div>
       </td>
       ";

            echo " <td class='favorite-user'> <input type='checkbox' class='emoloy_user_selected' value='$form->bookmark' ";
            if($form->bookmark!=0)echo' checked ';
            echo" data-id='$form->id' /> </td>";


        }


    }

}

//end function






function employ_bookmarks_page(){

    global $wpdb, $table_prefix;


    if (isset($_GET['view'])) {


        $eid = $_GET['view'];

        $exist_emoloy = $wpdb->get_row("select * from {$table_prefix}employ_form where id=$eid ");

        if (empty($exist_emoloy)) {

            die('<div class="error_message_employ">' . 'این کاربر وجود ندارد ' . '</div>');
        }

        echo "
            <h2>نام :</h2>
        
            <div>$exist_emoloy->name_user </div>
            
            <h2>  نام خانوادگی :</h2>
            <div>$exist_emoloy->family_user </div>
            
            <h2>میزان سابقه ی کاری :</h2>
            <div>$exist_emoloy->experience_user </div>
            
            <h2>کدملی :</h2>
            <div>$exist_emoloy->national_code </div>
            
            <h2>  فایل رزومه : </h2>
            <div><a href=" . EMPLOY_URL_DOC . "$exist_emoloy->doc_url > 
            دانلود فایل  رزومه
             </a> 
            </div>
            
            
            ";


    } else {


        ?>
        <div id="wp_employ_loader"> لطفا صبر کنید ...</div>

        <table id="table-manage-employ">
            <tr>
                <th> نام</th>
                <th> نام خانوادگی</th>
                <th> میزان سابقه کار</th>
                <th> کد ملی</th>
                <th> دانلود</th>
                <th> عملیات</th>
                <th> برگزیده</th>
            </tr>

        <?php
        $forms = $wpdb->get_results("select * from {$table_prefix}employ_form where `bookmark`=1 ORDER BY `timestamp` DESC ");

        foreach ($forms as $form) {

            echo "    <tr>
   
   <td> $form->name_user   </td>
   <td> $form->family_user </td>
   <td> $form->experience_user </td>
   <td>$form->national_code </td>
   <td><a href=" . EMPLOY_URL_DOC . "$form->doc_url>
    فایل  رزومه
    </a></td>
    ";
            $uri_first = $_SERVER['REQUEST_URI'];
            $aruri = explode('&', $uri_first);
            $uri_view = $aruri[0] . "&view=$form->id";


            echo "
   
       <td>
         <div class='icon_employ'><a href='#' class='employ_user_delete' title='حذف' data-id='$form->id'><img src=" . EMPLOY_URL_IMG . "delete.png ></a></div>
  <div class='icon_employ'> <a href='$uri_view' style='margin-top: 10px' class='employ_user_view' title='مشاهده' data-id='$form->id'><img src=" . EMPLOY_URL_IMG . "view.png ></a> </div>
       </td>
       ";

            echo " <td class='favorite-user'> <input type='checkbox' class='emoloy_user_selected' value='$form->bookmark' ";
            if($form->bookmark!=0)echo' checked ';
            echo" data-id='$form->id' /> </td>";


        }


    }

}