# php-language-server-symlinks-minimal-test-case
test case for local repositories discovery in PHP Language Server by Felix Becker

https://github.com/felixfbecker/php-language-server/issues/586

Minimal case to test on:

```sh
$ cd ~/tmp
$ git clone https://github.com/cprn/php-language-server-symlinks-minimal-test-case.git
$ cd php-language-server-symlinks-minimal-test-case.git
$ cd myProject
$ composer install
$ php run.php
GULP!    # printing "GULP!" means autoload worked
```

The content of `myProject` should look like this:
```
.
├── composer.json
├── composer.lock
├── run.php
├── src
│   └── Drink.php
└── vendor
    ├── autoload.php
    ├── cg
    │   └── my-local-bundle -> ../../../myLocalBundle
    └── composer
        └── ...
```

Now open `src/Drink.php` and try to jump to `Bundle\Bar` definition. The client calls `textDocument/definition`  method with position 12,4 and gets an empty set of results in response:
```
13:55:44 INFO writer-Some("php") src/rpcclient.rs:215 => Some("php") {"jsonrpc":"2.0","method":"textDocument/definition","params":{"bufnr":1,"filename":"/home/user/tmp/php-language-server-symlinks-minimal-test-case/myProject/src/Drink.php","gotoCmd":null,"handle":true,"languageId":"php","method":"textDocument/definition","position":{"character":12,"line":4},"textDocument":{"uri":"file:///home/user/tmp/php-language-server-symlinks-minimal-test-case/myProject/src/Drink.php"}},"id":2}
13:55:44 INFO reader-Some("php") src/rpcclient.rs:169 <= Some("php") {"result":[],"id":2,"jsonrpc":"2.0"}
```
