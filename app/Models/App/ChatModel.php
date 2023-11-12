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
    public function getChats($data=[])
    {
        return json_decode(
            $this->apiGet('/chats', $data)
        );
    }

    public function getChat($data=[])
    {
        return json_decode(
            $this->apiPost('/chats/get', $data)
        );
    }

    public function getPersonalChatConnections($data=[])
    {
        return json_decode(
            $this->apiPost('/chats/get/personal/connections', $data)
        );
    }

    public function savePersonalChat($data=[])
    {
        return json_decode(
            $this->apiPost('/chats/save/personal', $data)
        );
    }

    public function savePersonalChatMessage($data=[])
    {
        return json_decode(
            $this->apiPost('/chats/save/personal/message', $data)
        );
    }

    public function deletePersonalChat($data=[])
    {
        return json_decode(
            $this->apiPost('/chats/delete/personal', $data)
        );
    }
}
