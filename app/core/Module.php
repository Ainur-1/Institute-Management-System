<?php
abstract class Module {
    abstract public function displayModule();
    abstract public function displayElementEditorForm($id);
    abstract public function displayElementAddForm();

    abstract public function AddElement();
    abstract public function UpdateElement();
    abstract public function DeleteElement();
}