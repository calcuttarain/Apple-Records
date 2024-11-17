<?php

class Test extends Controller{
  public function index($a = ' ', $b = ' ') {
    echo 'Buna '. $a . ', ' . $b . '!';
  }
}
