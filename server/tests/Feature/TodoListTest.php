<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodoListTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_fetch_all_todo_list_and_count_response()
    {
    Todo::create([
    "title" => "new test"
    ]);
    $response = $this->getJson(route('todo.index'));
    // dd($response);
    
    $this->assertEquals(4,count($response->json()));
    
    }

    public function test_fetch_all_todo_list()
    {
    Todo::create([
    "title" => "new test"
    ]);
    $response = $this->getJson(route('todo.index'));
    // dd($response);
    
    
    $this->assertEquals('true',$response->json()['success']);
    $response->assertStatus(200);
    }

    public function test_fetch_single_todo()
    {
    $todos = Todo::create([
    "title" => "new test"
    ]);
    $response = $this->getJson(route('todo.show',$todos->id));
    // dd($response);
    
    
    $this->assertEquals('true',$response->json()['success']);
    $response->assertStatus(200);
    }

    public function test_to_store_todo()
    {
   
    $response = $this->postJson(route('todo.store',['title' => "this a test title"]));
    // dd($response);
    $response->assertCreated();

    $this->assertDatabaseHas('todos',['title' => "this a test title"]);
    
    
    }

    public function test_todo_title_field_is_required()
    {
   
    $response = $this->postJson(route('todo.store'));
    // dd($response);
    $response->assertStatus(422);

 
    
    
    }

    public function test_to_update_todo()
    {

        $todos = Todo::create([
            "title" => "this a test title"
            ]);
   
    $response = $this->postJson(route('todo.update',$todos->id),[
        "title" => "this an updated todo"]);
    // dd($response);
    $response->assertOk();

    $this->assertDatabaseHas('todos',["id" => $todos->id, "title" => "this an updated todo"]);
    
    
    }

    public function test_to_delete_todo()
    {

        $todos = Todo::create([
            "title" => "this a test title"
            ]);
   
    $response = $this->deleteJson(route('todo.destroy',$todos->id));
    // dd($response);
    $response->assertNoContent();

    $this->assertDatabaseMissing('todos',['title' => "this a test title"]);
    
    
    }
}