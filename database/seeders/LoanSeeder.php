<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LoanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get an admin and staff user for associations
        $admin = User::where('role', 'admin')->first();
        $staff = User::where('role', 'staff')->first();

        // Sample data for John Doe
        $this->createSampleUserWithLoan(
            'John Doe',
            'john@example.com',
            15000,
            '09123456789',
            'Male',
            $admin,
            $staff
        );

        // Sample data for Jane Smith
        $this->createSampleUserWithLoan(
            'Jane Smith',
            'jane@example.com',
            25000,
            '09987654321',
            'Female',
            $admin,
            $staff
        );
    }

    /**
     * Helper to create a user, client, loan, and payment.
     */
    private function createSampleUserWithLoan($name, $email, $amount, $phone, $gender, $admin, $staff)
    {
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make('password'),
                'role' => 'user',
                'is_admin' => false,
            ]
        );

        // Client profile
        $client = Client::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $phone,
                'address' => '123 Sample St, Metro Manila',
                'gender' => $gender,
                'birthdate' => '1992-05-15',
                'age' => 31,
                'status' => 'approved',
                'admin_id' => $admin?->id,
            ]
        );

        // Loan
        $interestRate = 5;
        $totalPayment = $amount + ($amount * ($interestRate / 100));
        $monthlyPayment = $totalPayment / 6;

        $loan = Loan::create([
            'user_id' => $user->id,
            'loan_amount' => $amount,
            'interest_rate' => $interestRate,
            'total_payment' => $totalPayment,
            'monthly_payment' => $monthlyPayment,
            'loan_term' => 6,
            'status' => 'approved',
            'approved_by' => $admin?->id,
            'disbursement_date' => Carbon::now()->subMonths(2),
            'start_date' => Carbon::now()->subMonths(2),
            'end_date' => Carbon::now()->addMonths(4),
        ]);

        // One payment made
        Payment::create([
            'loan_id' => $loan->id,
            'amount_paid' => $monthlyPayment,
            'remaining_balance' => $totalPayment - $monthlyPayment,
            'payment_date' => Carbon::now()->subMonth(),
            'received_by' => $staff?->id,
            'payment_method' => 'Bank Transfer',
            'reference_number' => 'BT'.rand(100000, 999999),
            'notes' => 'First installment',
        ]);

        // Update client fields to match
        $client->update([
            'loan_amount' => $amount,
            'balance' => $totalPayment - $monthlyPayment,
            'loan_date' => $loan->start_date,
            'due_date' => Carbon::now()->addMonth(),
        ]);
    }
}
