<?php

namespace Sayhe110\Translation\Handle;

use Sayhe110\Translation\Exceptions\InvalidArgumentException;

/**
 * 处理 from/to 语言类型是否在翻译范围之内
 * Class LanguageType
 * @package Sayhe110\Translation\Handle
 */
class LanguageType
{
    // 百度翻译语言列表
    protected $languages = [
        'zh', 'en', 'yue', 'wyw', 'jp', 'kor', 'fra', 'spa', 'th', 'ara',
        'ru', 'pt', 'de', 'it', 'el', 'nl', 'pl', 'bul', 'est', 'dan', 'fin',
        'cs', 'rom', 'slo', 'swe', 'hu', 'cht', 'vie',
    ];

    protected $language = '';

    public function __construct($language)
    {
        $this->language = $language;
    }

    public function checkLanguage()
    {
        if(! \in_array($this->language, $this->languages)){
            throw new InvalidArgumentException('Translation language is not within the scope of translation.');
        }
        return;
    }
}
