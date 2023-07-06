INSERT INTO Lesson (id, title, content) VALUES
                                                    (1, 'What is HTML?', '# What will be covered in this lesson?\r\nThis lesson focuses on what HTML is. It will give you the required knowledge to start your HTML journey and enable you to build a simple webpage!\r\n# What does HTML stand for?\r\nHTML stands for Hyper Text Markup Language\r\n---\r\nHTML describes the structure of a Web Page\r\nHTML consists of a series of elements\r\nHTML elements tell the browser how to display content\r\n---\r\n# Here are what some common HTML elements look like:\r\n---\r\n<p>\r\n<h1>\r\n<a>\r\n<html>\r\n---'),
                                                    (2, 'What is CSS?', '# What will be covered in this lesson?\r\nThis lesson will give you a brief introduction to CSS, by the end of this introduction you should be able to explain what CSS is, why it is used, and give examples of ways we can use it.\r\n# What does CSS stand for?\r\n---\r\nCSS stands for Cascading Style Sheets\r\nCSS describes the presentation of HTML elements\r\nCSS enhances the display of our web pages by adding design and also allows us to define the layout of the page for different sizes/ types of devices\r\n---\r\n# How to add CSS:\r\n---\r\nInline CSS\r\nInternal CSS\r\nExternal CSS\r\n---\r\n# Inline CSS\r\n```\r\n&lt;h1 style=\"text-align:left;font-size:30px;&gt;Heading &lt;/h1&gt;\r\n```\r\n# Internal CSS\r\n```\r\n&lt;head&gt;\r\n &lt;style&gt;\r\n h1{\r\n text-align: left;\r\n font-size: 30px;\r\n }\r\n\r\n body{\r\n background-color: red;\r\n }\r\n &lt;/style&gt;\r\n&lt;/head&gt;\r\n\r\n&lt;body&gt;\r\n &lt;h1&gt; Internal CSS Example &lt;/h1&gt;\r\n&lt;/body&gt;\r\n```\r\n# External CSS\r\nIn your html file head tag:\r\n```\r\n&lt;link rel=\"stylesheet\" href=\"example-style.css\"&gt;\r\n```\r\nInside your example-style.css file:\r\n```\r\nh1{\r\n text-align: left;\r\n font-size: 30px;\r\n}\r\n\r\nbody{\r\n background-color: red\r\n}\r\n```\r\n# In Summary\r\nInternal CSS: Styles added within an HTML document using the &lt;style&gt; tag in the &lt;head &gt;. Applies only to that document.Inline CSS: Styles added directly to individual HTML elements using the style attribute. Overrides other styles.\r\nExternal CSS: Styles defined in a separate CSS file linked to an HTML document using the &lt;link&gt; tag. Promotes usability and consistency across multiple pages.');
INSERT INTO DemoItem (id, display_label, html_content, lesson_id) VALUES
                                                                                (4, 'h1', '<h1>Here is a H1 tag: its ideal for large headers!</h1>', 1),
                                                                                (5, 'h3', '<h3>Here is a H3 tag: its best suited for sub headings</h3>', 1),
                                                                                (6, 'p', '<p>This is a p (paragraph) tag: this is used for content, like you see throughout this page!</p>', 1);
INSERT INTO Quiz (id, title, lesson_id) VALUES
                                                    (13, 'Quiz! What is HTML?', 1),
                                                    (15, 'Quiz! What is CSS?', 2);
INSERT INTO QuizQuestion (id, question, type, quiz_id) VALUES
                                                                     (57, 'What does CSS stand for?', 'MULTI', 15),
                                                                     (58, 'In what tag do you define an external style sheet?', 'TEXT', 15),
                                                                     (59, 'Which of these would NOT work', 'MULTI', 15),
                                                                     (60, 'Write the correct syntax to style the body of a web page', 'TEXT', 15),
                                                                     (61, 'What are the 3 main ways to add CSS', 'MULTI', 15),
                                                                     (62, 'CSS describes the presentation of HTML elements. True or False?', 'MULTI', 15),
                                                                     (63, 'Which option sets the box class background colour to blue?', 'MULTI', 15),
                                                                     (114, 'What does HTML stand for?', 'MULTI', 13),
                                                                     (115, 'What is the matching closing tag to <h1>', 'TEXT', 13),
                                                                     (116, 'Which of these are real HTML tags', 'MULTI', 13),
                                                                     (117, 'What tag is used for text paragraphs?', 'TEXT', 13),
                                                                     (118, 'Which of these are NOT real input types?', 'MULTI', 13),
                                                                     (119, 'HTML can be styled using CSS?', 'MULTI', 13);
