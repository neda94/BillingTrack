<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkorderItemAmountsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'workorder_item_amounts';

    /**
     * Run the migrations.
     * @table workorder_item_amounts
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('item_id');
            $table->decimal('subtotal', 20, 4)->default('0.0000');
            $table->decimal('tax_1', 20, 4)->default('0.0000');
            $table->decimal('tax_2', 20, 4)->default('0.0000');
            $table->decimal('tax', 20, 4)->default('0.0000');
            $table->decimal('total', 20, 4)->default('0.0000');

            $table->index(["item_id"], 'workorder_item_amounts_item_id_index');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('item_id', 'workorder_item_amounts_item_id_index')
                ->references('id')->on('workorder_items')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
