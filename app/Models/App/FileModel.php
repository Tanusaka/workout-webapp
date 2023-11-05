<?php
/**
 *
 * @author Samu
 */
namespace App\Models\App;

use App\Models\Core\BaseModel;

class FileModel extends BaseModel
{
    public function getFiles()
    {
        return json_decode(
            $this->apiGet('/files')
        );
    }

    public function getFile($data=[])
    {
        return json_decode(
            $this->apiPost('/files/get', $data)
        );
    }

    public function saveFile($data=[])
    {
        return json_decode(
            $this->apiPost('/files/save', $data)
        );
    }

    public function uploadFile($data=[])
    {
        return json_decode(
            $this->apiPost('/files/upload', $data)
        );
    }

    public function deleteFiles($data=[])
    {
        return json_decode(
            $this->apiPost('/files/delete', $data)
        );
    }
}