<?php

/*
 * This file is part of the sayhe110/translation
 *
 * (c) sayhe110 <949426374@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Sayhe110\Translation\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;
use Mockery\Matcher\AnyArgs;
use PHPUnit\Framework\TestCase;
use Sayhe110\Translation\Exceptions\HttpException;
use Sayhe110\Translation\Exceptions\InvalidArgumentException;
use Sayhe110\Translation\Translation;

class TranslationTest extends TestCase
{
    public function testGetHttpClient()
    {
        $translation = new Translation('mock-key', 'mock-appid');
        $this->assertInstanceOf(ClientInterface::class, $translation->getHttpClient());
    }

    public function testSetGuzzleOptions()
    {
        $translation = new Translation('mock-key', 'mock-appid');
        $this->assertNull($translation->getHttpClient()->getConfig('timeout'));
        $translation->setGuzzleOptions(['timeout' => 5000]);
        $this->assertSame(5000, $translation->getHttpClient()->getConfig('timeout'));
    }

//    public function testGetTranslation()
//    {
//        $response = new Response(200, [], '{"success": true}');
//
//        $client = \Mockery::mock(Client::class);
//
//        $client->allows()->get('http://api.fanyi.baidu.com/api/trans/vip/translate', [
//            'q' => '我要翻译这段话。。',
//            'from' => 'zh',
//            'to' => 'en',
//            'appid' => 'mock-appid',
//            'salt' => time(),
//            'sign' => 'mock-sign',
//        ])->andReturn($response);
//
//        $translation = \Mockery::mock(Translation::class, ['mock-key', 'mock-appid'])->makePartial();
//        $translation->allows()->getHttpClient()->andReturn($client);
//
//        $this->assertSame(['success' => true], $translation->translation('我要翻译这段话。。。'));
//    }

    /**
     * 检查 text 参数.
     *
     * @throws HttpException
     * @throws InvalidArgumentException
     */
    public function testGetTranslationWithInvalidText()
    {
        $translation = new Translation('mock-key', 'mock-appid');

        $this->expectException(InvalidArgumentException::class);

        $this->expectExceptionMessage('Invalid translation text');

        $translation->translation('');

        $this->fail('Faild to assert translation throw exception with invalid argument.');
    }

    /**
     * 检查 from 参数.
     *
     * @throws HttpException
     * @throws InvalidArgumentException
     */
    public function testGetTranslationWithInvalidFrom()
    {
        $translation = new Translation('mock-key', 'mock-appid');

        $this->expectException(InvalidArgumentException::class);

        $this->expectExceptionMessage('Translation language is not within the scope of translation.');

        $translation->translation('我要翻译这段话。。。', 'abc');

        $this->fail('Faild to assert translation throw exception with invalid argument.');
    }

    /**
     * 检查 to 参数.
     *
     * @throws InvalidArgumentException
     * @throws HttpException
     */
    public function testGetTranslationWithInvalidTo()
    {
        $translation = new Translation('mock-key', 'mock-appid');

        $this->expectException(InvalidArgumentException::class);

        $this->expectExceptionMessage('Translation language is not within the scope of translation.');

        $translation->translation('我要翻译这段话。。。', 'zh', 'abc');

        $this->fail('Faild to assert translation throw exception with invalid argument.');
    }

    /**
     * time out.
     */
    public function testGetTranslationWithGuzzleRuntimeException()
    {
        $client = \Mockery::mock(Client::class);
        $client->allows()
            ->get(new AnyArgs()) // 由于上面的用例已经验证过参数传递，所以这里就不关心参数了。
            ->andThrow(new \Exception('request timeout')); // 当调用 get 方法时会抛出异常。

        $translation = \Mockery::mock(Translation::class, ['mock-key', 'mock-appid'])->makePartial();
        $translation->allows()->getHttpClient()->andReturn($client);

        // 接着需要断言调用时会产生异常。
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage('request timeout');

        $translation->translation('我要翻译这段话。。。');
    }
}
