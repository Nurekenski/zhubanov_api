<?php

namespace Controllers;

use Models\Signup;

use Models\Job;

use Models\Avatar;

use Lib\Validate;
use Lib\Functions;



class SignupController extends Controller
{
 
    public function getOrder($request, $response, $args = [])
    {
        $name = $this->getParam('name');
        $adress = $this->getParam('adress');
        $comment = $this->getParam('comment');
        $who = $this->getParam('who');


        $insertOrder = Job::insertOrder($name,$adress,$comment,$who);
        
        if ($insertOrder){
            $this->success(OK, ['message' => 'Successfully inserted']);   
        }
        else {
            return $this->error(BAD_REQUEST, NOT_UPDATED, "not inserted");
        }
    }

    public function getOrderProduct($request, $response, $args = [])
    {
        $product_name = $this->getParam('product_name');
        $amount = $this->getParam('amount');
        $cost = $this->getParam('cost');
        $who = $this->getParam('who');


        $insertOrder = Job::insertProduct($product_name,$amount,$cost,$who);
        
        if ($insertOrder){
            $this->success(OK, ['message' => 'Successfully inserted']);   
        }
        else {
            return $this->error(BAD_REQUEST, NOT_UPDATED, "not inserted");
        }
    }


    public function forgotPassword($request, $response, $args = [])
    {

        $iin = $this->getParam('iin');
        $phone = $this->getParam('phone');
        $password = $this->getParam('password');

     
        $getStatistics = Job::checkForForgotPassword($iin,$phone,$password);
        
        if ($getStatistics){
            $this->success(OK, ['message' => 'UPDATED']);   
        }
        else {
            return $this->error(BAD_REQUEST, NOT_UPDATED, "NOT UPDATED");
        }
    }   
    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed 
     * @throws \Exception
     */

    public function getStatistics($request, $response, $args = [])
    {
        //   $is_auth = $request->getAttribute('is_auth');
        //   if($is_auth) {
              $getStatistics = Job::getStatisticsData();
              return $getStatistics;
        //   }
    }
    public function registration($request, $response, $args = [])
    {
        // $temp_auth= $request->getAttribute('temp_auth');
        $surname = $this->getParam('surname');
        $name = $this->getParam('name');
        $third_name = $this->getParam('third_name');
        // $photo = $_FILES['photo']['tmp_name'];
        // $imgContent = addslashes(file_get_contents($photo));
        
       
        $is_auth = $request->getAttribute('temp_auth');
        $user_id = $is_auth->user_id;
        
        $photo = $_FILES['photo'];
        
        $photo = new Avatar($photo);
        
        if (!$photo->checkType()){
            return $this->error(BAD_REQUEST, AVATAR_ERROR, "The file extension must be JPG, JPEG or PNG");
        }
        if (!$photo->save()){
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded");
        }

        
        // $new_url = \Models\Avatar::addPhoto($user_id,$surname,$name,$third_name,$photo->name);
        
        // dd($new_url);
        if(!$new_url){
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Avatar not uploaded");
        }

        return $this->success(OK,
            [
                'message' => 'Avatar successfully uploaded',
                'link' => ACCOUNT_SERVER . $new_url
            ]
        );   
    }
    public function getData($request, $response, $args = [])
    {
        $temp_auth = $request->getAttribute('is_auth');
        if($temp_auth) {
           
            $getdata = Job::getAllData();
            return json_encode($getdata);
        }
        else {
            return false;
        }
    }

    public function editData($request, $response, $args = [])
    {
        $temp_auth = $request->getAttribute('is_auth');
        
        $status = 0;
        if($temp_auth) {
           
            $getdata = Job::Update($status);
            return json_encode($getdata);
        }
        else {
            return false;
        }
    }

