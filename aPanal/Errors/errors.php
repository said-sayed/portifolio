<?php
namespace aPanal\errors;
class Errors
{
    public $errors = [];
    function empty($input)
    {
        if (empty($input)) {
            $this->errors[] = "the fields can not be empty";
        }
    }
    function is_string($input)
    {
        if (!is_string($input)) {
            $this->errors[] = "this field should be a string";
        }
    }
    function strlen($input)
    {
        if (strlen($input) > 255) {
            $this->errors[] = "this field should be at least 255 characters";
        }
    }
}
