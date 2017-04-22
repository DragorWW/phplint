[![Build Status](https://travis-ci.org/DragorWW/phplint.svg?branch=develop)](https://travis-ci.org/DragorWW/phplint)

# PHP Lint
This is implementate ESLint architecture for PHP code lint

## inatall
```bash
cd ./phplint
composer intall
```
# Usage
```bash
./bin/php-lint ./test/mock/rule/
```

- http://eslint.org/docs/developer-guide/architecture
- http://eslint.org/docs/developer-guide/working-with-rules


- Reporter
- Fixer
- Rules
- Config
- Plugin


## architecture
### Rules
- Options Schemas
- report
- options
```
context.report({
    node: node,
    message: "Unexpected identifier: {{ identifier }}",
    data: {
        identifier: node.name
    }
});
```
- fix
```
context.report({
    node: node,
    message: "Missing semicolon",
    fix: function(fixer) {
        return fixer.insertTextAfter(node, ";");
    }
});
```
```
meta: {
    docs: {
        description: "disallow unnecessary semicolons",
        category: "Possible Errors",
        recommended: true
    },
    fixable: "code",
    schema: [] // no options,
    deprecated: false,
},
```

### Rule Naming Conventions
The rule naming conventions for ESLint are fairly simple:

- If your rule is disallowing something, prefix it with no- such as no-eval for disallowing eval() and no-debugger for disallowing debugger.
- If your rule is enforcing the inclusion of something, use a short name without a special prefix.
- Keep your rule names as short as possible, use abbreviations where appropriate, and no more than four words.
- Use dashes between words.