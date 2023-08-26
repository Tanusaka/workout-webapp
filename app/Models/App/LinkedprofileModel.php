<?php
/**
 *
 * @author Samu
 */
namespace App\Models\App;

use App\Models\Core\BaseModel;

class LinkedprofileModel extends BaseModel
{

    public function getLinkedprofiles($data=[])
    {
        return json_decode(
            $this->apiPost('/linkedprofiles/get', $data)
        );
    }

    public function getUsersForLinkedProfile($data=[])
    {
        return json_decode(
            $this->apiPost('/linkedprofiles/get/users', $data)
        );
    }

    public function saveLinkedProfile($data=[])
    {
        return json_decode(
            $this->apiPost('/linkedprofiles/save', $data)
        );
    }

    public function deleteLinkedProfile($data=[])
    {
        return json_decode(
            $this->apiPost('/linkedprofiles/delete', $data)
        );
    }
}