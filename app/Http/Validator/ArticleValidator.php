<?php

namespace App\Http\Validator;


class ArticleValidator extends ValidatorAbstract
{
    public function __construct(string $methodName)
    {
        $this->selfRule = [
            'listArticle' => [
                'page' => 'numeric'
            ]
        ];
        parent::__construct($methodName);
    }
}
