<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {


            // Data
            $table->string('document')->unique();
            $table->string('document_voter', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('civil_status')->nullable();

            // Income
            $table->string('occupation')->nullable();

            // address
            $table->string('zipcode')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('complement')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();

            // contact
            $table->string('telephone')->nullable();
            $table->string('cell')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {

            // Data
            $table->dropColumn('document');
            $table->dropColumn('document_voter');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('civil_status');

            // Income
            $table->dropColumn('occupation');

            // address
            $table->dropColumn('zipcode');
            $table->dropColumn('street');
            $table->dropColumn('number');
            $table->dropColumn('complement');
            $table->dropColumn('neighborhood');
            $table->dropColumn('state');
            $table->dropColumn('city');

            // contact
            $table->dropColumn('telephone');
            $table->dropColumn('cell');

        });
    }
}
