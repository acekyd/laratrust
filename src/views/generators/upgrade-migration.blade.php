<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class LaratrustUpgradeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for associating permissions to users (Many-to-Many)
        Schema::create('{{ $laratrust['permission_user_table'] }}', function (Blueprint $table) {
            $table->integer('{{ $laratrust['permission_foreign_key'] }}')->unsigned();
            $table->integer('{{ $laratrust['user_foreign_key'] }}')->unsigned();

            $table->foreign('{{ $laratrust['permission_foreign_key'] }}')->references('id')->on('{{ $laratrust['permissions_table'] }}')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('{{ $laratrust['user_foreign_key'] }}')->references('{{ $user->getKeyName() }}')->on('{{ $user->getTable() }}')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['{{ $laratrust['permission_foreign_key'] }}', '{{ $laratrust['user_foreign_key'] }}']);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('{{ $laratrust['permission_user_table'] }}');
    }
}
