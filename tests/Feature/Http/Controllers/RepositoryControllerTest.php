<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Repository;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepositoryControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_guest(): void
    {
        $this->assertGuest();
        $this->get("repositories")->assertRedirect("login");
    }
    public function test_create_a_repo(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $repo = [
            "description" => "No asdasd asda sd",
            "url" => "http://example.com"
        ];
        $this->actingAs($user)
            ->post("repositories", $repo)
            ->assertRedirect("repositories");
        $this->assertDatabaseHas("repositories", $repo);
    }

    public function test_update_a_repo()
    {
        User::factory()->create();
        $repository = Repository::factory()->create();


        $dataUpdate = ["description" => "No se que es", "url" => "http://example"];
        $this->actingAs($repository->user)
            ->put("repositories/$repository->id", $dataUpdate)
            ->assertRedirect("repositories/$repository->id");


        $this->assertDatabaseHas("repositories", $dataUpdate);
    }

    public function test_description_seen_on_repo_details()
    {
        User::factory()->create();
        $repo = Repository::factory()->create();
        $this->actingAs($repo->user)
            ->get("repositories/$repo->id")
            ->assertSee($repo->description);
    }

    public function test_delete_a_repo()
    {
        User::factory()->create();
        $repo = Repository::factory()->create();
        $this->assertDatabaseHas("repositories", ["id" => $repo->id, "description" => $repo->description]);
        $this->actingAs($repo->user)
            ->delete("repositories/$repo->id")
            ->assertRedirect("repositories");

        $this->assertDatabaseMissing("repositories", ["id" => $repo->id, "description" => $repo->description]);
    }


}
