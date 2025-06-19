<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('admin');

        // Create staff user
        $staff = User::updateOrCreate(
            ['email' => 'staff@example.com'],
            [
                'name' => 'Staff User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $staff->assignRole('staff');

        // Create wholeseller user
        $wholeseller = User::updateOrCreate(
            ['email' => 'wholeseller@example.com'],
            [
                'name' => 'Wholeseller User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $wholeseller->assignRole('wholeseller');

        // Create seller user
        $seller = User::updateOrCreate(
            ['email' => 'seller@example.com'],
            [
                'name' => 'Seller User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $seller->assignRole('seller');

        // Create customer user
        $customer = User::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'name' => 'Customer User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $customer->assignRole('customer');

        // Create regular user
        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $user->assignRole('user');

        // Create additional test users with different scenarios
        $unverifiedUser = User::updateOrCreate(
            ['email' => 'unverified@example.com'],
            [
                'name' => 'Unverified User',
                'password' => Hash::make('password'),
                'email_verified_at' => null, // Not verified
            ]
        );
        $unverifiedUser->assignRole('user');

        // Create multiple users for testing
        $this->createTestUsers();
    }

    /**
     * Create additional test users for development
     */
    private function createTestUsers(): void
    {
        $testUsers = [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'role' => 'customer',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'role' => 'seller',
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob@example.com',
                'role' => 'wholeseller',
            ],
            [
                'name' => 'Alice Brown',
                'email' => 'alice@example.com',
                'role' => 'staff',
            ],
            [
                'name' => 'Charlie Wilson',
                'email' => 'charlie@example.com',
                'role' => 'user',
            ],
        ];

        foreach ($testUsers as $userData) {
            $user = User::updateOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );
            $user->assignRole($userData['role']);
        }
    }
} 