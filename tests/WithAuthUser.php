<?php

namespace Tests;

use App\Models\User;

trait WithAuthUser
{
    /**
     * Create a pseudo, authenticated user
     */
    public function authUser()
    {
        // create a user object
        $user = new User([
            'id' => 1
        ]);

        // authenticate it
        $this->be($user);
    }
}
