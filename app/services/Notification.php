<?php

namespace App\Services\v1\Notification;

use App\Interfaces\IChat;
use App\Models\Group;
use App\Models\Servant;
use App\Models\User;

class Notification
{
    public $chat;

    public function __construct()
    {
        $this->chat = app(IChat::class);
    }

    public function getReceivers($request)
    {
        $receivers = [];
        if ($request->filled('receivers_ids')) {
            $users_ids = User::query()->whereIn('id', $request->receivers_ids)->get('auth_id');
            $receivers = $users_ids->pluck('auth_id')->toArray();

        } elseif ($request->filled('group_id')) {
            /** @var Group $group */
            $group = Group::query()->find( $request->group_id);

            $receivers = $group->users()->pluck('auth_id')->toArray();

        } elseif (($request->filled('area_id') and !$request->filled('role_id'))
            or ($request->filled('area_id') and $request->filled('role_id') and $request->role_id == 5)) {
            $users_ids = User::where('area_id', $request->area_id)->get('auth_id');
            $receivers = $users_ids->pluck('auth_id')->toArray();
        } elseif ($request->filled('area_id') and $request->filled('role_id') and $request->role_id == 4) {
            $servants = Servant::select('user_id')->with('user:id,auth_id')->byArea($request->area_id)->get();
            $servants->each(function ($servant) use (&$receivers) {
                $receivers[] = $servant->user->auth_id;
            });
        }
        return $receivers;
    }

    public function send(array $users_auth_ids, $message)
    {
        return $this->chat->send($users_auth_ids, $message);
    }
}
