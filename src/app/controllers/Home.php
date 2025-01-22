<?php

class Home
{
    use Controller;

    public function index()
    {
        $statsModel = new StatsModel();
        $stats = $statsModel->getSiteStats();

        $this->view('home', ['stats' => $stats]);
        $statsModel->incrementVisitors();
    }
}

