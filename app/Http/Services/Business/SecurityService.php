<?php
namespace App\Http\Services\Business;

use App\Http\Models\UserModel;
use App\Http\Services\Business\Data\SecurityDAO;

class SecurityService{
    
    public function authenticate($username, $password)
    {
        //assume did not find
        $result = false;
        //check for user
        $security = new SecurityDAO();
        $result = $security->findUser($username,$password);
        //return if found or not
        return $result;
    }
    public function create(UserModel $user)
    {
        //assume creation of user failse
        $result = false;
        //make new user in database using user model
        $security = new SecurityDAO();
        $result = $security->makeUser($user);
        return $result;
    }
    
}