ALTER TABLE `reservation`
ADD CONSTRAINT `reservation_ibfk_2`
FOREIGN KEY (`cinema_id`) REFERENCES `cinema` (`number`) ON DELETE CASCADE;