<?php
namespace Controllers;
use Models\Api;

class ApiController extends Controller
{

       /**
     * @param $request
     * @param $response
     * @param array $args
     * @return mixed
     */
    public function insert($request, $response, $args = [])
    {
        $name = $this->getParam('name');
        $email = $this->getParam('email');
        $comment = $this->getParam('comment');
       
        $insertLatin = Api::insert($name,$email,$comment);

        return $insertLatin;
    }

    public function get($request, $response, $args = [])
    {
        $get = Api::get();

        return $get;
    }
}