# stylelint shareable config for the [SweetAlert2](https://github.com/sweetalert2/sweetalert2) SCSS coding style

[![Build Status](https://github.com/sweetalert2/stylelint-config/workflows/build/badge.svg)](https://github.com/sweetalert2/stylelint-config/actions)
[![npm version](https://img.shields.io/npm/v/@sweetalert2/stylelint-config.svg)](https://www.npmjs.com/package/@sweetalert2/stylelint-config)
[![semantic-release](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantic--release-e10079.svg)](https://github.com/sweetalert2/stylelint-config/blob/master/CHANGELOG.md)


SCSS linting rules, this extends the basic stylelint rules for use with [SweetAlert2](https://github.com/sweetalert2/sweetalert2)'s projects.

---
## Installation

```sh
yarn add @sweetalert2/stylelint-config
```


---

## .stylelintrc

```js
{
  "extends": "@sweetalert2/stylelint-config",
  "rules": {
    // Additional, per-project rules...
  }
}
```

---

## example package.json script

```json
"scripts": {
  "lint:scss": "stylelint **/*.scss --cache",
}
```

which would allow you to lint your project via `yarn lint:scss`
