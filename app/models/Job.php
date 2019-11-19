<?php

namespace Models;

use Lib\Db;
use Lib\Psql;
use Lib\Functions;
use Lib\Logging;
use Lib\Validate;

class Job
{
    // public static function pushResults($id,$level,$color,$point,$user_id,$tour,$bolim) {
        
    //     $sql = "INSERT INTO points(id,level,color,point,user_id,tour,bolim) 
    //     VALUES(:id,:level,:color,:point,:user_id,:tour,:bolim)";

    //     $neworder = Db::getInstance()->Query($sql,
    //         [
    //             'id'=>$id,
    //             'level'=>$level,
    //             'color'=>$color,
    //             'point'=>$point,
    //             'user_id'=>$user_id,
    //             'tour'=>$tour,
    //             'bolim'=>$bolim
    //         ]
    //     );

    //     if($neworder) {
    //        return $unique_id;
    //     } else {
    //         return false;
    //     }  
    // }
    public static function  getTestResults($user_id) 
    {  
        $getTest = "SELECT * FROM points WHERE user_id = :user_id";

        $getTests = Db::getInstance()->Select_($getTest,
            [
                'user_id' => $user_id
            ], 
        true); 

        if($getTests) {
            return json_encode($getTests);
        }
        else {
            return false;
        }

    }
    public static function  pushTestResult($point,$user_id,$level,$color) 
    { 
        $update = "UPDATE points SET point=:point,color=:color where user_id=:user_id and level=:level";
        $updatePoint =Db::getInstance()->Query($update,
            [
                
                'point' => $point,
                'user_id' => $user_id,
                'level' => $level,
                'color' => $color
            ], 
        false);
            
        return $updatePoint; 
    }
    public static function  insertLatinData($country,$name,$point,$phone) 
    { 
        $check = "SELECT * FROM information WHERE phone = :phone";
        $user = Db::getInstance()->Select_($check,
            [
                'phone' => $phone,
            ], 
        false);
    

        if(!$user) {
            $sql = "INSERT INTO information(country,name,point,unique_id,phone) 
            VALUES(:country,:name,:point,:unique_id,:phone)";

            $unique_id = uniqid("U");
            $neworder = Db::getInstance()->Query($sql,
                [
                    'country' => $country,
                    'name' => $name,
                    'point' => $point,
                    'unique_id' => $unique_id,
                    'phone' => $phone
                ]
            );

            $array = array(
                array(
            
                  "level" => "1_1",
                  "color" => "#e91e63",
                  "point" => "0",
                  "user_id" => "87074252290",
                  "tour" => "0",
                  "bolim" => "I"
                ),
                array(
          
                  "level"=> "1_2",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "1",
                  "bolim"=> "II"
                ),
                array(
             
                  "level"=> "1_3",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "2",
                  "bolim"=> "III"
                ),
                array(
                 
                  "level"=> "1_4",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "3",
                  "bolim"=> "IV"
                ),
                array(
         
                  "level"=> "1_5",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "4",
                  "bolim"=> "V"
                ),
                array(
              
                  "level"=> "2_1",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "5",
                  "bolim"=> "I"
                ),
                array(
            
                  "level"=> "2_2",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "6",
                  "bolim"=> "II"
                ),
                array(
             
                  "level"=> "2_3",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "7",
                  "bolim"=> "III"
                ),
                array(
            
                  "level"=> "2_4",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "8",
                  "bolim"=> "IV"
                ),
                array(
                
                  "level"=> "2_5",
                  "color"=> "#e91e63",
                  "point"=>"0",
                  "user_id"=> "87074252290",
                  "tour"=> "9",
                  "bolim"=> "V"
                ),
                array(
           
                  "level"=> "3_1",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "10",
                  "bolim"=> "I"
                ),
                array(
                
                  "level"=> "3_2",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "11",
                  "bolim"=> "II"
                ),
                array(
              
                  "level"=> "3_3",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "12",
                  "bolim"=> "III"
                ),
                array(
                
                  "level"=> "3_4",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "13",
                  "bolim"=> "IV"
                ),
                array(
                  
                  "level"=> "3_5",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "14",
                  "bolim"=> "V"
                ),
                array(
                  
                  "level"=>"4_1",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "15",
                  "bolim"=> "I"
                ),
                array(
                  
                  "level"=> "4_2",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "16",
                  "bolim"=> "II"
                ),
                array(
              
                  "level"=> "4_3",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "17",
                  "bolim"=> "III"
                ),
                array(
               
                  "level"=> "4_4",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "18",
                  "bolim"=> "IV"
                ),
                array(
              
                  "level"=> "4_5",
                  "color"=> "#e91e63",
                  "point"=> "0",
                  "user_id"=> "87074252290",
                  "tour"=> "19",
                  "bolim"=> "V"
                )
            );

   
            
            for($i=0; $i <sizeof($array); $i++) { 
                $query = "INSERT INTO points(id,level,color,point,user_id,tour,bolim) 
                VALUES(:id,:level,:color,:point,:user_id,:tour,:bolim)";
                    Db::getInstance()->Query($query,
                            [
                                'id' =>'',
                                'level'=>$array[$i]["level"],
                                'color'=>$array[$i]["color"],
                                'point'=>$array[$i]["point"],
                                'user_id'=>$unique_id,
                                'tour'=>$array[$i]["tour"],
                                'bolim'=>$array[$i]["bolim"]
                            ]
                    );
            }
           
            if($neworder) {
               return $unique_id;
            } else {
                return false;
            }  
        }
        else {
            return false;
        }
    }
    public static function  getSignId($phone) 
    { 
        $sql = "SELECT unique_id FROM information WHERE phone = :phone";
        $user = Db::getInstance()->Select($sql,
            [
                'phone' => $phone
            ], 
        false);
        
        return json_encode($user);
    }
    

