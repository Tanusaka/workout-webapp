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
}