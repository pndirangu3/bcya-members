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
        Schema::create('members', function (Blueprint $table) {
            $table->id();

$table->string('membership_no')->unique();

$table->string('first_name');
$table->string('middle_name')->nullable();
$table->string('last_name');

$table->date('date_of_birth')->nullable();

$table->enum('gender',['Male','Female']);

$table->string('phone')->nullable();
$table->string('email')->nullable();

$table->string('national_id')->nullable();

$table->string('payam');
$table->string('boma');
$table->string('clan');
$table->string('section');

$table->string('photo')->nullable();

$table->longText('fingerprint_template')->nullable();

$table->enum('status',['Pending','Approved','Rejected'])
      ->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