    public static function  getAllWords() 
    { 
        $sql = "SELECT * FROM slovar";
        $words = Db::getInstance()->Select_($sql,
            [
               
            ], 
        true);
        
        $array = [ 
        ];

        $x = 0;
        $y = 0;
        $p = 10;
    
        $level = 0;

        function setvariable($y) {
            if(0<=$y && $y<5){
                return "word_0";
            } else if(5<=$y && $y<10) {
                return "word_1";
            } else if(10<=$y && $y<15) {
                return "word_2";
            } else if(15<=$y && $y<20) {
                return "word_3";
            }
        }
        while($y<20) {
            $array[setvariable($y)."_".$y] = array();
            while($x<$p) {
                $array[setvariable($y)."_".$y][]=$words[$x];
                $x++;
            }
            $p=$p+10;
            $y++;
        } 
  
        return json_encode($array,JSON_UNESCAPED_UNICODE);
    }
    public static function  getAllOrder() 
    { 
        $sql = "SELECT ordered_person.who,ordered_person.name,ordered_person.adress,ordered_person.comment,
        product_name,amount,cost FROM ordered_person
        INNER JOIN ordered_product ON ordered_product.who = ordered_person.who WHERE ordered_product.who =:who";
        
        $user = Db::getInstance()->Select($sql, [
      
        ]);
        return $user;
    }
    
    public static function  insertOrder($name,$adress,$comment,$who) 
    {
        $sql = "INSERT INTO ordered_person(name,adress,comment,who) 
        VALUES(:name,:adress,:comment,:who)";

        $unique_id = uniqid("W");
        $neworder = Db::getInstance()->Query($sql,
            [
                'name' => $name,
                'adress' => $adress,
                'comment' => $comment,
                'who' => $unique_id
            ]
        );

        

        if($neworder) {
           return $unique_id;
        } else {
            return false;
        }  
    }

    public static function  insertProduct($product_name,$amount,$cost,$who) 
    {
        $sql = "INSERT INTO ordered_product(product_name,amount,cost,who) 
        VALUES(:product_name,:amount,:cost,:who)";

        $newproduct = Db::getInstance()->Query($sql,
            [
                'product_name' => $product_name,
                'amount' => $amount,
                'cost' => $cost,
                'who' => $who
            ]
        );

        if($newproduct) {
           return $newproduct;
        } else {
            return false;
        }  
    }


    public function checkForForgotPassword($iin,$phone,$password) {
        $sql = "SELECT * FROM student_registration WHERE contact_number = :contact_number and iin =:iin";
        $checkExist = Db::getInstance()->Select($sql,
            [
                'iin' => $iin,
                'contact_number' => $phone,
            ], 
        false);
       
        if($checkExist) {
            
            $update = "UPDATE student_table SET password=:password Where iin=:iin";
            $updatePassword =Db::getInstance()->Query($update,
                [
                    
                    'password' => $password,
                    'iin' => $iin
                ], 
            false);
                
            return $updatePassword; 
        }
    }
    public static function  getStatisticsData() 
    {     
        $sql = "SELECT faculty,specialnost, grand_platni, na_baze, language_otdelenie,forma_obuchenie, COUNT(*) AS freq FROM student_registration GROUP BY grand_platni, na_baze, language_otdelenie,forma_obuchenie,specialnost,faculty";
          
        $statistics = Db::getInstance()->Select_($sql,
            [
            ]
        );
       
        return json_encode($statistics,JSON_UNESCAPED_UNICODE );
    }
    public static function  getAllData() 
    {
        
        $sql = "SELECT * from student_registration";
        

        $job = Db::getInstance()->Select_($sql,
            [
                
            ]
        );
        return $job;
    }

    /**
     * @param $user_id
     * @param $password
     * @param $name
     * @param $lastname
     * @param $birthday
     * @param $gender
     * @param null $inviter_id
     * @return bool|\PDOStatement|string
    */
    
    public static function getAllDataStudent($temp_auth)
    { 
        $sql = "SELECT * from student_registration WHERE unique_id =:unique_id and iin =:iin ";

        $job = Db::getInstance()->Select($sql,
            [
                'iin' => $temp_auth->phone,
                'unique_id' => $temp_auth->unique_id 
            ]
        );
        return json_encode($job);
    }
    
