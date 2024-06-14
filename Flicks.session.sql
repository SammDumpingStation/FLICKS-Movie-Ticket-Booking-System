-- SELECT * FROM movie;
-- SELECT * FROM movie_status;


-- -- UPDATE movie
-- -- SET dimension = '2D'
-- -- WHERE id = 2024005;


-- SELECT movie.*, movie_status.* 
-- FROM movie
-- JOIN movie_status
-- ON movie.id = movie_status.movie_id
-- WHERE movie_status.status = 'next picture';