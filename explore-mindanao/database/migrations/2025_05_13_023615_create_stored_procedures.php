<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateStoredProcedures extends Migration
{
    public function up()
    {
        // First drop the procedure if it exists
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_process_booking');
        
        // Then create the procedure without DELIMITER statements
        DB::unprepared('
            CREATE PROCEDURE sp_process_booking(
                IN p_booking_type VARCHAR(50),
                IN p_id INT,
                IN p_payment_method VARCHAR(50),
                IN p_amount DECIMAL(10,2)
            )
            BEGIN
                DECLARE v_transaction_id VARCHAR(255);
                DECLARE v_status VARCHAR(50);
                
                -- Generate a random transaction ID
                SET v_transaction_id = CONCAT("TXN-", FLOOR(RAND() * 1000000));
                SET v_status = "completed";
                
                -- Create payment record
                INSERT INTO payments (
                    booking_id,
                    booking_type,
                    amount,
                    payment_method,
                    transaction_id,
                    status,
                    created_at,
                    updated_at
                ) VALUES (
                    p_id,
                    p_booking_type,
                    p_amount,
                    p_payment_method,
                    v_transaction_id,
                    v_status,
                    NOW(),
                    NOW()
                );
                
                -- Update booking status based on booking type
                IF p_booking_type = "standard" THEN
                    UPDATE bookings SET status = "confirmed", updated_at = NOW() WHERE id = p_id;
                ELSEIF p_booking_type = "package" THEN
                    UPDATE bookings_packages SET status = "confirmed", updated_at = NOW() WHERE id = p_id;
                END IF;
            END
        ');

        // Add other stored procedures similarly...
    }

    public function down()
    {
        // Drop procedures if rolled back
        DB::unprepared('DROP PROCEDURE IF EXISTS sp_process_booking');
        // Drop other procedures...
    }
}