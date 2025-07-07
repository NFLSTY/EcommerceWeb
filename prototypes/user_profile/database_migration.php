<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Add new columns for profile information
            $table->string('phone', 20)->nullable()->after('email');
            $table->string('profile_image')->nullable()->after('password');
            $table->date('date_of_birth')->nullable()->after('profile_image');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            
            // Address fields
            $table->text('address')->nullable()->after('gender');
            $table->string('city', 100)->nullable()->after('address');
            $table->string('state', 100)->nullable()->after('city');
            $table->string('postal_code', 20)->nullable()->after('state');
            $table->string('country', 100)->nullable()->after('postal_code');
            
            // Notification preferences (optional)
            $table->boolean('email_notifications')->default(true)->after('country');
            $table->boolean('sms_notifications')->default(false)->after('email_notifications');
            $table->boolean('push_notifications')->default(true)->after('sms_notifications');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'profile_image',
                'date_of_birth',
                'gender',
                'address',
                'city',
                'state',
                'postal_code',
                'country',
                'email_notifications',
                'sms_notifications',
                'push_notifications'
            ]);
        });
    }
};

/*
To create this migration, run:
php artisan make:migration add_profile_fields_to_users_table --table=users

Then replace the content with the code above and run:
php artisan migrate
*/