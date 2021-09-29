# WP Async Posts Provider: Changelog

## v0.2.0: Include JS dependency

With this change, the composer package delivers the frontend dependency
[@gebruederheitz/wp-async-posts-loader](https://www.npmjs.com/package/@gebruederheitz/wp-async-posts-loader)
under `/js`. This way, you won't have to think about managing the cross-dependencies
between the two packages yourself, which has caused issues with v0.1.2.

See the updated [README](./README.md#usage-on-the-front-end) for how to use the JS.
When upgrading to v0.2 we recommend removing any manual reference to the NPM
package you might have set from your dependencies and adjust your JS import
statements to load the scripts bundled with this package
(`path/to/composer/vendor/gebruederheitz/wp-async-posts-provider/js`) instead
of any directly required NPM dependency.



## v0.1.2: Replace REST trait with external library

Uses `gebruederheitz/wp-simple-rest` instead of the custom REST trait. This
changes the default REST route prefix exposed by the library from
`/wp-json/ghwapp/v1` to `/wp-json/ghwp/v1` **and therefore requires you to use
at least version v0.1 of 
[@gebruederheitz/wp-async-posts-loader](https://www.npmjs.com/package/@gebruederheitz/wp-async-posts-loader)**.
