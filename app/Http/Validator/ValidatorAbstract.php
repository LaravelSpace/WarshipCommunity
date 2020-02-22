<?php

namespace App\Http\Validator;


use Illuminate\Support\Facades\Validator;

abstract class ValidatorAbstract
{
    // 执行检测的字段和规则
    protected $validateRule;

    // 执行检测规则的提示文案
    protected $validateMessage;

    // 执行检测规则的提示文案中需要替换的 :attribute
    protected $validateAttributes;

    // 通用的检测字段和规则
    protected $commonRule;

    // 通用的检测规则的提示文案
    protected $commonMessage;

    // 通用的检测规则的提示文案中需要替换的 `:attribute`
    // 如果需要使用参考 `Validator::make()` 方法的第四个参数。
    protected $commonAttributes;

    // 私有的（由具体实例使用）检测字段和规则
    protected $selfRule;

    // 私有的（由具体实例使用）检测规则的提示文案
    protected $selfMessage;

    // 私有的（由具体实例使用）检测规则的提示文案中需要替换的 `:attribute`
    protected $selfAttributes;

    // 私有的（由具体实例使用）不需要检测的字段
    protected $filterField;

    public function __construct(string $methodName)
    {
        $this->commonRule = [];
        $this->commonMessage = [
            'numeric' => '请求参数{:attribute}必须是数字。'
        ];
        $this->commonAttributes = [];
        $this->getValidateRule($methodName);
    }

    protected function getValidateRule(string $methodName)
    {
        // 组合执行检测的字段和规则
        $this->validateRule = $this->commonRule;
        if (!empty($this->selfRule)
            && array_key_exists($methodName, $this->selfRule)
            && !empty($this->selfRule[$methodName])) {
            $this->validateRule = array_merge($this->commonRule, $this->selfRule[$methodName]);
        }
        if (!empty($this->filterField)) {
            foreach ($this->filterField as $itemField) {
                if (array_key_exists($itemField, $this->validateRule)) {
                    unset($this->validateRule[$itemField]);
                }
            }
        }

        // 组合执行检测规则的提示文案
        $this->validateMessage = $this->commonMessage;
        if (!empty($this->selfMessage)
            && array_key_exists($methodName, $this->selfMessage)
            && !empty($this->selfMessage[$methodName])) {
            $this->validateMessage = array_merge($this->commonMessage, $this->selfMessage[$methodName]);
        }
    }

    /**
     * @param $validateData
     * @throws \App\Exceptions\ValidationException
     */
    public function validate($validateData)
    {
        $validator = Validator::make($validateData, $this->validateRule, $this->validateMessage);
        // $validator = Validator::make($validateData, $this->validateRule, $this->validateMessage, $this->commonAttributes);
        if ($validator->fails() >= 1) {
            $errors = $validator->errors()->messages();
            $resultMessage = '';
            foreach ($errors as $itemError) {
                foreach ($itemError as $itemMessage) {
                    $resultMessage .= $itemMessage;
                }
            }
            gRenderValidationException($resultMessage);
        }
    }
}
