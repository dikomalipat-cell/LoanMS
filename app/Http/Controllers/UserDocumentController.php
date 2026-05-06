<?php

namespace App\Http\Controllers;

class UserDocumentController extends Controller
{
    public function upload()
    {
        return view('user.documents.upload');
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'document_type' => 'required|string',
            'document_file' => 'required|file|max:10240', // 10MB
        ]);

        // Logic to store file would go here (e.g. $request->file('document_file')->store('documents'))

        return redirect()->route('dashboard')->with('success', 'Document uploaded successfully and is now pending review.');
    }

    public function submitted()
    {
        return view('user.documents.submitted');
    }
}
