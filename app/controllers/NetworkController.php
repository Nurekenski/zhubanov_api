<?php

namespace Controllers;

use Lib\Validate;
use Models\Network;

class NetworkController extends Controller
{
    public function link($request, $response, $args = []){
        $network_auth = $request->getAttribute('network_auth');
        $phone = Validate::standartizePhone($network_auth->phone);


        return $this->success(OK, Network::getDataForNetwork($phone));

    }
}