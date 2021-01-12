<?php

namespace Tests\Feature;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    // use RefreshDatabase;

    public function testGuest()
    {
        $response = $this->get(route('books.index'));

        $response->assertRedirect(route('login'));
    }

    // public function testAuth()
    // {
    //     $user = factory(User::class)->create();

    //     $response = $this->actingAs($user)
    //         ->get(route('books.index'));

    //     $response->assertStatus(200)
    //         ->assertViewIs('books.index');
    // }

}
