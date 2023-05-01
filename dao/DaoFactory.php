<?php

abstract class DaoFactory {
    protected abstract function getConnection();

    public abstract function getDeveloperDao();

    public abstract function getRespondentDao();

    public abstract function getQuizDao();

    public abstract function getQuestionDao();

    public abstract function getQuizQuestionDao();
}

?>