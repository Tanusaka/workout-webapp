<?php
/**
 *
 * @author Samu
 */
namespace App\Models\App;

use App\Models\Core\BaseModel;

class MediaModel extends BaseModel
{
    public function get()
    {
        return json_decode(
            $this->apiGet('/media')
        );
    }

    public function getMedia($data=[])
    {
        return json_decode(
            $this->apiPost('/media/get', $data)
        );
    }

    public function saveMedia($data=[])
    {
        return json_decode(
            $this->apiPost('/media/save', $data)
        );
    }

    public function deleteMedia($data=[])
    {
        return json_decode(
            $this->apiPost('/media/delete', $data)
        );
    }
}