     /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     * @throws \Exception
     */
    public function createJob($request, $response, $args = [])
    {
        $product_name = $this->getParam('product_name');
        $description = $this->getParam('description');
        $cost = $this->getParam('cost');
        $ids = $this->getParam('ids');

        $insert_data = Job::setJobData($product_name,$description,$cost,$ids);
        if($insert_data){
            $this->success(OK, ['message' => 'Inserted']);   
        }
        else{
            return false;
        }
        // $user = Validate::checkUserExist($phone);

        // if($user['password']) {
        //     return $this->error(BAD_REQUEST, USER_EXIST, "Phone exist");
        // }
        // else {
        //     return Functions::sendSMS($phone) ? $this->success(OK,
        //     ['message' => 'Your successfully registered. Please confirm you phone']) : $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Server error. SMS not sent");   
        
    }

    public function insertData_all($request, $response, $args = []) {
    
 
        $surname = Functions::checkNull($this->getParam('surname'));  $name= Functions::checkNull($this->getParam('name'));  $third_name = Functions::checkNull($this->getParam('third_name')); $date_birth= Functions::checkNull($this->getParam('date_birth'));  $gender= Functions::checkNull($this->getParam('gender'));  $citizenship= Functions::checkNull($this->getParam('citizenship'));  $nationality= Functions::checkNull($this->getParam('nationality')); 
        $family_position= Functions::checkNull($this->getParam('family_position'));  $document_type= Functions::checkNull($this->getParam('document_type'));  $iin= Functions::checkNull($this->getParam('iin'));  $nomer= Functions::checkNull($this->getParam('nomer')); 
        $kem_vidan=Functions::checkNull($this->getParam("kem_vidan"));  $kogda_vidan=Functions::checkNull($this->getParam('kogda_vidan'));  $srok_deistvie=Functions::checkNull($this->getParam('srok_deistvie'));    $strana=Functions::checkNull($this->getParam('strana'));   $strana=Functions::checkNull($this->getParam('strana'));  
        $adres_projivanie=Functions::checkNull($this->getParam('adres_projivanie'));  
        $adres_propiski=Functions::checkNull($this->getParam('adres_propiski'));  $contact_number=Functions::checkNull($this->getParam('contact_number'));  $type_zavedenie=Functions::checkNull($this->getParam('type_zavedenie'));  $oblast_zavedenie=Functions::checkNull($this->getParam('oblast_zavedenie'));  $raion_zavedenie=Functions::checkNull($this->getParam('raion_zavedenie'));  $name_zavedenie=Functions::checkNull($this->getParam('name_zavedenie'));  
        $type_obrazovanie=Functions::checkNull($this->getParam('type_obrazovanie'));  
        $date_vidachi_obr=Functions::checkNull($this->getParam('date_vidachi_obr'));  
        $seria_document=Functions::checkNull($this->getParam('seria_document'));  
        $nomer_document=Functions::checkNull($this->getParam('nomer_document'));  
        $uslovno_zachislen=Functions::checkNull($this->getParam('uslovno_zachislen')); 
        $zagruzit_obr=Functions::checkNull($this->getParam('zagruzit_obr'));  
        $number_certificate=Functions::checkNull($this->getParam('number_certificate'));  
        $seria_certificate=Functions::checkNull($this->getParam('seria_certificate'));  
        $date_certificate=Functions::checkNull($this->getParam('date_certificate'));  
        $zagruzit_certificate=Functions::checkNull($this->getParam('zagruzit_certificate'));  
        $nomer_svidetelstva=Functions::checkNull($this->getParam('nomer_svidetelstva'));  
        $zagruzit_svidetelstva=Functions::checkNull($this->getParam('zagruzit_svidetelstva'));  
        $serpin=Functions::checkNull($this->getParam('serpin'));  
        $deti_siroti=Functions::checkNull($this->getParam('deti_siroti'));  
        $invalid_pervi=Functions::checkNull($this->getParam('invalid_pervi')); 
        $invalid_vtoroi=Functions::checkNull($this->getParam('invalid_vtoroi'));  
        $invalid_sdetstva = Functions::checkNull($this->getParam('invalid_sdetstva'));  
        $kvota_invalidam=Functions::checkNull($this->getParam('kvota_invalidam'));
        $selskaya_kvota=Functions::checkNull($this->getParam('selskaya_kvota'));  
        $kvota_negrajdan=Functions::checkNull($this->getParam('kvota_negrajdan'));  
        $pob_mej_olimp=Functions::checkNull($this->getParam('pob_mej_olimp'));  
        $pob_resp_olimp=Functions::checkNull($this->getParam('pob_resp_olimp'));  $znak_altin=Functions::checkNull($this->getParam('znak_altin'));  $atestat_osobo=Functions::checkNull($this->getParam('atestat_osobo'));  $pob_mej_nau=Functions::checkNull($this->getParam('pob_mej_nau'));  $pob_resp_nau=Functions::checkNull($this->getParam('pob_resp_nau')); 
        $pob_mej_sport=Functions::checkNull($this->getParam('pob_mej_sport'));  
        $pob_gorod_nau=Functions::checkNull($this->getParam('pob_gorod_nau'));  $pob_gorod_olimp=Functions::checkNull($this->getParam('pob_gorod_olimp')); 
         $pob_obl_nau_konkurs=Functions::checkNull($this->getParam('pob_obl_nau_konkurs'));  
         $pob_obl_olimp=Functions::checkNull($this->getParam('pob_obl_olimp'));  
         $pob_mej_vistavki=Functions::checkNull($this->getParam('pob_mej_vistavki'));  
         $uroven_obuchenie=Functions::checkNull($this->getParam('uroven_obuchenie'));  
        $stupen_obuchenie=Functions::checkNull($this->getParam('stupen_obuchenie')); 
        $forma_obuchenie=Functions::checkNull($this->getParam('forma_obuchenie')); 
        $language_otdelenie=Functions::checkNull($this->getParam('language_otdelenie'));  $faculty=Functions::checkNull($this->getParam('faculty'));  $specialnost=Functions::checkNull($this->getParam('specialnost')); 
        $who_registered=Functions::checkNull($this->getParam('who_registered')); 
        $data_about_who=Functions::checkNull($this->getParam('data_about_who'));  
        
        $grand_platni = Functions::checkNull($this->getParam('grand_platni'));  
        $proverenni = Functions::checkNull($this->getParam('proverenni'));  
        $unique_id = Functions::checkNull($this->getParam('unique_id'));  
        $comment = Functions::checkNull($this->getParam('comment'));  
        
        $zagruzit_udastak=Functions::checkNull($this->getParam('zagruzit_udastak'));
        $na_baze=Functions::checkNull($this->getParam('na_baze'));
        

        if($who_registered=='student') {
            $who_registered='student';
        }
        else {
            $who_registered = $temp_auth->user_id;
        }

       $userExist = Validate::checkUser($iin);
       if($userExist) {
        return $this->error(BAD_REQUEST, USER_EXIST, "User exist");
       }
       else {
        $insert_data = Job::insertallData(
            $surname, $name, $third_name, $date_birth, $gender, $citizenship, $nationality, $family_position, $document_type, $iin, $nomer, 
            $kem_vidan, $kogda_vidan, $srok_deistvie, $zagruzit_udastak, $strana, 
            $adres_projivanie, $adres_propiski, $contact_number, $type_zavedenie, $oblast_zavedenie, $raion_zavedenie, $name_zavedenie, $type_obrazovanie, 
            $date_vidachi_obr, $seria_document, $nomer_document, $uslovno_zachislen,
            $zagruzit_obr, $number_certificate, $seria_certificate, $date_certificate, $zagruzit_certificate, $nomer_svidetelstva, $zagruzit_svidetelstva, $serpin, $deti_siroti, 
            $invalid_pervi, $invalid_vtoroi, $invalid_sdetstva, $kvota_invalidam, $selskaya_kvota, $kvota_negrajdan, 
            $pob_mej_olimp, $pob_resp_olimp, $znak_altin, $atestat_osobo, $pob_mej_nau, $pob_resp_nau,
            $pob_mej_sport, $pob_gorod_nau, $pob_gorod_olimp, $pob_obl_nau_konkurs, $pob_obl_olimp, $pob_mej_vistavki, $uroven_obuchenie, 
            $stupen_obuchenie, $forma_obuchenie, $language_otdelenie, $faculty, $specialnost,$who_registered,$data_about_who,
            $grand_platni,$proverenni,$unique_id,$comment,$na_baze
        );
      
        return $insert_data? $this->success(OK, 
            [
                "message"=> "Inserted",
                "mes"=>$insert_data["unique_id"]
            ]
        )
        : $this->error(UNAUTHORIZED, NOT_AUTHORIZED, "Data not inserted");
  
       }
    
    }

