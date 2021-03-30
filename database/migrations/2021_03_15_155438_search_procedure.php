<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//use DB;

class SearchProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE PROCEDURE search_product(IN lat_user VARCHAR(255), IN lng_user VARCHAR(255), IN country_user VARCHAR(50), IN query_search VARCHAR(255) )
            BEGIN
                SELECT *, (6371 * ACOS( SIN( RADIANS(lat)) * SIN( RADIANS(lat_user)) + COS( RADIANS(lng - -lng_user)) * COS( RADIANS(lat)) * COS( RADIANS(lat_user)) )
                ) AS distance
                FROM farma.stores
                INNER JOIN farma.products
                ON products.store_id = stores.id
                WHERE products.name LIKE query_search
                OR products.components LIKE query_search
                AND stores.country=country_user
                ORDER BY distance ASC;
            END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP PROCEDURE IF EXISTS search_product');
    }
}
