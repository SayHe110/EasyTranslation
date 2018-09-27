# translation

[![Build Status](https://travis-ci.org/SayHe110/translation.svg?branch=master)](https://travis-ci.org/SayHe110/translation)
![StyleCI build status](https://github.styleci.io/repos/150516140/shield) 

## 安装

```shell
$ composer require sayhe110/translation -vvv
```

## 使用

```php
use Sayhe110\Translation\Translation;

$key = 'XXXXXXXXXXXXXXXXXXXXXXXX';
$appid = 'XXXXXXXXXXXXXXXXXXXXXXXX';

$translation = new Translation($key, $appid);

$result = $translation->translation('我要翻译这段话');
```

### 示例
```json
{
    "from": "zh",
    "to": "en",
    "trans_result": [
        {
            "src": "我要翻译这段话",
            "dst": "I want to translate this passage."
        }
    ]
}
```

### 参数说明
```
translation($text, $from, $to, $canHttps)
```
> - `$text` - 翻译的字符串
> - `$from` - 源译文语言类型，默认为：`auto`
> - `$to` - 目标译文语言类型，默认为：`en`
> - `$canHttps` - 是否使用 `https` 进行请求

#### 具体翻译语言范围
参考 [百度翻译开放平台 通用翻译API技术文档](http://api.fanyi.baidu.com/api/trans/product/apidoc)

### 在 Laravel 中使用

```shell
$ composer require sayhe110/translation -vvv
```

在 `config/services.php` 中:
```php
'translation' => [
     'key' => env('TRANSLATION_KEY'),
     'appid' => env('TRANSLATION_APPID'),
],
```
在 `env` 文件中：
```php
TRANSLATION_KEY=XXXXXXXXXXXXXXXXXXXXXXXX
TRANSLATION_APPID=XXXXXXXXXXXXXXXXXXXXXXXX
```
#### 示例
##### 方法参数注入
```php
use Sayhe110\Translation\Translation;

public function translation(Translation $translation)
{
    return $translation->translation('我要翻译这段话。。')；
}
```
##### 服务名访问
```php
public function translation()
{
    return app('translation')->translation('我要翻译这段话。。。');
}
```
## License
MIT

### 参考
- [百度翻译开发平台](http://api.fanyi.baidu.com/api/trans/product/index)
- [超哥的天气SDK](https://github.com/overtrue/weather)

### Todo
- [ ] 添加2-3家翻译平台，放置一家服务挂了，导致 SDK 不能够使用

### Other
若在使用中有什么疑问或者发现有什么问题，欢迎提交 `issues`, 或者 `PR`
