<?php
namespace MyApp;

require_once "vendor/autoload.php";

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;

class Socket implements MessageComponentInterface {
    public function onOpen(ConnectionInterface $conn) {
        echo "Connected\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo $msg."\n";

        $pid = pcntl_fork();
        switch($pid) {
            case -1:
                print "Could not fork!\n";
                exit;
            case 0:
                sleep(5);
                $from->send("Response: ".$msg);
                $from->send("Response: ".$msg);
                $from->send("Response: ".$msg);
                $from->send("Response: ".$msg);
                $from->send("Response: ".$msg);
                break;
            default:
        }
    }

    public function onClose(ConnectionInterface $conn) {
        echo "Closed\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Error\n";
    }
}

$server = IoServer::factory(new Socket(), 5555);

$server->run();