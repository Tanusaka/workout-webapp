<?php
/**
 *
 * @author Samu
 */
namespace App\Models\App;

use App\Models\Core\BaseModel;

class UserModel extends BaseModel
{
    public function get()
    {
        return json_decode(
            $this->apiGet('/users')
        );
    }

    public function getUser($data=[])
    {
        return json_decode(
            $this->apiPost('/users/get', $data)
        );
    }
    
    public function saveUser($data=[])
    {
        return json_decode(
            $this->apiPost('/users/save', $data)
        );
    }

    public function updateUserProfile($data=[])
    {
        return json_decode(
            $this->apiPost('/users/update', $data)
        );
    }

    public function updateUserPassword($data=[])
    {
        return json_decode(
            $this->apiPost('/users/update/password', $data)
        );
    }

    public function updateUserDescription($data=[])
    {
        return json_decode(
            $this->apiPost('/users/update/description', $data)
        );
    }

    public function updateUserRole($data=[])
    {
        return json_decode(
            $this->apiPost('/users/update/role', $data)
        );
    }

    public function getTrainers($data=[])
    {
        return json_decode(
            $this->apiPost('/users/get/trainers', $data)
        );
    }

    public function getMyProfile($data=[])
    {
        return json_decode(
            $this->apiPost('/users/get/myprofile', $data)
        );
    }

    public function getUserRoleConnections($data=[])
    {
        return json_decode(
            $this->apiPost('/users/get/connections/allroles', $data)
        );
    }

    public function saveUserConnection($data=[])
    {
        return json_decode(
            $this->apiPost('/users/add/connection', $data)
        );
    }

    public function deleteUserConnection($data=[])
    {
        return json_decode(
            $this->apiPost('/users/delete/connection', $data)
        );
    }
}
