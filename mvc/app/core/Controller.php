<?php

//Main controller - get data from models and displaying to views
class Controller
{
    //To create an instance of model
    public function model($model)
    {
        require_once '../app/model/'.$model.'.php';
        return new $model;
    }

    //Calling view page and sending the data to view
    public function view($view, $data = [])
    {
        require_once '../app/view/'.$view.'.php';

    }
}

?>
