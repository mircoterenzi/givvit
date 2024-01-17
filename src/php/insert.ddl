-- Insert sample data into user_profile table
INSERT INTO user_profile (user_id, user_name, first_name, last_name, password, salt, description, profile_img)
VALUES
(1, 'john_doe', 'John', 'Doe', 'hashed_password_1', 'a', 'Sample user description 1', 'profile_img_1.jpg'),
(2, 'jane_smith', 'Jane', 'Smith', 'hashed_password_2', 'b', 'Sample user description 2', 'profile_img_2.jpg');

-- Insert sample data into topic table
INSERT INTO topic (name)
VALUES
('Technology'),
('Art'),
('Healthcare');

-- Insert sample data into post table
INSERT INTO post (post_id, short_description, long_description, amount_requested, date, closed, user, topic)
VALUES
(1, 'Tech Project', 'This is a sample tech project description.', 500, '2024-01-01', 0, 1, 'Technology'),
(2, 'Art Exhibition', 'Join us for an art exhibition showcasing various artworks.', 300, '2024-02-15', 0, 2, 'Art');

-- Insert sample data into comments table
INSERT INTO comments (post, text, date, comment_id, user, redponded_by)
VALUES
(1, 'Great project! I would love to contribute.', '2024-01-02', 1, 2, NULL),
(1, 'Thank you! Your support means a lot.', '2024-01-03', 2, 1, 2);

-- Insert sample data into donation table
INSERT INTO donation (user, post, amount)
VALUES
(2, 1, 50),
(1, 2, 20);

-- Insert sample data into files table
INSERT INTO files (post, name, file_id)
VALUES
(1, 'TechProjectDoc.pdf', 1),
(2, 'ArtExhibitionPoster.jpg', 1);

-- Insert sample data into follow table
INSERT INTO follow (follower, followed)
VALUES
(1, 2),
(2, 1);

-- Insert sample data into likes table
INSERT INTO likes (user, post)
VALUES
(1, 2),
(2, 1);

-- Insert sample data into notification table
INSERT INTO notification (user_for, notification_id, date, text, notification_type, user_from, visualized, post_id)
VALUES
(1, 1, '2024-01-05', 'You have a new follower!', 'Follow', 2, 0, NULL),
(2, 2, '2024-01-06', 'Your post received a like!', 'Like', 1, 0, 1);
