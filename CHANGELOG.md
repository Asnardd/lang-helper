# Changelog

All notable changes to this project will be documented in this file.

## [2.2.0] - 2025-02-28
### Changed
- Removed illuminate/contracts as a dependencies since it caused some incompatibilities (this package is only installed in a laravel that possess it anyway)

## [2.0.2] - 2025-02-12
### Changed
- Modified tests to ensure directory creation.
- Updated dependencies.

### Added
- Implemented GitHub Actions to automatically run tests after a push.

## [2.0.0] - 2025-02-11

### Added
- Implemented tests for the package.
- Added the ability to overwrite existing files with the `--overwrite` option.

### Changed
- Optimized the code for better performance.

## [1.0.0] - 2025-02-04

### Added
- Initial release with base setup using Spatie Skeleton Project.
- Implemented the `make:lang` command.
- Added keywords for better discoverability.

### Removed
- Removed unnecessary lines from the initial setup.