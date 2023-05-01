<?php 

include_once('model/Developer.php');
include_once('model/Question.php');
include_once('model/Quiz.php');
include_once('model/QuizQuestion.php');
include_once('model/Respondent.php');
include_once('model/User.php');
include_once('dao/abstractions/DeveloperDao.php');
include_once('dao/abstractions/QuestionDao.php');
include_once('dao/abstractions/QuizDao.php');
include_once('dao/abstractions/QuizQuestionDao.php');
include_once('dao/abstractions/RespondentDao.php');
include_once('dao/DaoFactory.php');
include_once('dao/PostgresDaoFactory.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$factory = new PostgresDaofactory();

?>