# ESLint shareable config for the [SweetAlert2](https://github.com/sweetalert2/sweetalert2) JS/TS coding style

[![npm version](https://img.shields.io/npm/v/@sweetalert2/eslint-config.svg)](https://www.npmjs.com/package/@sweetalert2/eslint-config)
[![semantic-release](https://img.shields.io/badge/%20%20%F0%9F%93%A6%F0%9F%9A%80-semantic--release-e10079.svg)](https://github.com/sweetalert2/eslint-config/blob/master/CHANGELOG.md)


> ESLint [shareable config](http://eslint.org/docs/developer-guide/shareable-configs.html) for the [SweetAlert2](https://github.com/sweetalert2/sweetalert2) JS/TS coding style


## Installation

```
$ npm install --save-dev @sweetalert2/eslint-config
```

or

```
$ yarn add --dev @sweetalert2/eslint-config
```


## Usage

Once the `@sweetalert2/eslint-config` package is installed, you can use it by specifying `@sweetalert2/eslint-config` in the [`extends`](http://eslint.org/docs/user-guide/configuring#extending-configuration-files) section of your [ESLint configuration](http://eslint.org/docs/user-guide/configuring).

```js
{
  "extends": "@sweetalert2/eslint-config",
  "rules": {
    // Additional, per-project rules...
  }
}
```