INSERT INTO QuizAnswer (id, label, is_correct, quiz_question_id) VALUES
                                                                               (173, 'Cascading Style Sheets', 1, 57),
                                                                               (174, 'Cars Shave Stars', 0, 57),
                                                                               (175, 'Cancel September Snow', 0, 57),
                                                                               (176, 'Cry Shout Sob', 0, 57),
                                                                               (177, 'link', 1, 58),
                                                                               (178, 'cars-class{background-color:red;}', 1, 59),
                                                                               (179, '#cars-class{background-color:red;}', 0, 59),
                                                                               (180, '.cars-class{background-color:red;}', 0, 59),
                                                                               (181, '#cars-class{background-color:red}', 1, 59),
                                                                               (182, 'body', 1, 60),
                                                                               (183, 'Inline CSS', 1, 61),
                                                                               (184, 'External CSS', 1, 61),
                                                                               (185, 'Extensive CSS', 0, 61),
                                                                               (186, 'Inline CSS', 1, 61),
                                                                               (187, 'Integrated CSS', 0, 61),
                                                                               (188, 'Inner Text CSS', 0, 61),
                                                                               (189, 'True', 0, 62),
                                                                               (190, 'False', 1, 62),
                                                                               (191, '.box{background-color:blue;}', 1, 63),
                                                                               (192, '.box{color:blue;}', 0, 63),
                                                                               (193, '.box{Make the background blue... please?;}', 0, 63),
                                                                               (194, '.box{background:blue;}', 0, 63),
                                                                               (295, 'Ham Tomatoes Mayo Lettuce', 0, 114),
                                                                               (296, 'Hard To Make Legible', 0, 114),
                                                                               (297, 'Hippos Talk Multiple Languages', 0, 114),
                                                                               (298, 'Hyper Text Markup Language', 1, 114),
                                                                               (299, '</h1>', 1, 115),
                                                                               (300, '<html>', 1, 116),
                                                                               (301, '<website>', 0, 116),
                                                                               (302, '<body>', 1, 116),
                                                                               (303, '<p>', 1, 116),
                                                                               (304, 'p', 1, 117),
                                                                               (305, 'type=\"interesting\"', 1, 118),
                                                                               (306, 'type=\"pretty\"', 1, 118),
                                                                               (307, 'type=\"new\"', 1, 118),
                                                                               (308, 'type=\"text\"', 0, 118),
                                                                               (309, 'True', 1, 119),
                                                                               (310, 'False', 0, 119);
INSERT INTO User (name, age, email, password, score) VALUES
                                                         ('Jemima', '19', 'Jemima.mohan.2022@uni.strath.ac.uk', '1234', '90000'),
                                                         ('Randi', '16', 'cyrus.warner@example.com', '1234', '9457457'),
                                                         ('Laura', '13', 'angelita.gill@example.com', '1234', '56457'),
                                                         ('Carissa', '15', 'sabrina.contreras@example.com', '1234', '99999999'),
                                                         ('Fredrick', '14', 'joan.malone@example.com', '1234', '234932'),
                                                         ('Rhona', '14', 'helena.macdonald@example.com', '1234', '5478584'),
                                                         ('Johnie', '13', 'isaiah.ayala@example.com', '1234', '124241'),
                                                         ('Addie', '18', 'roosevelt.hoover@example.com', '1234', '345'),
                                                         ('Pedro', '15', 'elvira.vang@example.com', '1234', '27358928'),
                                                         ('Errol', '15', 'wendy.vaughn@example.com', '1234', '35435421'),
                                                         ('Sadye', '15', 'cliff.collins@example.com', '1234', '0');
INSERT INTO User (name, email, password, is_admin) VALUES
                                                       ('Admin1', 'Admin1.staff@LinkedLearning', '1234', '1'),
                                                       ('Admin2', 'Admin2.staff@LinkedLearning', '1234', '1'),
                                                       ('Admin3', 'Admin3.staff@LinkedLearning', '1234', '1'),
                                                       ('Admin4', 'Admin4.staff@LinkedLearning', '1234', '1'),
                                                       ('Admin5', 'Admin5.staff@LinkedLearning', '1234', '1');
INSERT INTO Reward (id, avatar_name, img_address, cost) VALUES
                                                            ('1', 'Knight', '/avatars/avatar1.png', '94875'),
                                                            ('2', 'Scientist', '/avatars/avatar2.png', '743634'),
                                                            ('3', 'Artist', '/avatars/avatar3.png', '12312'),
                                                            ('4', 'Adventurer', '/avatars/avatar4.png', '324235'),
                                                            ('5', 'Teacher', '/avatars/avatar5.png', '34535'),
                                                            ('6', 'Default', '/avatars/avatar6.png', '0');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES
                                                    ('1', '1'),
                                                    ('1', '2'),
                                                    ('1', '3'),
                                                    ('1', '4'),
                                                    ('1', '6');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES
                                                    ('2', '2'),
                                                    ('2', '3'),
                                                    ('2', '4'),
                                                    ('2', '5');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('3','1'),
                                                       ('3','6');