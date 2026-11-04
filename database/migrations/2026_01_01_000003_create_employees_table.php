<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->char('id', 36)->primary();
            $table->string('employee_code', 30)->unique();
            $table->string('full_name', 150);
            $table->string('email', 150)->nullable()->unique();
            $table->string('phone', 20)->nullable();
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->string('birth_place', 100)->nullable();
            $table->date('birth_date')->nullable();
            $table->text('address')->nullable();
            $table->text('photo_url')->nullable();

            $table->text('face_reference_photo_url')->nullable();
            $table->dateTime('face_registered_at')->nullable();

            $table->unsignedInteger('department_id')->nullable();
            $table->unsignedInteger('position_id')->nullable();
            $table->char('supervisor_id', 36)->nullable();

            $table->enum('employment_type', ['tetap', 'kontrak', 'magang', 'harian'])->default('tetap');
            $table->enum('employee_status', ['aktif', 'nonaktif', 'resign', 'cuti_panjang'])->default('aktif');
            $table->boolean('is_shift_worker')->default(false);

            $table->date('hire_date');
            $table->date('resign_date')->nullable();

            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();

            $table->foreign('department_id', 'fk_employees_department')
                ->references('id')
                ->on('departments')
                ->nullOnDelete();

            $table->foreign('position_id', 'fk_employees_position')
                ->references('id')
                ->on('positions')
                ->nullOnDelete();

            $table->index('department_id', 'idx_employees_department');
            $table->index('employee_status', 'idx_employees_status');
        });

        // Supervisor self-referencing foreign key
        Schema::table('employees', function (Blueprint $table) {
            $table->foreign('supervisor_id', 'fk_employees_supervisor')
                ->references('id')
                ->on('employees')
                ->nullOnDelete();
        });

        // Check constraint
        DB::statement('ALTER TABLE employees ADD CONSTRAINT chk_employees_resign_date CHECK (resign_date IS NULL OR resign_date >= hire_date)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};

