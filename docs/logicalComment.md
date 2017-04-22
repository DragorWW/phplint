# Logical comment
- `phplint`
- `phplint-disable`
- `phplint-enable`
- `phplint-disable-line`
- `phplint-disable-line`
- `phplint-disable-next-line`


## Disabling Rules with Inline Comments

To temporarily disable rule warnings in your file, use block comments in the following format:

```php
<?php
/* phplint-disable */

echo "foo";

/* phplint-enable */
```

You can also disable or enable warnings for specific rules:

```php
<?php
/* phplint-disable noEcho, useNamespace */

echo "foo";

/* phplint-enable noEcho, useNamespace */
```

To disable rule warnings in an entire file, put a `/* phplint-disable */` block comment at the top of the file:

```php
<?php
/* phplint-disable */

echo "foo";
```

You can also disable or enable specific rules for an entire file:

```php
<?php
/* phplint-disable noEcho */

echo "foo";
```

To disable all rules on a specific line, use a line comment in one of the following formats:

```php
<?php
 echo "foo";// phplint-disable-line

// phplint-disable-next-line
echo "foo";
```

To disable a specific rule on a specific line:

```php
<?php
 echo "foo";// phplint-disable-line NoEcho

// phplint-disable-next-line NoEcho
echo "foo";
```

To disable multiple rules on a specific line:

```php
<?php
 echo "foo"; // phplint-disable-line NoEcho

// phplint-disable-next-line NoEcho
echo "foo";
```

All of the above methods also work for plugin rules. For example, to disable `phplint-plugin-example`'s `rule-name` rule, combine the plugin's name (`example`) and the rule's name (`rule-name`) into `example/rule-name`:

```php
<?php
foo(); // phplint-disable-line example/rule-name
```

**Note:** Comments that disable warnings for a portion of a file tell PHPLint not to report rule violations for the disabled code. PHPLint still parses the entire file, however, so disabled code still needs to be syntactically valid JavaScript.