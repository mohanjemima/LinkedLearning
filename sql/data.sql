INSERT INTO Lesson (`title`, `content`) VALUES ('What is HTML?', '# What will be covered in this lesson?\r\nThis lesson focuses on what HTML is. It will give you the required knowledge to start your HTML journey and enable you to build a simple webpage!\r\n# What does HTML stand for?\r\nHTML stands for Hyper Text Markup Language\r\n---\r\nHTML describes the structure of a Web Page\r\nHTML consists of a series of elements\r\nHTML elements tell the browser how to display content\r\n---\r\n# Here are what some common HTML elements look like:\r\n---\r\n<p>\r\n<h1>\r\n<a>\r\n<html>\r\n---');
INSERT INTO Lesson (`title`, `content`) VALUES ('What is CSS?', '# What will be covered in this lesson?\r\nThis lesson will give you a brief introduction to CSS, by the end of this introduction you should be able to explain what CSS is, why it is used, and give examples of ways we can use it.\r\n# What does CSS stand for?\r\n---\r\nCSS stands for Cascading Style Sheets\r\nCSS describes the presentation of HTML elements\r\nCSS enhances the display of our web pages by adding design and also allows us to define the layout of the page for different sizes/ types of devices\r\n---\r\n# How to add CSS:\r\n---\r\nInline CSS\r\nInternal CSS\r\nExternal CSS\r\n---\r\n# Inline CSS\r\n```\r\n&lt;h1 style=\"text-align:left;font-size:30px;&gt;Heading &lt;/h1&gt;\r\n```\r\n# Internal CSS\r\n```\r\n&lt;head&gt;\r\n &lt;style&gt;\r\n h1{\r\n text-align: left;\r\n font-size: 30px;\r\n }\r\n\r\n body{\r\n background-color: red;\r\n }\r\n &lt;/style&gt;\r\n&lt;/head&gt;\r\n\r\n&lt;body&gt;\r\n &lt;h1&gt; Internal CSS Example &lt;/h1&gt;\r\n&lt;/body&gt;\r\n```\r\n# External CSS\r\nIn your html file head tag:\r\n```\r\n&lt;link rel=\"stylesheet\" href=\"example-style.css\"&gt;\r\n```\r\nInside your example-style.css file:\r\n```\r\nh1{\r\n text-align: left;\r\n font-size: 30px;\r\n}\r\n\r\nbody{\r\n background-color: red\r\n}\r\n```\r\n# In Summary\r\nInternal CSS: Styles added within an HTML document using the &lt;style&gt; tag in the &lt;head &gt;. Applies only to that document.Inline CSS: Styles added directly to individual HTML elements using the style attribute. Overrides other styles.\r\nExternal CSS: Styles defined in a separate CSS file linked to an HTML document using the &lt;link&gt; tag. Promotes reusability and consistency across multiple pages.');
INSERT INTO DemoItem (`display_label`, `html_content`, `lesson_id`) VALUES ('h1', '<h1>Here is a H1 tag: it' 's ideal for large headers!</h1>', '1');
INSERT INTO DemoItem (`display_label`, `html_content`, `lesson_id`) VALUES ('h3', '<h3>Here is a H3 tag: it' 's best suited for sub headings</h3>', '1');
INSERT INTO DemoItem (`display_label`, `html_content`, `lesson_id`) VALUES ('p', '<p>This is a p (paragraph) tag: this is used for content, like you see throughout this page!</p>', '1');



INSERT INTO User (name, age, email, password,score) VALUES ('Jemima',' 19', 'Jemima.mohan.2022@uni.strath.ac.uk', '1234', '90000');
INSERT INTO User (name, age, email, password,score) VALUES ('Randi ',' 16', 'cyrus.warner@example.com', '1234', '9457457');
INSERT INTO User (name, age, email, password,score) VALUES ('Laura',' 13', 'angelita.gill@example.com', '1234', '56457');
INSERT INTO User (name, age, email, password,score) VALUES ('Carissa',' 15', 'sabrina.contreras@example.com', '1234', '99999999');
INSERT INTO User (name, age, email, password,score) VALUES ('Fredrick',' 14', 'joan.malone@example.com', '1234', '234932');
INSERT INTO User (name, age, email, password,score) VALUES ('Rhona',' 14', 'helena.macdonald@example.com', '1234', '5478584');
INSERT INTO User (name, age, email, password,score) VALUES ('Johnie',' 13', 'isaiah.ayala@example.com', '1234', '124241');
INSERT INTO User (name, age, email, password,score) VALUES ('Addie',' 18', 'roosevelt.hoover@example.com', '1234', '345');
INSERT INTO User (name, age, email, password,score) VALUES ('Pedro','15', 'elvira.vang@example.com', '1234', '27358928');
INSERT INTO User (name, age, email, password,score) VALUES ('Errol','15', 'wendy.vaughn@example.com', '1234', '35435421');
INSERT INTO User (name, age, email, password) VALUES ('Sadye','15', 'cliff.collins@example.com', '1234');

INSERT INTO User (name, email, password,is_admin) VALUES ('Admin1','Admin1.staff@LinkedLearning', '1234','1');
INSERT INTO User (name, email, password,is_admin) VALUES ('Admin2','Admin2.staff@LinkedLearning', '1234','1');
INSERT INTO User (name, email, password,is_admin) VALUES ('Admin3','Admin3.staff@LinkedLearning', '1234','1');
INSERT INTO User (name, email, password,is_admin) VALUES ('Admin4','Admin4.staff@LinkedLearning', '1234','1');
INSERT INTO User (name, email, password,is_admin) VALUES ('Admin5','Admin5.staff@LinkedLearning', '1234','1');



INSERT INTO Reward (id,avatar_name, img_address, cost) VALUES ('1','Knight','/avatars/avatar1.png','94875');
INSERT INTO Reward (id,avatar_name, img_address, cost) VALUES ('2','Scientist','/avatars/avatar2.png','743634');
INSERT INTO Reward (id,avatar_name, img_address, cost) VALUES ('3','Artist','/avatars/avatar3.png','12312');
INSERT INTO Reward (id,avatar_name, img_address, cost) VALUES ('4','Adventurer','/avatars/avatar4.png','324235');
INSERT INTO Reward (id,avatar_name, img_address, cost) VALUES ('5','Teacher','/avatars/avatar5.png','34535');
INSERT INTO Reward (id,avatar_name, img_address, cost) VALUES ('6','Default','/avatars/avatar6.png','0');



INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('1','1');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('1','2');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('1','3');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('1','4');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('1','6');

INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('2','2');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('2','3');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('2','4');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('2','5');

INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('3','1');
INSERT INTO UnlockedAvatar (user_id, reward_id) VALUES ('3','6');