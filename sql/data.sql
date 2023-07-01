INSERT INTO Lesson (`title`, `content`) VALUES ('What is HTML?', '# What will be covered in this lesson?\r\nThis lesson focuses on what HTML is. It will give you the required knowledge to start your HTML journey and enable you to build a simple webpage!\r\n# What does HTML stand for?\r\nHTML stands for Hyper Text Markup Language\r\n---\r\nHTML describes the structure of a Web Page\r\nHTML consists of a series of elements\r\nHTML elements tell the browser how to display content\r\n---\r\n# Here are what some common HTML elements look like:\r\n---\r\n<p>\r\n<h1>\r\n<a>\r\n<html>\r\n---');
INSERT INTO Lesson (`title`, `content`) VALUES ('What is CSS?', '# What will be covered in this lesson?\r\nThis lesson will give you a brief introduction to CSS, by the end of this introduction you should be able to explain what CSS is, why it is used, and give examples of ways we can use it.\r\n# What does CSS stand for?\r\n---\r\nCSS stands for Cascading Style Sheets\r\nCSS describes the presentation of HTML elements\r\nCSS enhances the display of our web pages by adding design and also allows us to define the layout of the page for different sizes/ types of devices\r\n---\r\n# How to add CSS:\r\n---\r\nInline CSS\r\nInternal CSS\r\nExternal CSS\r\n---\r\n# Inline CSS\r\n```\r\n&lt;h1 style=\"text-align:left;font-size:30px;&gt;Heading &lt;/h1&gt;\r\n```\r\n# Internal CSS\r\n```\r\n&lt;head&gt;\r\n &lt;style&gt;\r\n h1{\r\n text-align: left;\r\n font-size: 30px;\r\n }\r\n\r\n body{\r\n background-color: red;\r\n }\r\n &lt;/style&gt;\r\n&lt;/head&gt;\r\n\r\n&lt;body&gt;\r\n &lt;h1&gt; Internal CSS Example &lt;/h1&gt;\r\n&lt;/body&gt;\r\n```\r\n# External CSS\r\nIn your html file head tag:\r\n```\r\n&lt;link rel=\"stylesheet\" href=\"example-style.css\"&gt;\r\n```\r\nInside your example-style.css file:\r\n```\r\nh1{\r\n text-align: left;\r\n font-size: 30px;\r\n}\r\n\r\nbody{\r\n background-color: red\r\n}\r\n```\r\n# In Summary\r\nInternal CSS: Styles added within an HTML document using the &lt;style&gt; tag in the &lt;head &gt;. Applies only to that document.Inline CSS: Styles added directly to individual HTML elements using the style attribute. Overrides other styles.\r\nExternal CSS: Styles defined in a separate CSS file linked to an HTML document using the &lt;link&gt; tag. Promotes reusability and consistency across multiple pages.');
INSERT INTO DemoItem (`display_label`, `html_content`, `lesson_id`) VALUES ('h1', '<h1>Here is a H1 tag: it' 's ideal for large headers!</h1>', '1');
INSERT INTO DemoItem (`display_label`, `html_content`, `lesson_id`) VALUES ('h3', '<h3>Here is a H3 tag: it' 's best suited for sub headings</h3>', '1');
INSERT INTO DemoItem (`display_label`, `html_content`, `lesson_id`) VALUES ('p', '<p>This is a p (paragraph) tag: this is used for content, like you see throughout this page!</p>', '1');