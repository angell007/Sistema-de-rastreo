<?php

namespace App\Services;

use App\Empresa;

class imgUploader
{

    public function saveImg($img): void
    {
        $empresa = Empresa::first();
        $empresa->img = $img->move(public_path('/img/'), 'logo.png');
        $empresa->save();
    }
}
