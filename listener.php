<?php
include "./SocketServer.class.php";

$server = new SocketServer(null, 5555); // Binds to determined IP
$server->hook("connect", "connect_function"); // On connect does connect_function($server,$client,"");
$server->hook("disconnect", "disconnect_function"); // On disconnect does disconnect_function($server,$client,"");
$server->hook("input", "handle_input"); // When receiving input does handle_input($server,$client,$input);
$server->infinite_loop(); // starts the loop.

function connect_function($server, $client){
    $pid = pcntl_fork();
    if ($pid == -1) {
        die('could not fork');
    } else if ($pid) {
        // we are the parent
        pcntl_wait($status); //Protect against Zombie children
    } else {
        // we are the child
    }

    echo "Connect\n";

    sleep(10);

    // $request = '';
    // $command = "4B521D01031A020030000000000011110000000000000000000000002B041855";
    // $command = str_split($command, 2);
    // for($i = 0; $i < sizeof($command); $i++){
    //     $request .= chr(hexdec($command[$i]));
    // }

    // send($client->socket, $request);
}

function disconnect_function($server, $client){
    echo "Disconnect\n";
}

function handle_input($server, $client, $input){
    echo $client->ip." Input\n";
    //echo "[" . date("H:i:s") . "] ".$client->ip.": ".hex2bin(substr(strtoupper(bin2hex($input)), 8, 34))."\n";
    //echo strtoupper(bin2hex($input))."\n";
    //send($client->socket, $input);
}

function send($socket, $input){
    echo "Sending...\n";
    SocketServer::socket_write_smart($socket, $input, "");
}
?>