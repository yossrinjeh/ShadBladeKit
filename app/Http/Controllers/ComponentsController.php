<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComponentsController extends Controller
{
    public function index()
    {
        return view('components.showcase');
    }
    
    public function fileUpload(Request $request)
    {
        // Handle file upload demo
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            $uploadedFiles = [];
            
            foreach ($files as $file) {
                $uploadedFiles[] = [
                    'name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'type' => $file->getMimeType()
                ];
            }
            
            return back()->with('uploaded_files', $uploadedFiles);
        }
        
        return back();
    }
    
    public function richContent(Request $request)
    {
        $request->validate([
            'content' => 'required'
        ]);
        
        return back()->with('saved_content', $request->content);
    }
}
