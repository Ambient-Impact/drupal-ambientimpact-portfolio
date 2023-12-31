This Drupal module contains the portfolio View, content type, image styles, and
taxonomy vocabulary for
[ambientimpact.com/portfolio](https://ambientimpact.com/portfolio).

**Warning**: while this is generally production-ready, it's not guaranteed to
maintain a stable API and may occasionally contain bugs, being a
work-in-progress. Stable releases may be provided at a later date.

----

# Requirements

* [Drupal 9.5 or 10](https://www.drupal.org/download)

* [Composer](https://getcomposer.org/)

## Drupal dependencies

Before attempting to install this, you must add the Composer repositories as
described in the installation instructions for these dependencies:

* The [`ambientimpact_core`](https://github.com/Ambient-Impact/drupal-ambientimpact-core) and [`ambientimpact_media`](https://github.com/Ambient-Impact/drupal-ambientimpact-media) modules.

----

# Installation

## Composer

### Set up

Ensure that you have your Drupal installation set up with the correct Composer
installer types such as those provided by [the `drupal/recommended-project`
template](https://www.drupal.org/docs/develop/using-composer/starting-a-site-using-drupal-composer-project-templates#s-drupalrecommended-project).
If you're starting from scratch, simply requiring that template and following
[the Drupal.org Composer
documentation](https://www.drupal.org/docs/develop/using-composer/starting-a-site-using-drupal-composer-project-templates)
should get you up and running.

### Repository

In your root `composer.json`, add the following to the `"repositories"` section:

```json
"drupal/ambientimpact_portfolio": {
  "type": "vcs",
  "url": "https://github.com/Ambient-Impact/drupal-ambientimpact-portfolio.git"
}
```

### Installing

Once you've completed all of the above, run `composer require
"drupal/ambientimpact_portfolio:^1.0@dev"` in the root of your project to have
Composer install this and its required dependencies for you.
