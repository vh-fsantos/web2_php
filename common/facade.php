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

function is_session_started()
{
    if (php_sapi_name() !== 'cli')
    {
        if (version_compare(phpversion(), '5.4.0', '>='))
            return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
        else
            return session_id() === '' ? FALSE : TRUE;
    }
    return FALSE;
}

if (is_session_started() === FALSE ) 
			session_start();

?>