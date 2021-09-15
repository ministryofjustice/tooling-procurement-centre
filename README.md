# Tooling Procurement Centre
<img src="https://www.gov.uk/assets/collections/govuk_publishing_components/crests/org_crest_18px-7026afebba9918a0830ebf68cf496cbb0b81f3514b884dc2c32904780baa3368.png" width="18">&nbsp;&nbsp;**Ministry of Justice, Digital & Technology**

---

The core purpose of the TPC (Tooling Procurement Centre) is to aggregate data related to tooling within government digital teams and display exploratory reports and structured data for administrative review, financial quantification and high-confidence decision-making.

### Coding
There is an integrated development environment (IDE) built-in, with the help of Docker. If you have Docker installed on your machine you can easily launch the website locally using the guidance below.

## Installation for development

The configuration uses multiple Docker containers and volumes to manage ephemeral assets and caching. The view is to speed up and strengthen the environment for development. The result is a faster loading time with hot reloading of frontend assets. The focus has been primarily on creating a fluid development environment.

***MacOS example***
1. `cd ~/`
2. `git clone https://github.com/ministryofjustice/tooling-procurement-centre`
3. `cd tooling-procurement-centre && make dshell`
4. In your new docker shell, run: `make setup`
5. `exit`
6. `make restart`
7. Visit http://127.0.0.1:8000/

Nb. steps 5 and 6 are necessary and fix a bug that occurs due to Laravel's APP_KEY being generated on the fly, and the systems' inability to read environment variables that change after init. When we restart the containers the newly generated APP_KEY loads correctly.  

## Laravel inside...
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
