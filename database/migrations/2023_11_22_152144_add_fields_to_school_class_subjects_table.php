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
        Schema::table('school_class_subjects', function (Blueprint $table) {
            $table->dropConstrainedForeignId('class_group_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('school_class_subjects', function (Blueprint $table) {
            $table->after('school_class_section_id', function (Blueprint $table) {
                $table->foreignId('class_group_id')->nullable()->constrained()->cascadeOnDelete();
            });
        });
    }
};
