<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{

    public fucntion status_should_be_within_defined_numbers()
    {
        $this->seed('ItemsTableSeeder');

        $response = $this->post('/items/2/edit',[
            'title' => "お金持ちに？",
            'category' => '1',
            'sub_category' => '1',
            'isbn_13' => '1234567890123',
            'status' => 999,
        ]);

        $response->assertSessionHasErrors([
            'status' => '状態には 販売中、売り切れ、取引中のいずれかを指定してください。'
        ]);
    }
}

