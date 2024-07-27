-- database schema : use cool_tech database
-- categories table
CREATE TABLE
    IF NOT EXISTS categories (
        category_id INT AUTO_INCREMENT PRIMARY KEY,
        category_name VARCHAR(255) NOT NULL
    );

-- articles table
CREATE TABLE
    IF NOT EXISTS articles (
        article_id INT AUTO_INCREMENT PRIMARY KEY,
        article_creation_date DATE DEFAULT (CURRENT_DATE),
        article_title VARCHAR(255) NOT NULL,
        article_content TEXT NOT NULL,
        category_id INT,
        FOREIGN KEY (category_id) REFERENCES categories (category_id)
    );

-- tags table
CREATE TABLE
    IF NOT EXISTS tags (
        tag_id INT AUTO_INCREMENT PRIMARY KEY,
        tag_name VARCHAR(255) NOT NULL
    );

-- create pivot table for articles and tags
CREATE TABLE
    IF NOT EXISTS article_tag (
        article_id INT NOT NULL,
        tag_id INT NOT NULL,
        PRIMARY KEY (article_id, tag_id)
    );

-- add foreign key constraint to reference the articles table
ALTER TABLE article_tag
-- name the constraint
ADD CONSTRAINT fk_article_id
-- specify foreign key column
FOREIGN KEY (article_id)
-- reference column in the articles table
REFERENCES articles (article_id)
-- delete related article_tag record(s) when an article is deleted
ON DELETE CASCADE;

-- add foreign key constraint to reference the tags table
ALTER TABLE article_tag
-- name the constraint
ADD CONSTRAINT fk_tag_id
-- specify foreign key column
FOREIGN KEY (tag_id)
-- reference column in the tags table
REFERENCES tags (tag_id)
-- delete related article_tag record(s) when a tag is deleted
ON DELETE CASCADE;

-- insert sample data :
-- insert sample categories
INSERT INTO
    categories (category_name)
VALUES
    ('Tech news'),
    ('Software reviews'),
    ('Hardware reviews'),
    ('Opinion pieces'),
    ('Education');

-- insert sample articles
INSERT INTO
    articles (article_title, article_content, category_id)
VALUES
    (
        'The Future of AI',
        'Paragraph 1: Content about tech news. <br/><br/> Paragraph 2: Elaborate.',
        1
    ),
    (
        'Which iPhones will get iOS 17?',
        'Paragraph 1: Content about software. <br/><br/> Paragraph 2: Elaborate.',
        2
    ),
    (
        'The M3 Is For Me',
        'Paragraph 1: Content about hardware. <br/><br/> Paragraph 2: Elaborate.',
        3
    ),
    (
        'AI is NOT a Threat to Humanity',
        'Paragraph 1: Content about opinions. <br/><br/> Paragraph 2: Elaborate.',
        4
    ),
    (
        'We love the Apple Ecosystem',
        'Paragraph 1: Content about opinions. <br/><br/> Paragraph 2: Elaborate.',
        1
    ),
    (
        'Google Pixel Phones?',
        'Paragraph 1: Content about tech news. <br/><br/> Paragraph 2: Elaborate.',
        1
    ),
    (
        'Learn to code through freeCodeCamp',
        'Paragraph 1: Content about education. <br/><br/> Paragraph 2: Elaborate.',
        5
    ),
    (
        'The Evolution of Quantum Computing',
        'Paragraph 1: Content about tech news. <br/><br/> Paragraph 2: Elaborate.',
        1
    ),
    (
        'Oppo vs Samsung Phone',
        'Paragraph 1: Content about software. <br/><br/> Paragraph 2: Elaborate.',
        2
    );

-- insert sample tags (no spaces allowed)
INSERT INTO
    tags (tag_name)
VALUES
    ('AI'),
    ('Hardware'),
    ('Software'),
    ('Opinion'),
    ('Learning'),
    ('Google'),
    ('High-PerformanceComputing'),
    ('Singularity'),
    ('Apple');

-- associate articles with tags
INSERT INTO
    article_tag (article_id, tag_id)
VALUES
    (1, 1), -- The Future of AI
    (1, 3),
    (1, 8),
    (1, 4),
    (1, 5),
    (2, 3), -- Which iPhones will get iOS 17?
    (2, 9),
    (3, 2), -- The M3 Is For Me
    (3, 9),
    (3, 7),
    (4, 4), -- AI is NOT a Threat to Humanity
    (4, 8),
    (5, 5), -- We love the Apple Ecosystem
    (5, 9),
    (6, 3), -- Google Pixel Phones?
    (6, 2),
    (6, 4),
    (6, 6),
    (7, 5); -- Learn to code through freeCodeCamp
-- The Evolution of Quantum Computing : 0 tag(s)
