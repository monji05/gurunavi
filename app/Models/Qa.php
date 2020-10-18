<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Qa extends Model
{

    /**
     * テーブルの主キー
     *
     * @var string
     */
    protected $primaryKey = 'qa_id';

    protected $table = 'qa';

    public function fetch()
    {
        $list = $this->all();
        return $list;
    }

    public function fetchDefaults(?int $qaId = null)
    {
        if ($qaId) {
            $defaults = $this->find($qaId);
        } else {
            $defaults = null;
        }

        return $defaults;
    }

    public function register(array $input, ?int $qaId = null)
    {
        $values = Arr::only($input, [
            'content',
        ]);

        if ($qaId) {
            $qa = Qa::find($qaId);
        } else {
            $qa = new Qa();
        }
        // TODO:ログイン機能作ったら、Auth::id()で取得する
        $qa->user_id = 1;
        foreach($values as $column => $value) {
            $qa->$column = $value;
            $qa->save();
        }
        return $qa;
    }

}
