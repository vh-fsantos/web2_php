<?php

abstract class DaoFactory {
    protected abstract function getConnection();

    public abstract function getDeveloperDao();

    public abstract function getRespondentDao();
}

?>