<?php

namespace App\Consts;

class CategoryConsts
{
    public const Business = 1;
    public const Magazine = 2;
    public const Computer = 3;
    public const Comic = 4;
    public const Hobby = 5;
    
    public const  Category_List = [
        'ビジネス' => self::Business,
        '雑誌' => self::Magazine,
        'コンピュータ・IT' => self::Computer,
        "コミック" => self::Comic,
        "趣味・実用" => self::Hobby,
    ];

}