# [Trustee Profile](https://github.com/SU-SWS/trustee_profile)
##### 1.x
[![CircleCI](https://circleci.com/gh/SU-SWS/trustee_profile.svg?style=svg)](https://circleci.com/gh/SU-SWS/trustee_profile)
[![Test Coverage](https://api.codeclimate.com/v1/badges/9e16872314a79186f4fe/test_coverage)](https://codeclimate.com/github/SU-SWS/trustee_profile/test_coverage)
[![Maintainability](https://api.codeclimate.com/v1/badges/9e16872314a79186f4fe/maintainability)](https://codeclimate.com/github/SU-SWS/trustee_profile/maintainability)

Maintainers: [Mike Decker](https://github.com/pookmish), [sherakama](https://github.com/sherakama)

Changelog: [Changelog.md](CHANGELOG.md)

Description
---

This is the main installation profile for Stanford Web Services' self service platform and is used as a base for more.

Accessibility
---
[![WCAG Conformance 2.0 AA Badge](https://www.w3.org/WAI/wcag2AA-blue.png)](https://www.w3.org/TR/WCAG20/)
This module conforms to level AA WCAG 2.0 standards as required by the university's accessibility policy. For more information on the policy please visit: [https://ucomm.stanford.edu/policies/accessibility-policy.html](https://ucomm.stanford.edu/policies/accessibility-policy.html).

Installation
---

Install this installation profile like any other profile. [See Drupal Documentation](https://www.drupal.org/docs/7/install/using-an-installation-profile)

Upstream updates
---

Pull from [stanford_profile](https://github.com/SU-SWS/stanford_profile.git) by running the command `git pull https://github.com/SU-SWS/stanford_profile.git 11.x -X ours --no-edit`.

There is possibly going to be some conflicts. Clear up those conflicts and commit the changes.

Releases
---

Steps to build a new release:
- Checkout the latest commit from the most recent default branch.
- Create a new branch for the release.
- Commit any necessary changes to the release branch.
  -  These may include, but are not necessarily limited to:
  - Update the version in any `info.yml` files, including in any submodules.
  - Update the CHANGELOG to reflect the changes made in the new release.
- Make a PR to merge your release branch into `main`
- Give the PR a semver-compliant label, e.g., (`patch`, `minor`, `major`).  This may happen automatically via Github actions (if a labeler action is configured).
- When the PR is merged to the default branch, a new tag will be created automatically, bumping the version by the semver label.
- The github action is built from: [semver-release-action](https://github.com/K-Phoen/semver-release-action), and further documentation is available there.


Troubleshooting
---

If you are experiencing issues with this try posting an issue on the [GitHub issues page](https://github.com/SU-SWS/trustee_profile/issues).

Contribution / Collaboration
---

You are welcome to contribute functionality, bug fixes, or documentation to this module. If you would like to suggest a fix or new functionality you may add a new issue to the GitHub issue queue or you may fork this repository and submit a pull request. For more help please see [GitHub's article on fork, branch, and pull requests](https://help.github.com/articles/using-pull-requests)
