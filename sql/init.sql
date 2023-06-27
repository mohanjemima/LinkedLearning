CREATE TABLE User (
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(128) NOT NULL,
    profile_picture VARCHAR(255),
    is_admin BOOLEAN DEFAULT false,
    PRIMARY KEY (id)
);

-- LESSON DDL

CREATE TABLE Demo (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE DemoItem (
    id INT NOT NULL AUTO_INCREMENT,
    display_label VARCHAR(64) NOT NULL,
    html_content TEXT NOT NULL,
    demo_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (demo_id) REFERENCES Demo(id)
);

CREATE TABLE Lesson (
    id INT NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content MEDIUMTEXT,
    demo_id INT NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY (demo_id) REFERENCES Demo(id)
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
