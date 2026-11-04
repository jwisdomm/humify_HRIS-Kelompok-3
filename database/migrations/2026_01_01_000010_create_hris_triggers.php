<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (DB::getDriverName() === 'sqlite') {
            return;
        }

        DB::unprepared("
            CREATE TRIGGER trg_validate_attendance_shift_insert
            BEFORE INSERT ON attendances
            FOR EACH ROW
            BEGIN
                DECLARE v_is_shift_worker BOOLEAN DEFAULT NULL;
                DECLARE v_category VARCHAR(20) DEFAULT NULL;

                IF NEW.shift_id IS NOT NULL THEN
                    SELECT is_shift_worker
                      INTO v_is_shift_worker
                      FROM employees
                     WHERE id = NEW.employee_id;

                    SELECT category
                      INTO v_category
                      FROM work_shifts
                     WHERE id = NEW.shift_id;

                    IF v_is_shift_worker = TRUE AND v_category <> 'shifting' THEN
                        SIGNAL SQLSTATE '45000'
                            SET MESSAGE_TEXT = 'Karyawan shifting hanya boleh memilih shift shifting';
                    ELSEIF v_is_shift_worker = FALSE AND v_category <> 'regular' THEN
                        SIGNAL SQLSTATE '45000'
                            SET MESSAGE_TEXT = 'Karyawan regular hanya boleh memilih shift regular';
                    END IF;
                END IF;
            END;
        ");

        DB::unprepared("
            CREATE TRIGGER trg_validate_attendance_shift_update
            BEFORE UPDATE ON attendances
            FOR EACH ROW
            BEGIN
                DECLARE v_is_shift_worker BOOLEAN DEFAULT NULL;
                DECLARE v_category VARCHAR(20) DEFAULT NULL;

                IF NEW.shift_id IS NOT NULL THEN
                    SELECT is_shift_worker
                      INTO v_is_shift_worker
                      FROM employees
                     WHERE id = NEW.employee_id;

                    SELECT category
                      INTO v_category
                      FROM work_shifts
                     WHERE id = NEW.shift_id;

                    IF v_is_shift_worker = TRUE AND v_category <> 'shifting' THEN
                        SIGNAL SQLSTATE '45000'
                            SET MESSAGE_TEXT = 'Karyawan shifting hanya boleh memilih shift shifting';
                    ELSEIF v_is_shift_worker = FALSE AND v_category <> 'regular' THEN
                        SIGNAL SQLSTATE '45000'
                            SET MESSAGE_TEXT = 'Karyawan regular hanya boleh memilih shift regular';
                    END IF;
                END IF;
            END;
        ");

        DB::unprepared("
            CREATE TRIGGER trg_apply_leave_balance
            AFTER UPDATE ON leave_requests
            FOR EACH ROW
            BEGIN
                DECLARE v_date DATE;

                IF NEW.status = 'disetujui' AND OLD.status <> 'disetujui' THEN

                    UPDATE leave_balances
                       SET used_days = used_days + NEW.total_days
                     WHERE employee_id = NEW.employee_id
                       AND leave_type_id = NEW.leave_type_id
                       AND `year` = YEAR(NEW.start_date);

                    SET v_date = NEW.start_date;

                    WHILE v_date <= NEW.end_date DO
                        INSERT INTO attendances (employee_id, attendance_date, status)
                        VALUES (NEW.employee_id, v_date, 'cuti')
                        ON DUPLICATE KEY UPDATE status = 'cuti';

                        SET v_date = DATE_ADD(v_date, INTERVAL 1 DAY);
                    END WHILE;

                END IF;

                IF OLD.status = 'disetujui'
                   AND NEW.status IN ('ditolak', 'dibatalkan') THEN

                    UPDATE leave_balances
                       SET used_days = used_days - OLD.total_days
                     WHERE employee_id = OLD.employee_id
                       AND leave_type_id = OLD.leave_type_id
                       AND `year` = YEAR(OLD.start_date);

                END IF;
            END;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_validate_attendance_shift_insert;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_validate_attendance_shift_update;');
        DB::unprepared('DROP TRIGGER IF EXISTS trg_apply_leave_balance;');
    }
};
