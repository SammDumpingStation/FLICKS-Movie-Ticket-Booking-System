-- INSERT INTO cinema (number, movie_id)
-- VALUES (1, 2024001);

-- ALTER TABLE cinema MODIFY COLUMN time_start TIME;
-- ALTER TABLE cinema MODIFY COLUMN time_end TIME;
-- SELECT movie.id, movie.title, movie.poster, movie.length FROM movie JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'now showing';
-- SELECT * FROM cinema
-- SELECT movie.id, movie.title, COALESCE(cinema.time_start, 'Not yet Set'), movie_status.status
-- FROM movie 
-- LEFT JOIN cinema 
-- ON movie.id = cinema.movie_id
-- LEFT JOIN movie_status
-- ON movie.id = movie_status.movie_id
-- WHERE movie_status.status = 'now showing';
SELECT movie.id, movie.title, cinema.time_start, cinema.time_end FROM movie JOIN cinema ON movie.id = cinema.movie_id;
-- SELECT movie.id, movie.title, movie.poster, movie.length FROM movie JOIN movie_status ON movie.id = movie_status.movie_id WHERE movie_status.status = 'now showing';
-- SELECT movie.id, movie.title, COALESCE(cinema.time_start, 'Not yet Set') AS start_time FROM movie  LEFT JOIN cinema ON movie.id = cinema.movie_id WHERE movie.id = 2024001;
-- SELECT length FROM movie WHERE title = 'Furiosa: A Mad Max Movie';

-- SELECT movie.title, cinema.number, cinema.time_start 
-- FROM movie 
-- LEFT JOIN cinema 
-- ON movie.id = cinema.movie_id
-- WHERE 

-- SELECT movie.id, movie.title, movie.poster, movie_status.status, movie.length, cinema.number 
-- FROM movie 
-- JOIN movie_status 
-- ON movie.id = movie_status.movie_id 
-- LEFT JOIN cinema
-- ON movie_status.movie_id = cinema.movie_id
-- WHERE movie_status.status = 'now showing';
