<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration{
  public function up(){
    Schema::create('users', function (Blueprint $table){
      $table->engine = 'InnoDB';
      $table->increments('id');
      $table->string('name');
      $table->string('email')->unique();
      $table->string('password');
      $table->rememberToken();
      $table->timestamps();
    });
  }

  public function down(){
    Schema::dropIfExists('users');
  }
}

class CreateCustomerTable extends Migration{
  public function up(){
    Schema::create('Customer', function(Blueprint $table){
      $table->engine='InnoDB';
      $table->increments('id');
      $table->string('name', 100)->index();
      $table->string('membership', 7)->unique();
      $table->text('address')->nullable();
      $table->char('state', 2)->index();
    });
  }
  public function down(){
    Schema::dropIfExists('Customer');
  }

  class AlterOrInsert extends Migration{
    public up(){
      Schema::table('customer', function (Blueprint $table){
        $table->string('phone', 20)->after('state');
        $table->unsignedInteger('division_id')->after('phone');

        $table->foreign('division_id')
          ->references('id')->on('divisions');
      });

      DB::table('customer')->insert([
        'name' => 'Parti Ayam',
        'created_at' => '1976-08-19 11:20:12',
        'updated_at' => '1976-08-19 11:20:12',
      ]);
    }
    public function down(){

    }
  }

  class CreatePivotTable extends Migration{
    public function up(){
      Schema::create('customer_division', function(Blueprint $table){
        $table->unsignedInteger('customer_id');
        $table->unsignedInteger('division_id');
        $table->foreign('customer_id')
          ->references('id')->on('customers');
        $talbe->foreign('division_id')
          ->references('id')->on('divisions');
      });
    }
    public function down(){

    }
  }

class CreateUsersAccount extends Migration{
  public function up(){
    DB::table('users')->insert([
      'email' => 'admin@admin.com',
      'password' => bcrypt('123'),
      'name' => 'SOMEONE NAME',
    ]);
  }
  public function down(){

  }
}
