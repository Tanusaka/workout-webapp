<?php
/**
 *
 * @author Samu
 */
namespace App\Models\App;

use App\Models\Core\BaseModel;

class ChatModel extends BaseModel
{
    #chats
    public function get($data=[])
    {
        return json_decode(
            $this->apiPost('/chats', $data)
        );
    }

    public function getChat($data=[])
    {
        return json_decode(
            $this->apiPost('/chats/get', $data)
        );
    }

    public function saveChat($data=[])
    {
        return json_decode(
            $this->apiPost('/chats/save', $data)
        );
    }
}
