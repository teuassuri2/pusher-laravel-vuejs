<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use \Illuminate\Http\Request;

/**
 * Description of PusherController
 *
 * @author teuas
 */
class PusherController extends BaseController {

    public function sendMessage() {
        $pusher = new Pusher\Pusher(env("PUSHER_APP_KEY"), env("PUSHER_APP_SECRET"), env("PUSHER_APP_ID"), array('cluster' => env('PUSHER_APP_CLUSTER')));
        $pusher->trigger('presence-name', 'event-name', array('message' => ['sucesse' => true]));
    }

    public function authenticate(Request $request) {

        $socketId = $request->input('socket_id');
        $channelName = $request->input('channel_name');

        $pusher = new Pusher\Pusher(env("PUSHER_APP_KEY"), env("PUSHER_APP_SECRET"), env("PUSHER_APP_ID"), array('cluster' => env('PUSHER_APP_CLUSTER')));
        $id = uniqid();
        $presence_data = ['name' => $request->input('name'), 'id' => uniqid()];

        $key = $pusher->presence_auth($channelName, $socketId, $id, $presence_data);

        return response($key);
    }

}
