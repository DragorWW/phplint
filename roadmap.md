## Road map
- CLI
    - [ ] `--config`
    - [ ] `--rulesdir`
    - [X] `--ignore-path`
    - [x] `--ignore-pattern`
    - [ ] `--fix`
- Config
    - [ ] Support config yaml
    - [ ] Load config yaml in `__DIR__`
    - [ ] Root config
    - [ ] Extend config
    - [ ] Config in subdir
    - [ ] Support ini, xml config
    - [ ] Support json config
    - [ ] Support php config
    - [ ] load config from composer.json
    - [ ] config validator
- Inline Comments
    - [ ] support lint disable `/* phplint-disable */`, `/* eslint-enable */`
    - [ ] support rule disable `/* eslint eqeqeq: "off" */`
- Ignore config
    - [ ] support `.phplintignore`
- Rules
    - [ ] Support rules
    - [ ] Support custom rules
    - [ ] Support level `off, warn, error`
    - [ ] Support recommended
- Load Rules
    - [ ] Rules loader
    - [ ] Load Rule by config
- Plugin
    - [ ] Support custom plugins
- Formatters
    - [ ] html
    - [ ] json
    - [ ] codeframe
    - [ ] stylish
- Test
    - [x] Install PhpUnit
    - [ ] test config cli
    - [ ] test rules
    - [ ] test plugins
    - [ ] test config
- [ ] console validator output:
    ```
    foo.php
      0:0  warning  File ignored because of your .eslintignore file. Use --no-ignore to override.
    
    ✖ 1 problem (0 errors, 1 warning)
    ```