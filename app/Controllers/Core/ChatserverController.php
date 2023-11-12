<?php

namespace App\Controllers\Core;

use CodeIgniter\Controller;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use App\Libraries\Chat;

class ChatserverController extends Controller
{
    public function index()
    {
        // require dirname(__DIR__) . '/vendor/autoload.php';

        print_r('Chat Server is Running...');

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            8892
        );

        $server->run();
    }
}


    