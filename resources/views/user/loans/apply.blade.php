@extends('layouts.app')

@section('title', 'Apply for a Loan')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-white">Apply for a Loan</h1>
    <p class="text-slate-300 mt-1">Fill out the form below to request a new loan.</p>
</div>

<div class="bg-primary rounded-xl shadow-sm border border-slate-700 p-6 max-w-3xl">
    <form action="{{ route('user.loans.store') }}" method="POST" class="space-y-6" x-data="loanCalculator()">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Requested Amount (₱)</label>
                <input type="number" name="loan_amount" x-model.number="amount" min="1000" max="1000000" required placeholder="e.g. 10000" class="w-full bg-primary-dark border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent">
                @error('loan_amount')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Loan Term (Months)</label>
                <select name="loan_term" x-model.number="term" class="w-full bg-primary-dark border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent">
                    <option value="3">3 Months</option>
                    <option value="6">6 Months</option>
                    <option value="12">12 Months</option>
                    <option value="24">24 Months</option>
                </select>
                @error('loan_term')
                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-300 mb-2">Purpose of Loan</label>
            <textarea name="purpose" rows="4" placeholder="Briefly describe why you need this loan..." class="w-full bg-primary-dark border border-slate-700 text-white rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-gold focus:border-transparent"></textarea>
            @error('purpose')
                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Dynamic Loan Calculator Summary -->
        <div class="bg-primary-dark/50 p-4 rounded-lg border border-gold/30" x-show="amount >= 1000" x-transition>
            <h3 class="font-medium text-gold mb-3 text-sm uppercase tracking-wider">Loan Summary Estimate</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                <div>
                    <p class="text-xs text-slate-400">Interest Rate</p>
                    <p class="font-bold text-white"><span x-text="interestRate"></span>% / yr</p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Total Interest</p>
                    <p class="font-bold text-white">₱<span x-text="calculateTotalInterest()"></span></p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Total to Repay</p>
                    <p class="font-bold text-gold">₱<span x-text="calculateTotalRepayment()"></span></p>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Monthly Payment</p>
                    <p class="font-bold text-green-400 text-lg">₱<span x-text="calculateMonthlyPayment()"></span></p>
                </div>
            </div>
        </div>

        <div class="bg-primary-dark p-4 rounded-lg border border-slate-700">
            <h3 class="font-medium text-white mb-2">Terms and Conditions</h3>
            <p class="text-xs text-slate-300 mb-3">By applying for this loan, you agree to the standard interest rates and understand that late payments may incur additional penalty fees.</p>
            <label class="flex items-center">
                <input type="checkbox" name="terms" required class="rounded border-slate-600 text-gold focus:ring-gold bg-primary w-4 h-4 mr-2">
                <span class="text-sm text-slate-300">I agree to the terms and conditions</span>
            </label>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" class="bg-gold text-primary-dark hover-bg-gold font-bold px-8 py-3 rounded-xl transition shadow-md flex items-center gap-2">
                <i class="fas fa-paper-plane"></i> Submit Application
            </button>
        </div>
    </form>
</div>

<script>
    function loanCalculator() {
        return {
            amount: '',
            term: 3,
            interestRate: {{ $defaultInterestRate ?? 8.5 }},
            
            calculateTotalInterest() {
                if (!this.amount || this.amount < 1000) return '0.00';
                // Using simple interest for display: (P * R * T) / (100 * 12)
                let interest = (this.amount * this.interestRate * this.term) / (100 * 12);
                return interest.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            },
            
            calculateTotalRepayment() {
                if (!this.amount || this.amount < 1000) return '0.00';
                let interest = (this.amount * this.interestRate * this.term) / (100 * 12);
                let total = parseFloat(this.amount) + interest;
                return total.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            },
            
            calculateMonthlyPayment() {
                if (!this.amount || this.amount < 1000) return '0.00';
                
                // Amortized monthly payment formula: PMT = P * [r(1+r)^n] / [(1+r)^n - 1]
                let monthlyRate = (this.interestRate / 100) / 12;
                if (monthlyRate === 0) {
                    return (this.amount / this.term).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                }
                
                let numerator = this.amount * (monthlyRate * Math.pow(1 + monthlyRate, this.term));
                let denominator = Math.pow(1 + monthlyRate, this.term) - 1;
                let monthly = numerator / denominator;
                
                return monthly.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
            }
        }
    }
</script>
</div>
@endsection
