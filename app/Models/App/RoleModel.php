<?php
/**
 *
 * @author Samu
 */
namespace App\Models\App;

use App\Models\Core\BaseModel;

class RoleModel extends BaseModel
{
    public function get()
    {
        return json_decode(
            $this->apiGet('/roles')
        );
    }

    public function getRole($data=[])
    {
        return json_decode(
            $this->apiPost('/roles/get', $data)
        );
    }

    public function updatePermissions($data=[])
    {
        return json_decode(
            $this->apiPost('/roles/permissions/update', $data)
        );
    }
}