    public static function loginData($iin,$password)
    {
        $sql = "SELECT * from student_table WHERE iin = :iin and password = :password ";

        $student_data = "SELECT name,surname,third_name from student_registration WHERE iin = :iin";

        $job = Db::getInstance()->Select($sql,
            [
                'iin' => $iin,
                'password' => $password
            ]
        );

        $student_data = Db::getInstance()->Select($student_data,
        [
            'iin' => $iin,
           
        ]
        );
        function objectToObject($instance, $className) {
            return unserialize(sprintf(
                'O:%d:"%s"%s',
                strlen($className),
                $className,
                strstr(strstr(serialize($instance), '"'), ':')
            ));
        }
        $obj_merged = (object) array_merge( $job, $student_data);
       return (array)$obj_merged;
    }
    public static function registrationData($iin,$password,$unique_id)
    {
        $sq = "SELECT * from student_registration WHERE iin = :iin ";

        $unique_id = Db::getInstance()->Select($sq,
            [
                'iin' => $iin
            ]
        );

        $sql = "INSERT INTO student_table(iin,password,unique_id) 
        VALUES(:iin,:password,:unique_id)";

            $newjob = Db::getInstance()->Query($sql,
                [
                    'iin' => $iin,
                    'password' => $password,
                    'unique_id' => $unique_id['unique_id']
                ]
            );

            $sq = "SELECT * from student_table WHERE iin = :iin ";

            $data = Db::getInstance()->Select($sq,
            [
                'iin' => $iin
            ]
            );

        if($data) {
            return $data;
        } else {
             return false;
        }
    }
    public static function setJobData($product_name,$description,$cost,$ids)
    {
        $sql = "INSERT INTO data(product_name,description,cost,ids) 
        VALUES(:product_name,:description, :cost,:ids)";

        $newjob = Db::getInstance()->Query($sql,
            [
                'product_name' => $product_name,
                'description' => $description,
                'cost' => $cost,
                'ids' => $ids
            ]
        );

        if($newjob) {
           return $newjob;
        } else {
            return false;
        }
    }

