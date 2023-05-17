<?php
/*
 *   Jamshidbek Akhlidinov
 *   16 - 5 2023 18:35:56
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core\form;

class TextareaInput extends BaseField
{
    public function renderInput()
    {
        return sprintf('
            <textarea name="%s" class="form-control %s">%s</textarea>
        ',
            $this->attribute,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->{$this->attribute},
        );
    }
}