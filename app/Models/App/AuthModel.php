<?php
/**
 *
 * @author Samu
 */
namespace App\Models\App;

use App\Models\Core\BaseModel;

class AuthModel extends BaseModel
{
    public function check($data=[])
    {
        return json_decode(
            $this->apiPost('/auth/login', $data, false)
        );
    }

    public function getPermissions($data=[])
    {
        return json_decode(
            $this->apiPost('/auth/permissions', $data)
        );
    }
}