-- LESSON DDL

CREATE TABLE Lesson (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content MEDIUMTEXT,
    PRIMARY KEY (id)
);

CREATE TABLE DemoItem (
    id INT NOT NULL AUTO_INCREMENT,
    display_label VARCHAR(64) NOT NULL,
    html_content TEXT NOT NULL,
    lesson_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (lesson_id) REFERENCES Lesson(id)
);

-- QUIZ DDL

CREATE TABLE Quiz (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE QuizQuestion (
    id INT NOT NULL AUTO_INCREMENT,
    question VARCHAR(255) NOT NULL,
    type VARCHAR(24) NOT NULL,
    quiz_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (quiz_id) REFERENCES Quiz(id)
);

CREATE TABLE QuizAnswer (
    id INT NOT NULL AUTO_INCREMENT,
    label VARCHAR(255) NOT NULL,
    is_correct BOOLEAN DEFAULT false,
    quiz_question_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (quiz_question_id) REFERENCES QuizQuestion(id)
);

-- USER DDL

CREATE TABLE User (
                       id INT NOT NULL AUTO_INCREMENT,
                       email VARCHAR(255) NOT NULL,
                       password VARCHAR(255) NOT NULL,
                       name VARCHAR(128) NOT NULL,
                       profile_picture VARCHAR(255),
                       is_admin BOOLEAN DEFAULT false,
                       score INT DEFAULT 0,
                       points INT DEFAULT 0,
                       age INT,
                       current_lesson_id INT NOT NULL DEFAULT 1,
                       PRIMARY KEY (id),
                       FOREIGN KEY (current_lesson_id) REFERENCES Lesson(id)
);

