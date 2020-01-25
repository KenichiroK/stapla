module.exports = {
  env: {
    browser: true,
    es6: true,
    jquery: true,
  },
  extends: "plugin:prettier/recommended",
  globals: {
    Atomics: "readonly",
    SharedArrayBuffer: "readonly",
  },
  plugins: ["jquery"],
  parserOptions: {
    ecmaVersion: 2018,
    sourceType: "module",
  },
  rules: {},
};
