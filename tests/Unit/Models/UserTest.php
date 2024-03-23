<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

// by dafault Testcase is imported from another path. Rewrite this.
use Tests\TestCase;

class UserTest extends TestCase
{


    public function test_has_many_repositories(): void
    {

        $user = new User();
        //This is how you can test if a user has many repositories
        $this->assertInstanceOf(Collection::class, $user->repositories);
    }
}
