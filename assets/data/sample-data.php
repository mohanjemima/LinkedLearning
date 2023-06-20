<?php
function getUsers()
{
    return [
        ['name' => 'Sana', 'points' => '98237'],
        ['name' => 'Anton', 'points' => '88237'],
        ['name' => 'Rigoberto', 'points' => '78237'],
        ['name' => 'Yang', 'points' => '68237'],
        ['name' => 'Brice', 'points' => '58237'],
        ['name' => 'Violeta', 'points' => '48237'],
        ['name' => 'Dirk', 'points' => '38237'],
        ['name' => 'Malvina', 'points' => '28237'],
        ['name' => 'Luigi', 'points' => '18237'],
        ['name' => 'Dewayne', 'points' => '9823'],
    ];
}

function getRewards(){
    return [
        ['img'=>'/avatars/avatar1.png','name'=>'Knight','cost'=>'547'],
        ['img'=>'/avatars/avatar3.png','name'=>'Artist','cost'=>'547'],
        ['img'=>'/avatars/avatar4.png','name'=>'Adventurer','cost'=>'547'],
        ['img'=>'/avatars/avatar2.png','name'=>'Scientist','cost'=>'547'],
        ['img'=>'/avatars/avatar5.png','name'=>'Teacher','cost'=>'547'],
    ];
}


function getArticles(){
    return [
        [
            'lessonID' => 'l1',
            'pageTitle' => '1. What is HTML?',
            'paragraphs' => [
                [
                    'heading' => 'What will be covered in this lesson?',
                    'displayType' => 'block',
                    'content' => 'This lesson focuses on what HTML is. It will give you the required knowledge to start your HTML journey and enable you to build a simple webpage!'
                ],
                [
                    'heading' => 'What does HTML stand for?',
                    'displayType' => 'list',
                    'content' => '*HTML stands for Hyper Text Markup Language**HTML describes the structure of a Web Page**HTML consists of a series of elements**HTML elements tell the browser how to display content*'
                ],
                [
                    'heading' => 'Here are what some common HTML elements look like:',
                    'displayType' => 'list',
                    'content' => '*&lt;p&gt;**&lt;h1&gt;**&lt;a&gt;**&lt;html&gt;*'
                ],
            ],
        ],
        [
            'lessonID' => 'l2',
            'pageTitle' => '1. What is CSS?',
            'paragraphs' => [
                [
                    'heading' => 'What will be covered in this lesson?',
                    'displayType' => 'block',
                    'content' => ' This lesson will give you a brief introduction to CSS, by the end of this introduction you should be able to explain what CSS is, why it is used, and give examples of ways we can use it.'
                ],
                [
                    'heading' => 'What does CSS stand for?',
                    'displayType' => 'list',
                    'content' => '*CSS stands for Cascading Style Sheets**CSS describes the presentation of HTML elements**CSS enhances the display of our web pages by adding design and also allows us to define the layout of the page for different sizes/ types of devices*'
                ],
                [
                    'heading' => 'How to add CSS:',
                    'displayType' => 'list',
                    'content' => '*Inline CSS**Internal CSS**External CSS*'
                ],
                [
                    'heading' => 'Inline CSS',
                    'displayType' => 'code',
                    'content' => '<h1 style="text-align:left;font-size:30px;>Heading </h1>'
                ],
                [
                    'heading' => 'Internal CSS',
                    'displayType' => 'code',
                    'content' => '< head>
            < style>
            h1{
                text-align: left;
                font-size: 30px;
            }

            body{
                  background-color: red;
            }
            < /style>
            < /head>

            < body>

            < h1> Internal CSS Example < /h1>

            < /body>'
                ],
                [
                    'heading' => 'External CSS',
                    'displayType' => 'code',
                    'content' => '< link rel="stylesheet" href="example-style.css">Inside example-style.css:
            h1{
                text-align: left;
                font-size: 30px;
            }

            body{
                  background-color: red;
            }'
                ],
                [
                    'heading' => 'In Summary',
                    'displayType' => 'block',
                    'content' => 'Internal CSS: Styles added within an HTML document using the &lt;style&gt; tag in the &lt;head &gt;. Applies only to that document.Inline CSS: Styles added directly to individual HTML elements using the style attribute. Overrides other styles.
                    External CSS: Styles defined in a separate CSS file linked to an HTML document using the &lt;link&gt; tag. Promotes reusability and consistency across multiple pages.'
                ],
            ],
        ],
    ];
}

