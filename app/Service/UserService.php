<?php

namespace App\Service;

use App\Models\User;

class UserService
{


    public function store($data): void
    {

        User::create([
            "name" => $data["ProfileName"],
            "phone" => $data["WaId"]
        ]);
    }
}
