<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AiController extends Controller
{


    public function __invoke(Request $request)
    {
        $response=Http::withHeaders([
            'content-type' => 'application/json',
            'Authorization' => "Bearer ".env('GPT_SECRET_KEY') 
            
        ])->post('https://api.openai.com/v1/completions',[
            'model' => "gpt-3.5-turbo",
            'messages' => [
                [
                    "role" => "user",
                    "content" => $request->post('prompt')
                ]
            ],
            'temperature' => 0,
            'max_tokens' => 2048,
        ])->body();
        
        
        return response()->json(json_decode($response));
    }


    public function aiAssistant()
    {
        return view('Frontend.ai-assistant.index');
    }
}
