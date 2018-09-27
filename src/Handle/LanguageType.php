<?php

/*
 * This file is part of the sayhe110/translation
 *
 * (c) sayhe110 <949426374@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sayhe110\Translation\Handle;

use Sayhe110\Translation\Exceptions\InvalidArgumentException;

/**
 * 处理 from/to 语言类型是否在翻译范围之内
 * Class LanguageType.
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
        if (!\in_array($this->language, $this->languages)) {
            throw new InvalidArgumentException('Translation language is not within the scope of translation.');
        }

        return;
    }
}
