<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();

            $table->unsignedBigInteger('status')->nullable();
            $table->foreign('status')
                ->references('id')->on('statuses')
                ->onDelete('set null');

            $table->unsignedBigInteger('workspace')->nullable();
            $table->foreign('workspace')
                ->references('id')->on('workspaces')
                ->onDelete('cascade');

            $table->unsignedBigInteger('priority')->nullable();
            $table->foreign('priority')
                ->references('id')->on('priorities')
                ->onDelete('set null');

            $table->string('name')->nullable();
            $table->text('description')->nullable();

            $table->text('project')->nullable();

            $table->integer('due_date')->nullable();

            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            $table->string('task_duration')->nullable();

            $table->string('task_finish_duration')->nullable();

            $table->timestamp('finish_start_date')->nullable();
            $table->timestamp('finish_end_date')->nullable();


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
