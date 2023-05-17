<?php
/*
 *   Jamshidbek Akhlidinov
 *   16 - 5 2023 18:16:4
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core\form;

use app\core\Model;

abstract class BaseField
{
    public string $type;
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        $model = $this->model;
        $attribute = $this->attribute;
        return sprintf('
                <label class="form-label">%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
                ',
            $model->getLabel($attribute),
            $this->renderInput(),
            $model->getFirstError($attribute),
        );
    }

    abstract public function renderInput();

}