<?php

class SiteController extends Controller
{

    public function actionLogin()
    {
        $this->redirect($this->createUrl("/site/login"));
    }

}