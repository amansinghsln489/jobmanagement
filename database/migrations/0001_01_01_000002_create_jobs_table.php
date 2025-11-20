<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Creator
            $table->string('title', 150)->index();
            $table->string('company', 150)->index();
            $table->string('location', 150)->index();
            $table->text('description');
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('job_type', ['Full-time', 'Part-time', 'Contract'])->index();
            $table->timestamp('posted_at')->useCurrent()->index();

            $table->timestamps();
            $table->softDeletes(); // For Soft Delete

            // Composite Index for efficient searching
            $table->index(['title', 'company', 'location']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};