    public static function updateData( $surname, $name, $third_name, $date_birth, $gender, $citizenship, $nationality, $family_position, $document_type, $iin, $nomer, 
    $kem_vidan, $kogda_vidan, $srok_deistvie, $zagruzit_udastak, $strana, 
    $adres_projivanie, $adres_propiski, $contact_number, $type_zavedenie, $oblast_zavedenie, $raion_zavedenie, $name_zavedenie, $type_obrazovanie, 
    $date_vidachi_obr, $seria_document, $nomer_document, $uslovno_zachislen,
     $zagruzit_obr, $number_certificate, $seria_certificate, $date_certificate, $zagruzit_certificate, $nomer_svidetelstva, $zagruzit_svidetelstva, $serpin, $deti_siroti, 
     $invalid_pervi, $invalid_vtoroi, $invalid_sdetstva, $kvota_invalidam, $selskaya_kvota, $kvota_negrajdan, 
     $pob_mej_olimp, $pob_resp_olimp, $znak_altin, $atestat_osobo, $pob_mej_nau, $pob_resp_nau,
      $pob_mej_sport, $pob_gorod_nau, $pob_gorod_olimp, $pob_obl_nau_konkurs, $pob_obl_olimp, $pob_mej_vistavki, $uroven_obuchenie, 
     $stupen_obuchenie, $forma_obuchenie, $language_otdelenie, $faculty, $specialnost,$who_registered,$data_about_who, $grand_platni,$proverenni,$unique_id,$comment)
     {
        $sql = "UPDATE student_registration SET 
                surname=:surname,
                name=:name,
                third_name=:third_name,
                date_birth=:date_birth,
                gender=:gender,
                citizenship=:citizenship,
                nationality=:nationality,
                family_position=:family_position,
                document_type=:document_type,
                iin=:iin,
                nomer=:nomer,
                kem_vidan=:kem_vidan,
                kogda_vidan=:kogda_vidan,
                srok_deistvie=:srok_deistvie,
                zagruzit_udastak=:zagruzit_udastak,
                strana=:strana,
                adres_projivanie=:adres_projivanie,
                adres_propiski=:adres_propiski,
                contact_number=:contact_number,
                type_zavedenie=:type_zavedenie,
                oblast_zavedenie=:oblast_zavedenie,
                raion_zavedenie=:raion_zavedenie,
                name_zavedenie=:name_zavedenie,
                type_obrazovanie=:type_obrazovanie,
                date_vidachi_obr=:date_vidachi_obr,
                seria_document=:seria_document,
                nomer_document=:nomer_document,uslovno_zachislen=:uslovno_zachislen,zagruzit_obr=:zagruzit_obr,number_certificate=:number_certificate,seria_certificate=:seria_certificate,date_certificate=:date_certificate,zagruzit_certificate=:zagruzit_certificate,nomer_svidetelstva=:nomer_svidetelstva,zagruzit_svidetelstva=:zagruzit_svidetelstva,serpin=:serpin,
                deti_siroti=:deti_siroti,invalid_pervi=:invalid_pervi,invalid_vtoroi=:invalid_vtoroi,invalid_sdetstva=:invalid_sdetstva,kvota_invalidam=:kvota_invalidam,selskaya_kvota=:selskaya_kvota,kvota_negrajdan=:kvota_negrajdan,pob_mej_olimp=:pob_mej_olimp,pob_resp_olimp=:pob_resp_olimp,znak_altin=:znak_altin,atestat_osobo=:atestat_osobo,
                pob_mej_nau=:pob_mej_nau,pob_resp_nau=:pob_resp_nau,pob_mej_sport=:pob_mej_sport,pob_gorod_nau=:pob_gorod_nau,pob_gorod_olimp=:pob_gorod_olimp,pob_obl_nau_konkurs=:pob_obl_nau_konkurs,pob_obl_olimp=:pob_obl_olimp,pob_mej_vistavki=:pob_mej_vistavki,uroven_obuchenie=:uroven_obuchenie,stupen_obuchenie=:stupen_obuchenie,forma_obuchenie=:forma_obuchenie,
                language_otdelenie=:language_otdelenie,faculty=:faculty,specialnost=:specialnost,who_registered=:who_registered,data_about_who=:data_about_who,grand_platni=:grand_platni,
                proverenni=:proverenni,
                comment=:comment
        WHERE unique_id = :unique_id";


        $update = Db::getInstance()->Query($sql, [
            'surname'=>$surname, 
            'name'=>$name, 
            'third_name'=>$third_name, 
            'date_birth'=>$date_birth,
            'gender'=>$gender, 
            'citizenship'=>$citizenship, 
            'nationality'=>$nationality, 
            'family_position'=>$family_position, 
            'document_type'=>$document_type, 
            'iin'=>$iin, 
            'nomer'=>$nomer, 
            'kem_vidan'=>$kem_vidan, 
            'kogda_vidan'=>$kogda_vidan, 
            'srok_deistvie'=>$srok_deistvie, 
            'zagruzit_udastak'=>$zagruzit_udastak, 
            'strana'=>$strana, 
            'adres_projivanie'=>$adres_projivanie, 
            'adres_propiski'=>$adres_propiski, 
            'contact_number'=>$contact_number, 
            'type_zavedenie'=>$type_zavedenie, 
            'oblast_zavedenie'=>$oblast_zavedenie, 
            'raion_zavedenie'=>$raion_zavedenie, 
            'name_zavedenie'=>$name_zavedenie, 
            'type_obrazovanie'=>$type_obrazovanie, 
            'date_vidachi_obr'=>$date_vidachi_obr, 
            'seria_document'=>$seria_document, 
            'nomer_document'=>$nomer_document, 'uslovno_zachislen'=>$uslovno_zachislen, 'zagruzit_obr'=>$zagruzit_obr, 'number_certificate'=>$number_certificate, 'seria_certificate'=>$seria_certificate, 'date_certificate'=>$date_certificate, 'zagruzit_certificate'=>$zagruzit_certificate, 'nomer_svidetelstva'=>$nomer_svidetelstva, 'zagruzit_svidetelstva'=>$zagruzit_svidetelstva, 'serpin'=>$serpin, 
            'deti_siroti'=>$deti_siroti, 'invalid_pervi'=>$invalid_pervi, 'invalid_vtoroi'=>$invalid_vtoroi,'invalid_sdetstva'=>$invalid_sdetstva, 'kvota_invalidam'=>$kvota_invalidam, 'selskaya_kvota'=>$selskaya_kvota, 'kvota_negrajdan'=>$kvota_negrajdan, 'pob_mej_olimp'=>$pob_mej_olimp, 'pob_resp_olimp'=>$pob_resp_olimp, 'znak_altin'=>$znak_altin, 'atestat_osobo'=>$atestat_osobo, 
            'pob_mej_nau'=>$pob_mej_nau, 'pob_resp_nau'=>$pob_resp_nau, 'pob_mej_sport'=>$pob_mej_sport, 'pob_gorod_nau'=>$pob_gorod_nau, 'pob_gorod_olimp'=>$pob_gorod_olimp, 'pob_obl_nau_konkurs'=> $pob_obl_nau_konkurs, 'pob_obl_olimp'=>$pob_obl_olimp, 'pob_mej_vistavki'=>$pob_mej_vistavki, 'uroven_obuchenie'=>$uroven_obuchenie, 'stupen_obuchenie'=>$stupen_obuchenie, 'forma_obuchenie'=>$forma_obuchenie, 
            'language_otdelenie'=>$language_otdelenie, 'faculty'=>$faculty, 'specialnost'=>$specialnost, 'who_registered'=>$who_registered, 'data_about_who'=>$data_about_who, 'grand_platni'=>$grand_platni,
            'proverenni' =>$proverenni,
            'unique_id'=>$unique_id,
            'comment'=>$comment
        ]);

        return $update ? true:false;
     }
     /**
     * @param $user_id
     * @param $password
     * @param $name
     * @param $lastname
     * @param $birthday
     * @param $gender
     * @param null $inviter_id
     * @return bool|\PDOStatement|string
     */
    public static function insertallData( $surname, $name, $third_name, $date_birth, $gender, $citizenship, $nationality, $family_position, $document_type, $iin, $nomer, 
    $kem_vidan, $kogda_vidan, $srok_deistvie, $zagruzit_udastak, $strana, 
    $adres_projivanie, $adres_propiski, $contact_number, $type_zavedenie, $oblast_zavedenie, $raion_zavedenie, $name_zavedenie, $type_obrazovanie, 
    $date_vidachi_obr, $seria_document, $nomer_document, $uslovno_zachislen,
     $zagruzit_obr, $number_certificate, $seria_certificate, $date_certificate, $zagruzit_certificate, $nomer_svidetelstva, $zagruzit_svidetelstva, $serpin, $deti_siroti, 
     $invalid_pervi, $invalid_vtoroi, $invalid_sdetstva, $kvota_invalidam, $selskaya_kvota, $kvota_negrajdan, 
     $pob_mej_olimp, $pob_resp_olimp, $znak_altin, $atestat_osobo, $pob_mej_nau, $pob_resp_nau,
      $pob_mej_sport, $pob_gorod_nau, $pob_gorod_olimp, $pob_obl_nau_konkurs, $pob_obl_olimp, $pob_mej_vistavki, $uroven_obuchenie, 
     $stupen_obuchenie, $forma_obuchenie, $language_otdelenie, $faculty, $specialnost,$who_registered,$data_about_who, $grand_platni,$proverenni,$unique_id,$comment,$na_baze)
    {


    $sql = "INSERT INTO student_registration(surname, name, third_name, date_birth, gender, 
    citizenship,nationality, family_position, document_type, iin, nomer, 
    kem_vidan, kogda_vidan, srok_deistvie, zagruzit_udastak, strana, adres_projivanie,
     adres_propiski, contact_number, type_zavedenie, oblast_zavedenie, raion_zavedenie, 
     name_zavedenie, type_obrazovanie, date_vidachi_obr, seria_document, nomer_document, uslovno_zachislen, zagruzit_obr, 
     number_certificate, seria_certificate, date_certificate, zagruzit_certificate, nomer_svidetelstva,zagruzit_svidetelstva, 
     serpin, deti_siroti, invalid_pervi, invalid_vtoroi, invalid_sdetstva, kvota_invalidam, selskaya_kvota, kvota_negrajdan, pob_mej_olimp, 
     pob_resp_olimp, znak_altin, atestat_osobo, pob_mej_nau, pob_resp_nau, pob_mej_sport, pob_gorod_nau, pob_gorod_olimp,
    pob_obl_nau_konkurs, pob_obl_olimp, pob_mej_vistavki, uroven_obuchenie, stupen_obuchenie, forma_obuchenie, 
    language_otdelenie, faculty, specialnost, who_registered, data_about_who,grand_platni,proverenni,unique_id,comment,na_baze)
     VALUES(
    :surname, :name, :third_name, :date_birth, :gender, :citizenship, :nationality, :family_position, :document_type, 
    :iin, :nomer, :kem_vidan, :kogda_vidan, :srok_deistvie, :zagruzit_udastak, :strana, 
    :adres_projivanie, :adres_propiski, :contact_number, :type_zavedenie, :oblast_zavedenie,:raion_zavedenie, :name_zavedenie, 
    :type_obrazovanie, :date_vidachi_obr, :seria_document, :nomer_document, :uslovno_zachislen,
    :zagruzit_obr, :number_certificate, :seria_certificate, :date_certificate, :zagruzit_certificate, :nomer_svidetelstva, 
    :zagruzit_svidetelstva, :serpin, :deti_siroti, :invalid_pervi, :invalid_vtoroi, :invalid_sdetstva, :kvota_invalidam, 
    :selskaya_kvota, :kvota_negrajdan, :pob_mej_olimp, :pob_resp_olimp, :znak_altin, :atestat_osobo,
    :pob_mej_nau, :pob_resp_nau, :pob_mej_sport, :pob_gorod_nau, :pob_gorod_olimp, :pob_obl_nau_konkurs, :pob_obl_olimp, 
    :pob_mej_vistavki, :uroven_obuchenie, :stupen_obuchenie, :forma_obuchenie, :language_otdelenie, :faculty, :specialnost,
    :who_registered,:data_about_who,:grand_platni,:proverenni,:unique_id,:comment,:na_baze)";

