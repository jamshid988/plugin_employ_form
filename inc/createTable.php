<?php

function employ_create_table()
{
    global $wpdb , $table_prefix;






    $query = "CREATE TABLE {$table_prefix}employ_form (
    `id` int(12) NOT NULL AUTO_INCREMENT,
  `name_user` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `family_user` varchar(40) COLLATE utf8_persian_ci NOT NULL,
  `experience_user` varchar(4) COLLATE utf8_persian_ci NOT NULL,
  `national_code` varchar(10) COLLATE utf8_persian_ci NOT NULL,
  `doc_url` varchar(60) COLLATE utf8_persian_ci NOT NULL,
  `bookmark` tinyint(1)  NOT NULL,
    `timestamp` varchar(60) COLLATE utf8_persian_ci NOT NULL,
    


  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci";








        $resquery = $wpdb->query($query);

        if($resquery===0){
            die('مشکل در نصب پلاگین');
        }



}