@extends('layouts.app')

@section('title', 'Upload Documents')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Upload Documents</h1>
    <p class="text-slate-300 mt-1">Submit required documents for your loan application.</p>
</div>

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6 max-w-2xl">
    <form action="{{ route('user.documents.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Document Type</label>
            <select name="document_type" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <option value="id">Valid ID (Government Issued)</option>
                <option value="proof_of_income">Proof of Income (Payslip / COE)</option>
                <option value="proof_of_billing">Proof of Billing</option>
                <option value="other">Other Supporting Document</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Select File</label>
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:bg-primary-dark transition cursor-pointer relative">
                <input type="file" name="document_file" required class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                <i class="fas fa-file-upload text-4xl text-gray-400 mb-3"></i>
                <p class="text-sm text-slate-300 font-medium">Click to browse or drag file here</p>
                <p class="text-xs text-gray-400 mt-1">Supported formats: PDF, JPG, PNG (Max 10MB)</p>
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Notes (Optional)</label>
            <textarea name="notes" rows="3" placeholder="Add any comments about this document..." class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
        </div>

        <div class="flex justify-end pt-2">
            <button type="submit" class="bg-gold text-primary-dark hover-bg-gold text-white px-6 py-2 rounded-lg font-medium transition w-full sm:w-auto">
                <i class="fas fa-upload mr-2"></i> Upload Document
            </button>
        </div>
    </form>
</div>
@endsection
