<?php

add_shortcode("employ_form","wp_employ_form");




add_action( 'wp_enqueue_scripts', 'my_template_employ_style' );




function my_template_employ_style(){

    wp_register_style('my_template_employ_style',EMPLOY_URL_CSS . "style.css");

    wp_enqueue_style("my_template_employ_style");

}


function wp_employ_form()
{

    if (isset($_POST['sub_employ'])) {




        session_start();

        echo"<div id='container_employ_form'>";

        $name_user =   CheckOut_name_employ($_POST['name_user'],'نام');


        $family_user=   CheckOut_name_employ($_POST['family_user'],'نام خانوادگی');


        $experience_user = CheckOut_experiecne_employ($_POST['experience_user']);


        $nationalcode =  verify_employ_nationalcode($_POST['nationalcode']);


//        var_dump($_SESSION["captcha"]);

//        var_dump($_POST["captcha_employ"]);

        if(!isset($_POST["captcha_employ"]) or  empty($_POST["captcha_employ"])){
            die('کد امنیتی را وارد کنید');
        }

            if($_POST["captcha_employ"]!=$_SESSION["captcha"])
            {
                die('<div class="error_message_employ">' . 'کد امنیتی را اشتباه وارد کرده اید. دوباره تلاش کنید' . '</div>');

            }

        $file_name = upload_file_emoloy($_FILES['resume_user'],'رزومه');




        //end if(!isset($_POST["captcha_employ"]) or  empty($_POST["captcha_employ"]))


        $time_stamp_create=time();

        register_employ_user($name_user, $family_user, $experience_user, $nationalcode, $file_name, $time_stamp_create);




        echo"</div>";

        }




    //end if

    else {


        ?>
        <form method="post" id="employ_form" enctype='multipart/form-data'>
            <table>
                <tr>

                    <td><label for="name_user"> نام :</label></td>
                    <td><input type="text" id="name_user" name="name_user"></td>

                </tr>

                <tr>
                    <td><label for="family_user"> نام خانوادگی :</label></td>
                    <td><input type="text" id="family_user" name="family_user"></td>
                </tr>


                <tr>
                    <td><label for="experience_user"> میزان تجربه کاری(سال) :</label></td>
                    <td><input type="number" id="experience_user" name="experience_user"></td>
                </tr>

                <tr>
                    <td><label for="nationalcode"> کد ملی :</label></td>
                    <td><input type="text" id="nationalcode" name="nationalcode"></td>
                </tr>

                <tr>
                    <td><label for="resume_user">آپلود فایل رزومه :</label></td>
                    <td><input type="file" id="resume_user" name="resume_user"></td>
                </tr>


                <tr>
                    <td><img src=<?php echo EMPLOY_URL_INC . "captcha.php" ?> ></td>
                    <td><input type="text" id="captcha_employ" name="captcha_employ"></td>
                </tr>


                <tr>
                    <td colspan='2'><input type="submit" name="sub_employ" value=" ارسال "></td>

                </tr>


            </table>

        </form>
        <?php
    }
    //end else( if isset('$_POST['sub_employ']) )

}
//end function wp_employ_form



