        $newjob = Db::getInstance()->Query($sql,
            [
                'surname'=>$surname, 
                'name'=>$name, 
                'third_name'=>$third_name, 
                'date_birth'=>$date_birth,
                'gender'=>$gender, 
                'citizenship'=>$citizenship, 
                'nationality'=>$nationality, 
                'family_position'=>$family_position, 
                'document_type'=>$document_type, 
                'iin'=>$iin, 
                'nomer'=>$nomer, 
                'kem_vidan'=>$kem_vidan, 
                'kogda_vidan'=>$kogda_vidan, 
                'srok_deistvie'=>$srok_deistvie, 
                'zagruzit_udastak'=>$zagruzit_udastak, 
                'strana'=>$strana, 
                'adres_projivanie'=>$adres_projivanie, 
                'adres_propiski'=>$adres_propiski, 
                'contact_number'=>$contact_number, 
                'type_zavedenie'=>$type_zavedenie, 
                'oblast_zavedenie'=>$oblast_zavedenie, 
                'raion_zavedenie'=>$raion_zavedenie, 
                'name_zavedenie'=>$name_zavedenie, 
                'type_obrazovanie'=>$type_obrazovanie, 
                'date_vidachi_obr'=>$date_vidachi_obr, 
                'seria_document'=>$seria_document, 
                'nomer_document'=>$nomer_document, 'uslovno_zachislen'=>$uslovno_zachislen, 'zagruzit_obr'=>$zagruzit_obr, 'number_certificate'=>$number_certificate, 'seria_certificate'=>$seria_certificate, 'date_certificate'=>$date_certificate, 'zagruzit_certificate'=>$zagruzit_certificate, 'nomer_svidetelstva'=>$nomer_svidetelstva, 'zagruzit_svidetelstva'=>$zagruzit_svidetelstva, 'serpin'=>$serpin, 
                'deti_siroti'=>$deti_siroti, 'invalid_pervi'=>$invalid_pervi, 'invalid_vtoroi'=>$invalid_vtoroi,'invalid_sdetstva'=>$invalid_sdetstva, 'kvota_invalidam'=>$kvota_invalidam, 'selskaya_kvota'=>$selskaya_kvota, 'kvota_negrajdan'=>$kvota_negrajdan, 'pob_mej_olimp'=>$pob_mej_olimp, 'pob_resp_olimp'=>$pob_resp_olimp, 'znak_altin'=>$znak_altin, 'atestat_osobo'=>$atestat_osobo, 
                'pob_mej_nau'=>$pob_mej_nau, 'pob_resp_nau'=>$pob_resp_nau, 'pob_mej_sport'=>$pob_mej_sport, 'pob_gorod_nau'=>$pob_gorod_nau, 'pob_gorod_olimp'=>$pob_gorod_olimp, 'pob_obl_nau_konkurs'=> $pob_obl_nau_konkurs, 'pob_obl_olimp'=>$pob_obl_olimp, 'pob_mej_vistavki'=>$pob_mej_vistavki, 'uroven_obuchenie'=>$uroven_obuchenie, 'stupen_obuchenie'=>$stupen_obuchenie, 'forma_obuchenie'=>$forma_obuchenie, 
                'language_otdelenie'=>$language_otdelenie, 'faculty'=>$faculty, 'specialnost'=>$specialnost, 'who_registered'=>$who_registered, 'data_about_who'=>$data_about_who, 'grand_platni'=>$grand_platni,
                'proverenni' =>$proverenni,
                'unique_id' => uniqid('U'),
                'comment' => $comment,
                'na_baze' => $na_baze
   
            ]
        );
        $sql = "SELECT unique_id FROM student_registration WHERE iin = :iin ";

