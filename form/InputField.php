<?php
/*
 *   Jamshidbek Akhlidinov
 *   11 - 5 2023 11:52:51
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core\form;

use app\core\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';

    public string $type;

    public function __construct(Model $model, $attribute)
    {
        $this->type = self::TYPE_TEXT;
        return parent::__construct($model, $attribute);
    }

    public function renderInput()
    {
        $model = $this->model;
        $attribute = $this->attribute;
        return sprintf('
              <input type="%s" name="%s" value="%s" class="form-control %s">
        ',
            $this->type,
            $attribute,
            $model->{$attribute},
            $model->hasError($attribute) ? 'is-invalid' : '',
        );
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function textArea()
    {
        return new TextareaInput($this->model, $this->attribute);
    }


}