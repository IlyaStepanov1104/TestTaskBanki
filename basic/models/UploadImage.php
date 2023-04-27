<?php

namespace app\models;


use yii\base\Model;
use yii\db\Exception;
use yii\db\Expression;
use yii\db\Query as QueryAlias;
use yii\web\UploadedFile;
use function PHPUnit\Framework\directoryExists;

/**
 * LoginForm is the model behind the login form.
 *
 * @property-read User|null $user
 *
 * @method static getInstance()
 */
class UploadImage extends Model
{
    /**
     * @var UploadedFile[]
     */
    public array $files;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            ['files', 'image',
                'extensions' => ['jpg', 'jpeg', 'png', 'gif'],
                'checkExtensionByMimeType' => true,
                'maxFiles' => 5
            ]
        ];
    }

    public function upload(): bool
    {
        if (!file_exists('images')){
            mkdir('images');
        }
        if ($this->validate()) {
            foreach ($this->files as $file) {
                $name = $this->url($this->translit($file->baseName));
                if ($name[-1] == ')' and $name[-3] == '('){
                    $i = intval($name[-2]);
                } else {
                    $i = 1;
                }
                while (file_exists('images/' . $name. '.' . $file->extension)){
                    if ($i == 1){
                        $name .= ' ('.$i.')';
                    } else {
                        $name = substr($name, 0, -3-$i/10);
                        $name .= '('.$i.')';
                    }
                    $i++;
                }
                if ($file->saveAs('images/' . $name. '.' . $file->extension)){
                    (new QueryAlias())->createCommand()->insert('images', [
                        'id'=> NULL,
                        'path'=> $name. '.' . $file->extension,
                        'dateTime'=> new Expression('NOW()')
                    ])->execute();
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function url($oldstr): string
    {
        $newstr = preg_replace('%[\s]%', '-', preg_replace('%[^A-Za-z0-9\s\-]%', '', $oldstr));
        return str_replace(" ", "-", $newstr);
    }

    public function translit($str): string
    {
        if (empty($str)) return false;
        $rus = array(
            'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П',
            'Р','С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я',
            'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п',
            'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'
        );
        $lat = array(
            'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya',
            'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p',
            'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya'
        );
        return str_replace($rus, $lat, $str);
    }
}
