# READY FOR REVIEW

# Summary
- Quarterly trustee_profile update that pulls in upstream stanford_profile release 12.2.4 on top of 6.x.
- Includes dependency and CI workflow updates, broad config re-exports, upstream theme/component/template changes, and test updates that came with the release.
- Removes the react_paragraphs module (and its `paragraph_row`/`react_paragraphs` REST resource config) since it is obsolete and fails to install in test environments after the upstream update. Confirmed no production sites (bot, boardagenda, cabinet, governance, trustees, trusteeship) have any rows in `paragraph_rows_item`, so this is safe to remove.
- Adds `--core-version=11.3` to the CI test runner invocations so Codeception/PHPUnit fresh installs pin to Drupal core 11.3, matching the `drupal/core: ~11.3.0` constraint in composer.json. Without this, stanford-caravan's `composer require drupal/core:^11` was resolving to 11.4.5 and breaking the SystemCest core-version assertion.
- Main review focus should be config import safety and regression checks around path aliases, search indexing, lockup/footer rendering, and media handling.

# Known Issue (documented, not blocking)
- SystemCest now sees an extra Status Report error on fresh installs: "Transaction isolation level" flags `stanford_decoupled_revalidation` as missing a primary key. Root cause: `stanford_profile_helper` 10.2.9 (the currently tagged/required version) defines `stanford_decoupled_schema()` without a `primary key`, so fresh installs create the table without one. A later upstream update hook does add the primary key via `addPrimaryKey()`, but that only runs against sites that already had the module installed and then ran `drush updb` — it doesn't help brand-new installs, which is why this only shows up in CI/fresh-install testing and not on our existing sites. There's already a fix upstream for a future `stanford_profile_helper` release. Since BOT (and the other trustee sites) are not decoupled and never use this table, this is safe to merge as-is rather than special-casing the test.

# Review By (Date)
- TBD by release schedule.

# Criticality
- 7
- This affects the shared trustee profile and can impact all sites built from it, not just a single site.

# Urgency
- Normal

# Review Tasks

## Setup tasks and/or behavior to test

1. Check out this branch.
2. Run dependency install if needed, then rebuild caches and import config: `composer install && drush cr ; drush cim -y`.
3. Sanity-check that config import completes cleanly and no unexpected deletions remain beyond the upstream release changes.
4. Verify core editorial flows still work for representative content types: create/edit a basic page, news item, event, person, and media item.
5. Confirm path aliases generate with the expected leading slash for content and taxonomy patterns.
6. Confirm search still indexes content correctly, including Algolia-related filters and trash-aware indexing changes.
7. Verify lockup and local footer rendering, including custom logo alt text behavior, on the front end.
8. Verify media imports/uploads still populate dimensions correctly when image metadata is available.
9. Confirm react_paragraphs is no longer installed and no content/config still references the removed `paragraph_row`/`react_paragraphs` REST resources.

### Site Configuration Sync

- Yes. This PR contains a large config export/re-export in the sync directory.
- Pay particular attention to Pathauto patterns, search index config, CKEditor config, role permissions, content lock settings, RSS config removal, and view display changes.

## Front End Validation
- [ ] Design is approved by @ user?
- [ ] HTML validation: Is the markup using the appropriate semantic tags and passes validation? Or, QA request ticket created?
- [ ] Cross-browser testing: Has been performed? Or, QA request ticket created?
- [ ] Automated accessibility: Scans performed? Or, QA request ticket created?
- [ ] Manual accessibility: Manually tested? Or, QA request ticket created?

## Backend / Functional Validation
### Code
- [x] Are the naming conventions following our standards?
- [x] Does the code have sufficient inline comments?
- [x] Is there anything in this code that would be hidden or hard to discover through the UI?
- [ ] Are there any code smells?
- [x] Are tests provided? eg (unit, behat, or codeception)

### Code security
- [x] Are all forms properly sanitized?
- [x] Any obvious security flaws or new areas for attack?

## General
- [x] Is there anything included in this PR that is not related to the problem it is trying to solve?
- [x] Is the approach to the problem appropriate?

# Affected Projects or Products
- All sites using trustee_profile.
- Highest impact areas are shared config, shared editorial UX, Jemison/Stanford Basic theme output, CI workflows, and search/indexing behavior.

# Associated Issues and/or People
- JIRA ticket(s): SWSDEVOPS-281
- Other PRs: none noted
- Context: started from `6.x`, then pulled in upstream stanford_profile changes from release `12.2.4` instead of tracking the moving `12.x` branch head.
- Context: notable updates in the diff include Drupal and package version bumps, GitHub Actions version updates, config re-exports across multiple views and pathauto patterns, lockup/footer accessibility and test fixes, a defensive media image-size handling fix in the profile event subscriber, removal of the obsolete react_paragraphs module, and a CI test-runner fix (`--core-version=11.3`) for stanford-caravan.
- Also applied to ace-botgryphon (react_paragraphs removal pulled in and committed there as well).
- Anyone who should be notified? Add release reviewers and any owners of shared profile config/theme output as needed.

# Resources
- [AMP Tool](https://stanford.levelaccess.net/index.php)
- [Accessibility Manual Test Script](https://docs.google.com/document/d/1ZXJ9RIUNXsS674ow9j3qJ2g1OAkCjmqMXl0Gs8XHEPQ/edit?usp=sharing)
- [HTML Validator](https://validator.w3.org/)
- [Browserstack](https://live.browserstack.com/dashboard) and link to [Browserstack Credentials](https://asconfluence.stanford.edu/confluence/display/SWS/External+Account+Credentials)