        $unique_id = Db::getInstance()->Select($sql,
            [
                'iin' => $iin
            ]
        );

        if($newjob) {
           return $unique_id;
        } else {
            return false;
        }
    }



    public static function getJobData($ids)
    {
        $sql = "SELECT product_name,description, cost from data WHERE ids = :ids ";

        $job = Db::getInstance()->Select($sql,
            [
                'ids' => $ids
            ]
        );
        return $job;
    }

    public static function searchJobData(
        $surname, $name, $third_name, $date_birth, $gender, $citizenship, $nationality, $family_position, $document_type, $iin, $nomer, 
        $kem_vidan, $kogda_vidan, $srok_deistvie, $zagruzit_udastak, $strana, 
        $adres_projivanie, $adres_propiski, $contact_number, $type_zavedenie, $oblast_zavedenie, $raion_zavedenie, $name_zavedenie, $type_obrazovanie, 
        $date_vidachi_obr, $seria_document, $nomer_document, $uslovno_zachislen,
        $zagruzit_obr, $number_certificate, $seria_certificate, $date_certificate, $zagruzit_certificate, $nomer_svidetelstva, $zagruzit_svidetelstva, $serpin, $deti_siroti, 
        $invalid_pervi, $invalid_vtoroi, $invalid_sdetstva, $kvota_invalidam, $selskaya_kvota, $kvota_negrajdan, 
        $pob_mej_olimp, $pob_resp_olimp, $znak_altin, $atestat_osobo, $pob_mej_nau, $pob_resp_nau,
        $pob_mej_sport, $pob_gorod_nau, $pob_gorod_olimp, $pob_obl_nau_konkurs, $pob_obl_olimp, $pob_mej_vistavki, $uroven_obuchenie, 
        $stupen_obuchenie, $forma_obuchenie, $language_otdelenie, $faculty, $specialnost,$who_registered,$data_about_who,$grand_platni,$proverenni
    )
        
    {
     
        $sql = "SELECT 
           surname, name, third_name, date_birth, gender, 
    citizenship,nationality, family_position, document_type, iin, nomer, 
    kem_vidan, kogda_vidan, srok_deistvie, zagruzit_udastak, strana, adres_projivanie,
     adres_propiski, contact_number, type_zavedenie, oblast_zavedenie, raion_zavedenie, 
     name_zavedenie, type_obrazovanie, date_vidachi_obr, seria_document, nomer_document, uslovno_zachislen, zagruzit_obr, 
     number_certificate, seria_certificate, date_certificate, zagruzit_certificate, nomer_svidetelstva,zagruzit_svidetelstva, 
     serpin, deti_siroti, invalid_pervi, invalid_vtoroi, invalid_sdetstva, kvota_invalidam, selskaya_kvota, kvota_negrajdan, pob_mej_olimp, 
     pob_resp_olimp, znak_altin, atestat_osobo, pob_mej_nau, pob_resp_nau, pob_mej_sport, pob_gorod_nau, pob_gorod_olimp,
    pob_obl_nau_konkurs, pob_obl_olimp, pob_mej_vistavki, uroven_obuchenie, stupen_obuchenie, forma_obuchenie, 
    language_otdelenie, faculty, specialnost, who_registered, data_about_who, grand_platni,proverenni from student_registration
            WHERE 
                (surname is null or surname LIKE :surname) 
                and (name is null or  name LIKE :name)
                and (third_name is null or third_name LIKE :third_name)  
                and (date_birth is null or  date_birth LIKE :date_birth)
                and (gender is null or gender LIKE :gender)
                and (citizenship is null or citizenship LIKE :citizenship)
                and (nationality is null or nationality LIKE :nationality)
                and (family_position is null or family_position LIKE :family_position)
                and (document_type is null or document_type LIKE :document_type)
                and (iin is null or iin LIKE :iin)
                and (nomer is null or  nomer LIKE :nomer)
                and (kem_vidan is null or kem_vidan LIKE :kem_vidan)
                and (kogda_vidan is null or  kogda_vidan LIKE :kogda_vidan)
                and (srok_deistvie is null or srok_deistvie LIKE :srok_deistvie)
                and (zagruzit_udastak is null or zagruzit_udastak LIKE :zagruzit_udastak)
                and (strana is null or strana LIKE :strana)
                and (adres_projivanie is null or adres_projivanie LIKE :adres_projivanie)
                and (adres_propiski is null or adres_propiski LIKE :adres_propiski)
                and (contact_number is null or contact_number LIKE :contact_number)
                and (type_zavedenie is null or type_zavedenie LIKE :type_zavedenie)
                and (oblast_zavedenie is null or oblast_zavedenie LIKE :oblast_zavedenie)
                and (raion_zavedenie is null or raion_zavedenie LIKE :raion_zavedenie)
                and (name_zavedenie is null or name_zavedenie LIKE :name_zavedenie)
                and (type_obrazovanie is null or type_obrazovanie LIKE :type_obrazovanie)
                and (date_vidachi_obr is null or date_vidachi_obr LIKE :date_vidachi_obr)
                and (seria_document is null or seria_document LIKE :seria_document )
                and (nomer_document is null or  nomer_document LIKE :nomer_document)
                and (uslovno_zachislen is null or uslovno_zachislen LIKE :uslovno_zachislen)
                and (zagruzit_obr is null or zagruzit_obr LIKE :zagruzit_obr)
                and (number_certificate is null or number_certificate LIKE :number_certificate)
                and (seria_certificate is null or seria_certificate LIKE :seria_certificate)
                and (date_certificate is null or date_certificate LIKE :date_certificate)
                and (zagruzit_certificate is null or zagruzit_certificate LIKE :zagruzit_certificate)
                and (nomer_svidetelstva is null or nomer_svidetelstva LIKE :nomer_svidetelstva)
                and (zagruzit_svidetelstva is null or zagruzit_svidetelstva LIKE :zagruzit_svidetelstva)
                and (serpin is null or serpin LIKE :serpin)
                and (deti_siroti is null or  deti_siroti LIKE :deti_siroti)
                and (invalid_pervi is null or invalid_pervi LIKE :invalid_pervi)
                and (invalid_vtoroi is null or invalid_vtoroi LIKE :invalid_vtoroi)
                and (invalid_sdetstva is null or invalid_sdetstva LIKE :invalid_sdetstva)
                and (kvota_invalidam is null or kvota_invalidam LIKE :kvota_invalidam)
                and (selskaya_kvota is null or selskaya_kvota LIKE :selskaya_kvota)
                and (kvota_negrajdan is null or kvota_negrajdan LIKE :kvota_negrajdan)
                and (pob_mej_olimp is null or pob_mej_olimp LIKE :pob_mej_olimp)
                and (pob_resp_olimp is null or pob_resp_olimp LIKE :pob_resp_olimp)
                and (znak_altin is null or znak_altin LIKE :znak_altin)
                and (atestat_osobo is null or atestat_osobo LIKE :atestat_osobo)
                and (pob_mej_nau is null or pob_mej_nau LIKE :pob_mej_nau)
                and (pob_resp_nau is null or pob_resp_nau LIKE :pob_resp_nau)
                and (pob_mej_sport is null or pob_mej_sport LIKE :pob_mej_sport)
                and (pob_gorod_nau is null or pob_gorod_nau LIKE :pob_gorod_nau)
                and (pob_gorod_olimp is null or pob_gorod_olimp LIKE :pob_gorod_olimp)
                and (pob_obl_nau_konkurs is null or pob_obl_nau_konkurs LIKE :pob_obl_nau_konkurs)
                and (pob_obl_olimp is null or pob_obl_olimp LIKE :pob_obl_olimp)
                and (pob_mej_vistavki is null or pob_mej_vistavki LIKE :pob_mej_vistavki)
                and (uroven_obuchenie is null or uroven_obuchenie LIKE :uroven_obuchenie)
                and (stupen_obuchenie is null or stupen_obuchenie LIKE :stupen_obuchenie)
                and (forma_obuchenie is null or forma_obuchenie LIKE :forma_obuchenie)
                and (language_otdelenie is null or language_otdelenie LIKE :language_otdelenie)
                and (faculty is null or faculty LIKE :faculty)
                and (specialnost is null or specialnost LIKE :specialnost)
                and (who_registered is null or who_registered LIKE :who_registered)
                and (data_about_who is null or data_about_who LIKE :data_about_who)
                and (grand_platni is null or grand_platni LIKE :grand_platni)
                and (proverenni is null or proverenni LIKE :proverenni)
                
                ";

        $job = Db::getInstance()->Select_($sql,
            [
                'surname'=>"%$surname%", 
                'name'=>"%$name%", 
                'third_name'=>"%$third_name%", 
                'date_birth'=>"%$date_birth%",
                 'gender'=>"%$gender%", 
                 'citizenship'=>"%$citizenship%", 
                 'nationality'=>"%$nationality%", 
                 'family_position'=>"%$family_position%", 
                 'document_type'=>"%$document_type%", 
                 'iin'=>"%$iin%", 
                 'nomer'=>"%$nomer%", 
                 'kem_vidan'=>"%$kem_vidan%", 
                 'kogda_vidan'=>"%$kogda_vidan%", 
                 'srok_deistvie'=>"%$srok_deistvie%", 
                 'zagruzit_udastak'=>"%$zagruzit_udastak%", 
                'strana'=>"%$strana%", 
                'adres_projivanie'=>"%$adres_projivanie%", 
                'adres_propiski'=>"%$adres_propiski%", 
                'contact_number'=>"%$contact_number%", 
                'type_zavedenie'=>"%$type_zavedenie%", 
                'oblast_zavedenie'=>"%$oblast_zavedenie%", 
                'raion_zavedenie'=>"%$raion_zavedenie%", 
                'name_zavedenie'=>"%$name_zavedenie%", 
                'type_obrazovanie'=>"%$type_obrazovanie%", 
                'date_vidachi_obr'=>"%$date_vidachi_obr%", 
                'seria_document'=>"%$seria_document%", 
                'nomer_document'=>"%$nomer_document%", 'uslovno_zachislen'=>"%$uslovno_zachislen%", 'zagruzit_obr'=>"%$zagruzit_obr%", 'number_certificate'=>"%$number_certificate%", 'seria_certificate'=>"%$seria_certificate%", 'date_certificate'=>"%$date_certificate%", 'zagruzit_certificate'=>"%$zagruzit_certificate%", 'nomer_svidetelstva'=>"%$nomer_svidetelstva%",  'zagruzit_svidetelstva'=>"%$zagruzit_svidetelstva%", 'serpin'=>"%$serpin%", 
                'deti_siroti'=>"%$deti_siroti%", 'invalid_pervi'=>"%$invalid_pervi%", 'invalid_vtoroi'=>"%$invalid_vtoroi%",'invalid_sdetstva'=>"%$invalid_sdetstva%", 'kvota_invalidam'=>"%$kvota_invalidam%", 'selskaya_kvota'=>"%$selskaya_kvota%", 'kvota_negrajdan'=>"%$kvota_negrajdan%", 'pob_mej_olimp'=>"%$pob_mej_olimp%", 'pob_resp_olimp'=>"%$pob_resp_olimp%", 'znak_altin'=>"%$znak_altin%", 'atestat_osobo'=>"%$atestat_osobo%", 
                'pob_mej_nau'=>"%$pob_mej_nau%", 'pob_resp_nau'=>"%$pob_resp_nau%", 'pob_mej_sport'=>"%$pob_mej_sport%", 'pob_gorod_nau'=>"%$pob_gorod_nau%", 'pob_gorod_olimp'=>"%$pob_gorod_olimp%", 'pob_obl_nau_konkurs'=> "%$pob_obl_nau_konkurs%", 'pob_obl_olimp'=>"%$pob_obl_olimp%", 'pob_mej_vistavki'=>"%$pob_mej_vistavki%", 'uroven_obuchenie'=>"%$uroven_obuchenie%", 'stupen_obuchenie'=>"%$stupen_obuchenie%", 'forma_obuchenie'=>"%$forma_obuchenie%", 
                'language_otdelenie'=>"%$language_otdelenie%", 'faculty'=>"%$faculty%", 'specialnost'=>"%$specialnost%", 'who_registered'=>"%$who_registered%", 'data_about_who'=>"%$data_about_who%",
                'grand_platni'=>"%$grand_platni%", 'proverenni' =>"%$proverenni%"
                
            ]
        );
        return $job;
    }
    
}