function getQuizzes()
{
    return [
        [
            'lessonID' => 'q1',
            'pageTitle' => 'Q1. Quiz! What is HTML',
            'paragraphs' => [
                [
                    'heading' => '1. HTML stands for what?',
                    'displayType' => 'radio',
                    'content' => [
                        ['choice' => 'Ham Tomatoes Mayo Lettuce'],
                        ['choice' => 'Hard To Make Legible'],
                        ['choice' => 'Hippos Talk Multiple Languages'],
                        ['choice' => 'Hyper Text Markup Language'],
                    ],
                ],
                [
                    'heading' => '2. What is the matching closing tag to &lt;h1&gt;',
                    'displayType' => 'input',
                    'content' => [
                        'choice' => '',
                    ],
                ],
                [
                    'heading' => '3. Which of these are real HTML tags',
                    'displayType' => 'check',
                    'content' => [
                        ['choice' => '&lt;html&gt;'],
                        ['choice' => '&lt;website&gt;'],
                        ['choice' => '&lt;body&gt;'],
                        ['choice' => '&lt;p&gt;'],
                    ],
                ],
                [
                    'heading' => '4. What tag is used for text paragraphs?',
                    'displayType' => 'input',
                    'content' => [
                        'choice' => '',
                    ],
                ],
                [
                    'heading' => '5. Which of these are NOT real input types?',
                    'displayType' => 'check',
                    'content' => [
                        ['choice' => 'type="interesting"'],
                        ['choice' => 'type="pretty"'],
                        ['choice' => 'type="new"'],
                        ['choice' => 'type="text"'],
                    ],
                ],
                [
                    'heading' => '6. HTML can be styled using CSS?',
                    'displayType' => 'radio',
                    'content' => [
                        ['choice' => 'true'],
                        ['choice' => 'false'],
                    ],
                ],
            ],
        ],
        [
            'lessonID' => 'q2',
            'pageTitle' => 'Q1. Quiz! What is CSS',
            'paragraphs' => [
                [
                    'heading' => '1. CSS stands for what?',
                    'displayType' => 'radio',
                    'content' => [
                        ['choice' => 'Cascading Style Sheets'],
                        ['choice' => 'Cars Shave Stars'],
                        ['choice' => 'Cancel September Snow'],
                        ['choice' => 'Cry Shout Sob'],
                    ],
                ],
                [
                    'heading' => '2. in what tag do you define an external style sheet?',
                    'displayType' => 'input',
                    'content' => [
                        'choice' => '',
                    ],
                ],
                [
                    'heading' => '3. Which of these would NOT work',
                    'displayType' => 'check',
                    'content' => [
                        ['choice' => 'cars-class{background-color:red;}'],
                        ['choice' => '#cars-class{background-color:red;}'],
                        ['choice' => '.cars-class{background-color:red;}'],
                        ['choice' => '#cars-class{background-color:red}'],
                    ],
                ],
                [
                    'heading' => '4. Write the correct syntax to style the body of a web page ',
                    'displayType' => 'input',
                    'content' => [
                        'choice' => '',
                    ],
                ],
                [
                    'heading' => '5. What are the 3 main ways to add CSS',
                    'displayType' => 'check',
                    'content' => [
                        ['choice' => 'Inline CSS'],
                        ['choice' => 'External CSS'],
                        ['choice' => 'Extensive CSS'],
                        ['choice' => 'Inline CSS'],
                        ['choice' => 'Integrated CSS'],
                        ['choice' => 'Inner Text CSS'],
                    ],
                ],
                [
                    'heading' => '6. CSS describes the presentation of HTML elements. True or False?',
                    'displayType' => 'radio',
                    'content' => [
                        ['choice' => 'true'],
                        ['choice' => 'false'],
                    ],
                ],
                [
                    'heading' => '7. Which option sets the box class background colour to blue?',
                    'displayType' => 'radio',
                    'content' => [
                        ['choice' => '.box{background-color:blue;}'],
                        ['choice' => '.box{color:blue;}'],
                        ['choice' => '.box{Make the background blue... please?;}'],
                        ['choice' => '.box{background:blue;}'],

                    ],
                ],
            ],
        ],
    ];
}




//        ['lessonID'=>'x','pageTitle'=>'',
//            'paragraphs'=>['','content'=>''],
//            ['heading'=>'','content'=>''],
//            ['heading'=>'','content'=>''],
//            ['heading'=>'','content'=>''],
//            ['heading'=>'','content'=>''],
//
//        ],

function getLessons(){
    return[
        ['lessonID' => 'l1', 'pageTitle' => '1. What is HTML?', 'href' =>'./article.php'],
        ['lessonID' => 'q1', 'pageTitle' => 'Q1. Quiz! What is HTML', 'href' =>'./quiz.php'],
        ['lessonID' => 'l2', 'pageTitle' => '1. What is CSS?', 'href' =>'./article2.php'],
        ['lessonID' => 'q2', 'pageTitle' => 'Q1. Quiz! What is CSS', 'href' =>'./quiz2.php'],

    ];
}




