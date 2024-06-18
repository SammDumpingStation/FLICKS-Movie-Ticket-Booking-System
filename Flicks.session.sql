ALTER TABLE payment ADD CONSTRAINT payment_ibfk_1 FOREIGN KEY (reservation_id)
REFERENCES reservation(id) ON DELETE CASCADE; -- Add the modified foreign key constraint with ON DELETE CASCADE
