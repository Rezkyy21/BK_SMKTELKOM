<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BkAssistantController extends Controller
{
    public function test()
    {
        return response()->json(['status' => 'ok', 'message' => 'Controller works']);
    }

    public function message(Request $request)
    {
        try {
            // Debug: Log request untuk debugging
            \Log::info('BkAssistant message request', [
                'user' => auth()->user()?->id,
                'csrf_valid' => csrf_token(),
                'body' => $request->all()
            ]);

            $request->validate([
                'messages' => 'required|array|min:1',
                'messages.*.author' => 'required|string',
                'messages.*.content' => 'required|array|min:1',
                'messages.*.content.*.type' => 'required|string',
                'messages.*.content.*.text' => 'required|string',
            ]);

            $messages = $request->input('messages');

            // Transform messages ke format Gemini API
            $contents = [];
            foreach ($messages as $msg) {
                $role = $msg['author'] === 'user' ? 'user' : 'model';
                $text = '';

                foreach ($msg['content'] as $content) {
                    if ($content['type'] === 'text' && isset($content['text'])) {
                        $text .= $content['text'];
                    }
                }

                if (!empty($text)) {
                    $contents[] = [
                        'role' => $role,
                        'parts' => [
                            ['text' => $text]
                        ]
                    ];
                }
            }

            if (empty($contents)) {
                return response()->json([
                    'error' => 'Tidak ada pesan yang valid untuk diproses.'
                ], 400);
            }

            $apiKey = env('GEMINI_API_KEY');

            if (!$apiKey) {
                \Log::error('GEMINI_API_KEY not set');
                return response()->json([
                    'error' => 'API key tidak dikonfigurasi.'
                ], 500);
            }

            $payload = [
                'contents' => $contents
            ];

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-lite:generateContent?key={$apiKey}", $payload);

            if (!$response->ok()) {
                $status = $response->status();
                $body = $response->body();
                \Log::error('Gemini API error', [
                    'status' => $status,
                    'body' => $body,
                    'payload' => $payload
                ]);

                $errorMessage = 'Layanan Gemini tidak tersedia saat ini.';
                if ($status === 429) {
                    $errorMessage = 'Kuota Gemini habis. Silakan cek billing/plan Google Cloud atau gunakan API key dengan quota lebih besar.';
                } elseif ($status === 403) {
                    $errorMessage = 'API key Gemini tidak memiliki izin atau sudah diblokir. Silakan periksa key dan billing Google Cloud Anda.';
                }

                return response()->json([
                    'error' => $errorMessage,
                    'details' => $body,
                ], $status);
            }

            $data = $response->json();

            // Handle different response formats
            $output = null;
            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                $output = $data['candidates'][0]['content']['parts'][0]['text'];
            } elseif (isset($data['candidates'][0]['content'][0]['text'])) {
                $output = $data['candidates'][0]['content'][0]['text'];
            } elseif (isset($data['output'][0]['content'][0]['text'])) {
                $output = $data['output'][0]['content'][0]['text'];
            }

            if (!$output) {
                \Log::warning('No output from Gemini', ['response' => $data]);
                return response()->json([
                    'error' => 'Tidak ada respons yang diterima dari Gemini.',
                    'details' => $data,
                ], 500);
            }

            return response()->json(['text' => $output]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'error' => 'Data request tidak valid.',
                'details' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            \Log::error('BkAssistant error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Terjadi kesalahan internal server.'
            ], 500);
        }
    }
}
