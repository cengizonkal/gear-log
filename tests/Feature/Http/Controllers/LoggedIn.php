<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

abstract class LoggedIn extends TestCase
{
    use RefreshDatabase, WithFaker;
    protected $user;

    public function setUp(): void{
        //create a user and login
        parent::setUp();
        $this->user = \App\Models\User::factory()->create();
        $this->actingAs($this->user, 'api');

    }
   
}