    public function get($request, $response, $args = [])
    {
        $ids = $this->getParam('ids');
        
        $jobData = Job::getJobData($ids);

        return $jobData ? $this->success(OK, $jobData)
            : $this->error(UNAUTHORIZED, NOT_AUTHORIZED, "Not authorized");
    }
    
    public function searchData($request, $response, $args = [])
    {
        $ids = $this->getParam('product_name');
        
        $jobData = Job::searchJobData($ids);

        return $jobData ? $this->success(OK, $jobData)
            : $this->error(NOT_FOUND, NOT_FOUND, "Not authorized");
    }
    
    public function getAll($request, $response, $args = [])
    {
        $temp_auth = $request->getAttribute('temp_auth');
        $allData = Job::getAllDataStudent($temp_auth);

        return $allData;
    }

    public function studentRegistration($request, $response, $args = [])
    {
        $iin = Functions::checkNull($this->getParam('iin'));
        $password = Functions::checkNull($this->getParam('password'));
        $unique_id = Functions::checkNull($this->getParam('unique_id'));
      
       $userExist = Validate::checkUser_($iin);

       if($userExist){
        return $this->error(BAD_REQUEST, USER_EXIST, "USER EXIST");
       }
       else {
        $data = Job::registrationData($iin,$password,$unique_id);
        if($data){
            return $this->success(OK,
                [
                    'message' => 'Successfully registered',
                    'access_token' => $this->createToken
                    (
                        $data['id'],
                        [
                            'phone' => $data['iin'],
                            'password' => $data['password'],
                            'unique_id' => $data['unique_id'],
                            'iss' => 'token.account.student'
                        ]
                    ),
                ]
            );
        }
        else{
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "not registered");
        }
       }
       
     
    }


    public function studentLogin($request, $response, $args = [])
    {
        $iin = Functions::checkNull($this->getParam('iin'));
        $password = Functions::checkNull($this->getParam('password'));
        
        $data = Job::loginData($iin,$password);

        if($data){
            
            return $this->success(OK,
                [
                    'message' => 'Correct' ,
                    'name' => $data['name'],
                    'surname' => $data['surname'],
                    'third_name'=> $data['third_name'],
                    'access_token' => $this->createToken($data['id'],
                        [
                            'phone' => $data['iin'],
                            'password' => $data['password'],
                            'unique_id' => $data['unique_id'],
                            'iss' => 'token.account.student'
                        ]
                    ),
                ]
            );
           
        }
        else{
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "not correct");
        }
    }
    public function searchDataAll($request, $response, $args = [])
    {
       
        $surname = Functions::checkNull($this->getParam('surname'));  $name= Functions::checkNull($this->getParam('name'));  $third_name = Functions::checkNull($this->getParam('surname')); $date_birth= Functions::checkNull($this->getParam('date_birth'));  $gender= Functions::checkNull($this->getParam('gender'));  $citizenship= Functions::checkNull($this->getParam('citizenship'));  $nationality= Functions::checkNull($this->getParam('nationality')); 
        $family_position= Functions::checkNull($this->getParam('family_position'));  $document_type= Functions::checkNull($this->getParam('document_type'));  $iin= Functions::checkNull($this->getParam('iin'));  $nomer= Functions::checkNull($this->getParam('nomer')); 
        $kem_vidan=Functions::checkNull($this->getParam("kem_vidan"));  $kogda_vidan=Functions::checkNull($this->getParam('kogda_vidan'));  $srok_deistvie=Functions::checkNull($this->getParam('srok_deistvie'));  $zagruzit_udastak=Functions::checkNull($this->getParam('zagruzit_udastak'));  $strana=Functions::checkNull($this->getParam('strana'));  
        $adres_projivanie=Functions::checkNull($this->getParam('adres_projivanie'));  
        $adres_propiski=Functions::checkNull($this->getParam('adres_propiski'));  $contact_number=Functions::checkNull($this->getParam('contact_number'));  $type_zavedenie=Functions::checkNull($this->getParam('type_zavedenie'));  $oblast_zavedenie=Functions::checkNull($this->getParam('oblast_zavedenie'));  $raion_zavedenie=Functions::checkNull($this->getParam('raion_zavedenie'));  $name_zavedenie=Functions::checkNull($this->getParam('name_zavedenie'));  
        $type_obrazovanie=Functions::checkNull($this->getParam('type_obrazovanie'));  
        $date_vidachi_obr=Functions::checkNull($this->getParam('date_vidachi_obr'));  
        $seria_document=Functions::checkNull($this->getParam('seria_document'));  
        $nomer_document=Functions::checkNull($this->getParam('nomer_document'));  
        $uslovno_zachislen=Functions::checkNull($this->getParam('uslovno_zachislen')); 
        $zagruzit_obr=Functions::checkNull($this->getParam('zagruzit_obr'));  
        $number_certificate=Functions::checkNull($this->getParam('number_certificate'));  
        $seria_certificate=Functions::checkNull($this->getParam('seria_certificate'));  
        $date_certificate=Functions::checkNull($this->getParam('date_certificate'));  
        $zagruzit_certificate=Functions::checkNull($this->getParam('zagruzit_certificate'));  
        $nomer_svidetelstva=Functions::checkNull($this->getParam('nomer_svidetelstva'));  
        $zagruzit_svidetelstva=Functions::checkNull($this->getParam('zagruzit_svidetelstva'));  
        $serpin=Functions::checkNull($this->getParam('serpin'));  
        $deti_siroti=Functions::checkNull($this->getParam('deti_siroti'));  
        $invalid_pervi=Functions::checkNull($this->getParam('invalid_pervi')); 
        $invalid_vtoroi=Functions::checkNull($this->getParam('invalid_vtoroi'));  
        $invalid_sdetstva = Functions::checkNull($this->getParam('invalid_sdetstva'));  
        $kvota_invalidam=Functions::checkNull($this->getParam('kvota_invalidam'));
        $selskaya_kvota=Functions::checkNull($this->getParam('selskaya_kvota'));  
        $kvota_negrajdan=Functions::checkNull($this->getParam('kvota_negrajdan'));  
        $pob_mej_olimp=Functions::checkNull($this->getParam('pob_mej_olimp'));  
        $pob_resp_olimp=Functions::checkNull($this->getParam('pob_resp_olimp'));  $znak_altin=Functions::checkNull($this->getParam('znak_altin'));  $atestat_osobo=Functions::checkNull($this->getParam('atestat_osobo'));  $pob_mej_nau=Functions::checkNull($this->getParam('pob_mej_nau'));  $pob_resp_nau=Functions::checkNull($this->getParam('pob_resp_nau')); 
        $pob_mej_sport=Functions::checkNull($this->getParam('pob_mej_sport'));  
        $pob_gorod_nau=Functions::checkNull($this->getParam('pob_gorod_nau'));  $pob_gorod_olimp=Functions::checkNull($this->getParam('pob_gorod_olimp')); 
        $pob_obl_nau_konkurs=Functions::checkNull($this->getParam('pob_obl_nau_konkurs'));  
        $pob_obl_olimp=Functions::checkNull($this->getParam('pob_obl_olimp'));  
        $pob_mej_vistavki=Functions::checkNull($this->getParam('pob_mej_vistavki'));  
        $uroven_obuchenie=Functions::checkNull($this->getParam('uroven_obuchenie'));  
        $stupen_obuchenie=Functions::checkNull($this->getParam('stupen_obuchenie')); 
        $forma_obuchenie=Functions::checkNull($this->getParam('forma_obuchenie')); 
        $language_otdelenie=Functions::checkNull($this->getParam('language_otdelenie'));  $faculty=Functions::checkNull($this->getParam('faculty'));  $specialnost=Functions::checkNull($this->getParam('specialnost')); 
        $who_registered=Functions::checkNull($this->getParam('who_registered')); 
        $data_about_who=Functions::checkNull($this->getParam('data_about_who'));  

        $grand_platni = Functions::checkNull($this->getParam('grand_platni'));  
        $proverenni = Functions::checkNull($this->getParam('proverenni'));  
        
        
     
        $jobData = Job::searchJobData(
            $surname, $name, $third_name, $date_birth, $gender, $citizenship, $nationality, $family_position, $document_type, $iin, $nomer, 
            $kem_vidan, $kogda_vidan, $srok_deistvie, $zagruzit_udastak, $strana, 
            $adres_projivanie, $adres_propiski, $contact_number, $type_zavedenie, $oblast_zavedenie, $raion_zavedenie, $name_zavedenie, $type_obrazovanie, 
            $date_vidachi_obr, $seria_document, $nomer_document, $uslovno_zachislen,
            $zagruzit_obr, $number_certificate, $seria_certificate, $date_certificate, $zagruzit_certificate, $nomer_svidetelstva, $zagruzit_svidetelstva, $serpin, $deti_siroti, 
            $invalid_pervi, $invalid_vtoroi, $invalid_sdetstva, $kvota_invalidam, $selskaya_kvota, $kvota_negrajdan, 
            $pob_mej_olimp, $pob_resp_olimp, $znak_altin, $atestat_osobo, $pob_mej_nau, $pob_resp_nau,
            $pob_mej_sport, $pob_gorod_nau, $pob_gorod_olimp, $pob_obl_nau_konkurs, $pob_obl_olimp, $pob_mej_vistavki, $uroven_obuchenie, 
            $stupen_obuchenie, $forma_obuchenie, $language_otdelenie, $faculty, $specialnost,$who_registered,$data_about_who,    $grand_platni ,
            $proverenni

        );
    
        return $jobData ? $this->success(OK, $jobData)
            : $this->error(NOT_FOUND, USER_NOT_EXIST, "Data noot");

            
    }




    public function signUp($request, $response, $args = [])
    {
        $user = Validate::checkUserExist($phone);

        if($user['password']) {
            return $this->error(BAD_REQUEST, USER_EXIST, "Phone exist");
        }
        else {
            return Functions::sendSMS($phone) ? $this->success(OK,
            ['message' => 'Your successfully registered. Please confirm you phone']) : $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Server error. SMS not sent");   
        }
    }


    /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     * @throws \Exception
     */
    public function signUpPhone($request, $response, $args = [])
    {
        $phone = Validate::standartizePhone($this->getParam('phone'));
        
        $user = Validate::checkUserExist2($phone);

        $data = Functions::insertData($phone);
        
        if(!$user){
            if($data){
                return $this->success(OK,
                    [
                        'message' => 'Data successfully saved  confirm your phone' 
                    ]
                );
            }
            else {
                $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "Server error. SMS not sent");
            }
        }
        else{
            return $this->error(INTERNAL_SERVER_ERROR, UNEXPECTED_ERROR, "User exist");
        }
    }


    public function signUpVerifyPhone($request, $response, $args = [])
    {
        $phone = Validate::standartizePhone($this->getParam('phone'));
        $code = $this->getParam('code');

        if (Functions::checkCode($phone, $code)) {
        
            $user_id = Signup::setUserID($phone);

            if($user_id) 
            {
                return $this->success(OK,
                    [
                        'message' => 'You successfully confirmed phone',
                        'access_token' => $this->createToken($user_id,
                            [
                                'phone' => $phone,
                                'iss' => 'token.account.tmp'
                            ]
                        )
                    ]
                );
            }
        } 
        else {
            return $this->error(BAD_REQUEST, CODE_ERROR, "Code error");
        }
    }


    public function setPassword($request, $response, $args = [])
    {

        $password = $this->getParam('password');

        $temp_auth = $request->getAttribute('temp_auth');
        $result = Signup::set_password($temp_auth,$password);
        
        if($result) {
            return $this->success(OK,
                [
                    'message' => 'password setted' 
                ]
            );
        }
        else {
            return "failed";
        }
    }
    public function update_all($request, $response, $args = [])
    {
        $surname = Functions::checkNull($this->getParam('surname'));  $name= Functions::checkNull($this->getParam('name'));  $third_name = Functions::checkNull($this->getParam('third_name')); $date_birth= Functions::checkNull($this->getParam('date_birth'));  $gender= Functions::checkNull($this->getParam('gender'));  $citizenship= Functions::checkNull($this->getParam('citizenship'));  $nationality= Functions::checkNull($this->getParam('nationality')); 
        $family_position= Functions::checkNull($this->getParam('family_position'));  $document_type= Functions::checkNull($this->getParam('document_type'));  $iin= Functions::checkNull($this->getParam('iin'));  $nomer= Functions::checkNull($this->getParam('nomer')); 
        $kem_vidan=Functions::checkNull($this->getParam("kem_vidan"));  $kogda_vidan=Functions::checkNull($this->getParam('kogda_vidan'));  $srok_deistvie=Functions::checkNull($this->getParam('srok_deistvie'));  $zagruzit_udastak=Functions::checkNull($this->getParam('zagruzit_udastak'));  $strana=Functions::checkNull($this->getParam('strana'));  
        $adres_projivanie=Functions::checkNull($this->getParam('adres_projivanie'));  
        $adres_propiski=Functions::checkNull($this->getParam('adres_propiski'));  $contact_number=Functions::checkNull($this->getParam('contact_number'));  $type_zavedenie=Functions::checkNull($this->getParam('type_zavedenie'));  $oblast_zavedenie=Functions::checkNull($this->getParam('oblast_zavedenie'));  $raion_zavedenie=Functions::checkNull($this->getParam('raion_zavedenie'));  $name_zavedenie=Functions::checkNull($this->getParam('name_zavedenie'));  
        $type_obrazovanie=Functions::checkNull($this->getParam('type_obrazovanie'));  
        $date_vidachi_obr=Functions::checkNull($this->getParam('date_vidachi_obr'));  
        $seria_document=Functions::checkNull($this->getParam('seria_document'));  
        $nomer_document=Functions::checkNull($this->getParam('nomer_document'));  
        $uslovno_zachislen=Functions::checkNull($this->getParam('uslovno_zachislen')); 
        $zagruzit_obr=Functions::checkNull($this->getParam('zagruzit_obr'));  
        $number_certificate=Functions::checkNull($this->getParam('number_certificate'));  
        $seria_certificate=Functions::checkNull($this->getParam('seria_certificate'));  
        $date_certificate=Functions::checkNull($this->getParam('date_certificate'));  
        $zagruzit_certificate=Functions::checkNull($this->getParam('zagruzit_certificate'));  
        $nomer_svidetelstva=Functions::checkNull($this->getParam('nomer_svidetelstva'));  
        $zagruzit_svidetelstva=Functions::checkNull($this->getParam('zagruzit_svidetelstva'));  
        $serpin=Functions::checkNull($this->getParam('serpin'));  
        $deti_siroti=Functions::checkNull($this->getParam('deti_siroti'));  
        $invalid_pervi=Functions::checkNull($this->getParam('invalid_pervi')); 
        $invalid_vtoroi=Functions::checkNull($this->getParam('invalid_vtoroi'));  
        $invalid_sdetstva = Functions::checkNull($this->getParam('invalid_sdetstva'));  
        $kvota_invalidam=Functions::checkNull($this->getParam('kvota_invalidam'));
        $selskaya_kvota=Functions::checkNull($this->getParam('selskaya_kvota'));  
        $kvota_negrajdan=Functions::checkNull($this->getParam('kvota_negrajdan'));  
        $pob_mej_olimp=Functions::checkNull($this->getParam('pob_mej_olimp'));  
        $pob_resp_olimp=Functions::checkNull($this->getParam('pob_resp_olimp'));  $znak_altin=Functions::checkNull($this->getParam('znak_altin'));  $atestat_osobo=Functions::checkNull($this->getParam('atestat_osobo'));  $pob_mej_nau=Functions::checkNull($this->getParam('pob_mej_nau'));  $pob_resp_nau=Functions::checkNull($this->getParam('pob_resp_nau')); 
        $pob_mej_sport=Functions::checkNull($this->getParam('pob_mej_sport'));  
        $pob_gorod_nau=Functions::checkNull($this->getParam('pob_gorod_nau'));  $pob_gorod_olimp=Functions::checkNull($this->getParam('pob_gorod_olimp')); 
        $pob_obl_nau_konkurs=Functions::checkNull($this->getParam('pob_obl_nau_konkurs'));  
        $pob_obl_olimp=Functions::checkNull($this->getParam('pob_obl_olimp'));  
        $pob_mej_vistavki=Functions::checkNull($this->getParam('pob_mej_vistavki'));  
        $uroven_obuchenie=Functions::checkNull($this->getParam('uroven_obuchenie'));  
        $stupen_obuchenie=Functions::checkNull($this->getParam('stupen_obuchenie')); 
        $forma_obuchenie=Functions::checkNull($this->getParam('forma_obuchenie')); 
        $language_otdelenie=Functions::checkNull($this->getParam('language_otdelenie'));  $faculty=Functions::checkNull($this->getParam('faculty'));  $specialnost=Functions::checkNull($this->getParam('specialnost')); 
        $who_registered=Functions::checkNull($this->getParam('who_registered')); 
        $data_about_who=Functions::checkNull($this->getParam('data_about_who'));  

        $grand_platni = Functions::checkNull($this->getParam('grand_platni'));  
        $proverenni = Functions::checkNull($this->getParam('proverenni'));  
        $unique_id = Functions::checkNull($this->getParam('unique_id'));  
        $comment = Functions::checkNull($this->getParam('comment'));  
        
        $jobData = Job::updateData(
            $surname, $name, $third_name, $date_birth, $gender, $citizenship, $nationality, $family_position, $document_type, $iin, $nomer, 
            $kem_vidan, $kogda_vidan, $srok_deistvie, $zagruzit_udastak, $strana, 
            $adres_projivanie, $adres_propiski, $contact_number, $type_zavedenie, $oblast_zavedenie, $raion_zavedenie, $name_zavedenie, $type_obrazovanie, 
            $date_vidachi_obr, $seria_document, $nomer_document, $uslovno_zachislen,
            $zagruzit_obr, $number_certificate, $seria_certificate, $date_certificate, $zagruzit_certificate, $nomer_svidetelstva, $zagruzit_svidetelstva, $serpin, $deti_siroti, 
            $invalid_pervi, $invalid_vtoroi, $invalid_sdetstva, $kvota_invalidam, $selskaya_kvota, $kvota_negrajdan, 
            $pob_mej_olimp, $pob_resp_olimp, $znak_altin, $atestat_osobo, $pob_mej_nau, $pob_resp_nau,
            $pob_mej_sport, $pob_gorod_nau, $pob_gorod_olimp, $pob_obl_nau_konkurs, $pob_obl_olimp, $pob_mej_vistavki, $uroven_obuchenie, 
            $stupen_obuchenie, $forma_obuchenie, $language_otdelenie, $faculty, $specialnost,$who_registered,$data_about_who,    $grand_platni ,
            $proverenni,$unique_id,$comment
        );
        return $jobData ? $this->success(OK,
                ['message' => 'Updated']
        )
            : $this->error(NOT_FOUND, USER_NOT_EXIST, "Data not updated"); 
    }

    
}