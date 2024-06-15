SELECT reservation.*, customer.first_name, customer.last_name, customer.user_type
FROM reservation
JOIN customer
ON reservation.customer_id = customer.id
WHERE reservation.status = 'pending';

