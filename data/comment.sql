CREATE TABLE commentlist (
  commentID Serial Primary Key,
  userID int,
  city TEXT,
  content TEXT
);


INSERT INTO commentlist (userID, city, content) VALUES
(1, 'Oslo', 'Expensive, but very interesting, nordic place'),
(2, 'Oslo', 'People and weather are both cold'),
(1, 'Bangkok', 'Best Party place - highly recommended')


