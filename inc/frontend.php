<?php


function upload_file_emoloy($arfiles,$type_file)
{

    if (!isset($arfiles['name']) or empty($arfiles['name'])) {
        die(' فایل ' . $type_file . ' ارسال نشده است .');
        $file_name = '';
        $rand = md5(rand(1, 10000000000));
    } else {

        if ($arfiles['size'] > 10000000) {
            die('حجم فایل نباید از 10MB بیشتر باشد ');
        }

        $file_name = $arfiles['name'];
        $namara = explode('.', $file_name);
        $type = end($namara);

        do {

            $rand = md5(rand(1, 10000000000));
            $file_name = "fil" . $rand . ".$type";

        } while (file_exists(EMPLOY_DOC_DIR . "$file_name"));


        $target_path = EMPLOY_DOC_DIR . $file_name;

        if (!is_dir(EMPLOY_DOC_DIR)) {

            mkdir(EMPLOY_DOC_DIR);


        }

        if (move_uploaded_file($arfiles['tmp_name'], $target_path)) {

            chmod($target_path, 0644);

//                echo "فایل " . $file_name . " با موفقیت آپلود شد" . "<br>";

        } else {
            echo "متاسفانه مشکلی در حین عملیات آپلود فایل رخ داد،لطفا مجددا امتحان کنید";
            echo "<br>";
            die($_FILES['resume_user']['error']);


        }

    }

    return $file_name;

}
// end function

function CheckOut_name_employ($nameuser,$type_name){

    if(isset($nameuser)){

        $name_user=   employ_security($nameuser);

        verify_name_employ($name_user,$type_name);

    }

    else{
        die('مشخصات را کامل وارد کنید');
    }

    return $name_user;

}
//end function CheckOut_name_employ


function CheckOut_experiecne_employ(){
    if(isset($_POST['experience_user'])){

        $experience_user=  employ_security($_POST['experience_user']);

        if(empty($experience_user)){
            die('میزان سابقه نمیتواند خالی باشد');
        }


        if(!(preg_match('/^[0-9]+$/', $experience_user) )){

            die('سابقه را به صورت  درست  وارد کنید');
        }

        if($experience_user>=100){
            die('این مقدار منطقی نیست');
        }





    }//end if

    else{
        die('میزان سابقه خود را وارد کنید');
    }

    return $experience_user;


}
//end function CheckOut_experiecne_employ()





function employ_security($value){

    global $wpdb;

    $safe=trim(strip_tags($value));

    $safe=$wpdb->escape($safe);

    return $safe;

}
//end function employ_security


function verify_name_employ($name_user,$type_name){



    if(empty($name_user)){
        die($type_name . ' نمی تواند خالی باشد');
    }

    if(strlen($name_user)<=2 or strlen($name_user)>30){
        die(' تعداد کاراکترهای  ' . $type_name .' مجاز نمی باشد ');
        }

    if(  !(preg_match('/^[A-Za-z\s ]+$/', $name_user) or preg_match('/^[آپچجحخهعغفقثصضشسیبلاتنمکگوئدذرزطظژؤءئ إأءًٌٍَُِّ\s]+$/u', $name_user))){

        die($type_name . " را درست وارد کنید ");

    }


}
//end function verify_name_employ



function verify_employ_nationalcode($national_code){
    if(!isset($national_code)){
        die('کد ملی باید وارد شود');
    }
    if(empty($national_code)){
        die ("در تابع اعتبار سنجی کد ملی باید مقدار وارد شود . " );
    }
    $length_str=  strlen($national_code);

    if($length_str!=10){
        die('<div class="error_message_employ">'.'کد ملی باید 10 رقم باشد  .'.'</div>');
    }

    $sum_char=0;
    for ($i=1;$i<$length_str;$i++){
        $sum_char = (($national_code{$i-1})*(($length_str+1)-$i))+$sum_char;
    }

    $remaining =$sum_char % 11;
    if($remaining<2){
        if($national_code{9}==$remaining){
            return $national_code;
        }
        else{
            die('<div class="error_message_employ">'.'کد ملی نامعتبر می باشد .'.'</div>');
        }

    }

    else if($remaining>=2){

        $number_controll=11-$remaining;

        if($number_controll == $national_code{9}){
            return $national_code;
        }

        else {
            die('<div class="error_message_employ">'.'کد ملی نامعتبر می باشد .'.'</div>');

        }
    }

}
//end function verify_employ_nationalcode


function register_employ_user($name_user, $family_user, $experience_user, $nationalcode,  $file_name, $time_stamp_create){

    global $wpdb,$table_prefix;


    $exist = $wpdb->get_row("select `id` from {$table_prefix}employ_form WHERE `national_code`='$nationalcode' ");

    if($exist){
        die('<div class="error_message_employ">' . 'کاربر با این کد ملی قبلا در سیستم ثبت شده است .' . '</div>');
    }

   $result = $wpdb->query("insert into {$table_prefix}employ_form(`name_user`,`family_user`,`experience_user`,`national_code`,`doc_url`,`timestamp`)
VALUES ('$name_user','$family_user','$experience_user','$nationalcode','$file_name','$time_stamp_create')");

   if($result==0){
       die('مشکلی در ذخیره اطلاعات به وجود آمده است');
   }

   else{
       echo"<div id='success_employ'>
ثبت مشخصات با موفقیت انجام شد
</div>";
   }



}