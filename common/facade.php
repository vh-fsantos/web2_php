<?php 

require_once('../model/Developer.php');
require_once('../model/Question.php');
require_once('../model/Quiz.php');
require_once('../model/QuizQuestion.php');
require_once('../model/Respondent.php');
require_once('../model/User.php');
require_once('../model/Alternative.php');
require_once('../dao/abstractions/DeveloperDao.php');
require_once('../dao/abstractions/AlternativeDao.php');
require_once('../dao/abstractions/QuestionDao.php');
require_once('../dao/abstractions/QuizDao.php');
require_once('../dao/abstractions/QuizQuestionDao.php');
require_once('../dao/abstractions/RespondentDao.php');
require_once('../dao/DaoFactory.php');
require_once('../dao/postgres/PostgresDaoFactory.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$factory = new PostgresDaofactory();

?>