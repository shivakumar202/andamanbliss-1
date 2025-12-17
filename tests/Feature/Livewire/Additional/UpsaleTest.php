<?php

namespace Tests\Feature\Livewire\Additional;

use App\Livewire\Additional\Upsale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpsaleTest extends TestCase
{
    /** @test */
    public function renders_successfully()
    {
        Livewire::test(Upsale::class)
            ->assertStatus(200);
    }
}
