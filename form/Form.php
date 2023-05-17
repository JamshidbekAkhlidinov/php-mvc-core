<?php
/*
 *   Jamshidbek Akhlidinov
 *   11 - 5 2023 11:51:36
 *   https://github.com/JamshidbekAkhlidinov
 */

/*
 *   Jamshidbek Akhlidinov
 *   11 - 5 2023 11:46:24
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($action = '', $method = 'get')
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public static function end()
    {
        echo "</form>";
    }


    public function field(Model $model, $attribute)
    {
        return new InputField($model, $attribute);
    }


}