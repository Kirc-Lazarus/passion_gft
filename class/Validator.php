<?php
class Validator
{

    private $data;
    private $errors = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    private function getField($field)
    {
        if (!isset($this->data[$field])) {
            return null;
        }
        return $this->data[$field];
    }

    public function isCharacters($field, $errorMsg)
    {
        if (!preg_match('/^(?![_ -])(?!.*[_ -]{2,})[A-Za-z0-9_ -]{3,}(?<![_ -])$/', $this->getField($field))) {
            $this->errors[$field] = $errorMsg;
        }
    }

    public function isUniq($field, $db, $table, $errorMsg)
    {
        $record = $db->query("SELECT user FROM $table WHERE $field = ?", [$this->getField($field)])->fetch();

        // Si il existe, alors j'indique à l'utilisateur qu'il ne peut pas prendre ce pseudo
        if ($record) {
            $this->errors[$field] = $errorMsg;
        }
    }

    public function isEmail($field, $errorMsg)
    {
        if (!filter_var($this->getField($field), FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field] = $errorMsg;
        };
    }

    public function isPassword($field, $errorMsg = '')
    {
        $value = $this->getField($field);
        if (empty($value) || $value != $this->getField($field . '_confirm')) {
            $this->errors[$field] = $errorMsg;
        }
    }
    public function isValid()
    {
        return empty($this->errors);
    }
    public function getErrors()
    {
        return $this->errors;
    }
}
