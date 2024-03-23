<?php

namespace Tests\Unit\Models;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepositoryTest extends TestCase
{
    use RefreshDatabase;
    public function test_belongs_to_a_user(): void
    {
        User::factory()->create();
        $this->withoutExceptionHandling();
        $repository = Repository::factory()->create();
        $this->assertInstanceOf(User::class, $repository->user);

    }
}
