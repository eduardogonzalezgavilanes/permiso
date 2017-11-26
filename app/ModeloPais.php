<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModeloPais extends Model
{
     protected $table = 'Pais';
    protected $fillable = ['CoadigoPais', 'NombrePais'];

    public static function getExcerpt($str, $startPos = 0, $maxLength = 50) {
        if(strlen($str) > $maxLength) {
            $excerpt   = substr($str, $startPos, $maxLength - 6);
            $lastSpace = strrpos($excerpt, ' ');
            $excerpt   = substr($excerpt, 0, $lastSpace);
            $excerpt  .= ' [...]';
        } else {
            $excerpt = $str;
        }

        return $excerpt;
    }
}
