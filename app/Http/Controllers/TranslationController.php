<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TranslationController extends Controller
{
    private $languages = ['en', 'fr', 'es', 'ar'];

    public function index()
    {
        // Auto-sync missing keys before showing translations
        $synced = $this->syncMissingKeys();
        
        $translations = $this->getAllTranslations();
        
        $message = null;
        if (!empty($synced)) {
            $totalSynced = array_sum($synced);
            $message = "Auto-synced {$totalSynced} missing translation keys across " . count($synced) . " files.";
        }
        
        return view('admin.translations.index', compact('translations', 'message'));
    }

    public function update(Request $request)
    {
        $locale = $request->locale;
        $file = $request->file;
        $translations = $request->translations;

        $path = lang_path("{$locale}/{$file}.php");
        
        if (File::exists($path)) {
            $content = "<?php\n\nreturn " . var_export($translations, true) . ";\n";
            File::put($path, $content);
        }

        return back()->with('success', 'Translations updated successfully!');
    }

    public function translateWithAI(Request $request)
    {
        try {
            $sourcePath = lang_path("en/{$request->file}.php");
            $sourceTranslations = include $sourcePath;
            
            $apiKey = config('services.gemini.api_key');
            $targetLanguage = ['fr' => 'French', 'es' => 'Spanish', 'ar' => 'Arabic'][$request->locale];
            
            $prompt = "Translate the following PHP array values to {$targetLanguage}. Return ONLY a JSON object with the same keys but translated values. Do not include any explanations or code blocks:\n\n" . json_encode($sourceTranslations);
            
            $requestData = [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => $prompt
                            ]
                        ]
                    ]
                ]
            ];
            
            $response = \Illuminate\Support\Facades\Http::timeout(30)
                ->withHeaders([
                    'Content-Type' => 'application/json',
                    'x-goog-api-key' => $apiKey
                ])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent", $requestData);
            
            if ($response->successful()) {
                $responseData = $response->json();
                $translatedText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? '';
                // Remove markdown code blocks
                $cleanText = preg_replace('/```json\s*/', '', $translatedText);
                $cleanText = preg_replace('/\s*```/', '', $cleanText);
                $translatedArray = json_decode(trim($cleanText), true);
                
                if ($translatedArray) {
                    $targetPath = lang_path("{$request->locale}/{$request->file}.php");
                    $content = "<?php\n\nreturn " . var_export($translatedArray, true) . ";\n";
                    File::put($targetPath, $content);
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Translation completed and saved!',
                        'translations' => $translatedArray
                    ]);
                }
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Translation failed',
                'response_status' => $response->status(),
                'response_body' => $response->json(),
                'translated_text' => $translatedText ?? 'No text',
                'json_decode_result' => $translatedArray ?? 'Failed to decode'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    public function syncMissingKeys()
    {
        $synced = [];
        
        foreach ($this->languages as $locale) {
            if ($locale === 'en') continue; // Skip English as it's the source
            
            $langPath = lang_path($locale);
            if (!File::isDirectory($langPath)) {
                File::makeDirectory($langPath, 0755, true);
            }
            
            $enPath = lang_path('en');
            $enFiles = File::files($enPath);
            
            foreach ($enFiles as $enFile) {
                $filename = $enFile->getFilenameWithoutExtension();
                $targetPath = lang_path("{$locale}/{$filename}.php");
                
                $enTranslations = include $enFile->getPathname();
                $targetTranslations = File::exists($targetPath) ? include $targetPath : [];
                
                // Find missing keys
                $missingKeys = array_diff_key($enTranslations, $targetTranslations);
                
                if (!empty($missingKeys)) {
                    // Add missing keys with English values as placeholders
                    $updatedTranslations = array_merge($targetTranslations, $missingKeys);
                    
                    // Sort by keys to match English file order
                    $sortedTranslations = [];
                    foreach (array_keys($enTranslations) as $key) {
                        if (isset($updatedTranslations[$key])) {
                            $sortedTranslations[$key] = $updatedTranslations[$key];
                        }
                    }
                    
                    $content = "<?php\n\nreturn " . var_export($sortedTranslations, true) . ";\n";
                    File::put($targetPath, $content);
                    
                    $synced["{$locale}/{$filename}"] = count($missingKeys);
                }
            }
        }
        
        return $synced;
    }

    public function translateAllFiles(Request $request)
    {
        try {
            $locale = $request->locale;
            $apiKey = config('services.gemini.api_key');
            $targetLanguage = ['fr' => 'French', 'es' => 'Spanish', 'ar' => 'Arabic'][$locale];
            
            $enPath = lang_path('en');
            $files = File::files($enPath);
            $results = [];
            
            foreach ($files as $file) {
                $filename = $file->getFilenameWithoutExtension();
                $sourceTranslations = include $file->getPathname();
                
                $prompt = "Translate the following PHP array values to {$targetLanguage}. Return ONLY a JSON object with the same keys but translated values. Do not include any explanations or code blocks:\n\n" . json_encode($sourceTranslations);
                
                $requestData = [
                    'contents' => [
                        [
                            'parts' => [
                                [
                                    'text' => $prompt
                                ]
                            ]
                        ]
                    ]
                ];
                
                $response = \Illuminate\Support\Facades\Http::timeout(30)
                    ->withHeaders([
                        'Content-Type' => 'application/json',
                        'x-goog-api-key' => $apiKey
                    ])
                    ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent", $requestData);
                
                if ($response->successful()) {
                    $responseData = $response->json();
                    $translatedText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? '';
                    $cleanText = preg_replace('/```json\s*/', '', $translatedText);
                    $cleanText = preg_replace('/\s*```/', '', $cleanText);
                    $translatedArray = json_decode(trim($cleanText), true);
                    
                    if ($translatedArray) {
                        $targetPath = lang_path("{$locale}/{$filename}.php");
                        $content = "<?php\n\nreturn " . var_export($translatedArray, true) . ";\n";
                        File::put($targetPath, $content);
                        $results[] = $filename;
                    }
                }
            }
            
            return response()->json([
                'success' => true,
                'message' => 'All files translated successfully!',
                'files' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function getAllTranslations()
    {
        $result = [];
        
        foreach ($this->languages as $locale) {
            $langPath = lang_path($locale);
            if (File::isDirectory($langPath)) {
                $files = File::files($langPath);
                foreach ($files as $file) {
                    $filename = $file->getFilenameWithoutExtension();
                    $result[$locale][$filename] = include $file->getPathname();
                }
            }
        }
        
        return $result;
    }
}