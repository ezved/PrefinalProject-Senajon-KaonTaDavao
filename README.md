# Kaon Ta! Davao – Senajon's Food Guide

**Lourrence Ed Senajon**

A public Laravel 12 and SQLite guide to carinderias and eateries in Davao City. Browse by district, compare dishes and prices, and read or post reviews.

## Setup

Use PHP 8.2 or later with PDO SQLite, Composer, and Node.js 20.19 or later in the 20.x series, or Node.js 22.12 or later.

```sh
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate:fresh --seed
npm install
npm run build        # or npm run dev while developing
php artisan serve
```

On Windows PowerShell, use `Copy-Item .env.example .env` and `New-Item -ItemType File database/database.sqlite` for the two file commands. Open the local address printed by Artisan.

## Personalized seed data

| Item | Values |
| --- | --- |
| Districts | Poblacion, Talomo, Agdao, Buhangin, Toril, Bunawan |
| Features | Suki ni Senajon, Budget Meal, Halal, Open 24 Hours, Aircon, Takeout |
| Reviewers | Lourrence Ed Senajon (`senajon@kaonta.test`) and Tita Senajon (`tita.senajon@kaonta.test`) |
| Eatery | Carinderia ni Senajon (`carinderia-ni-senajon`), San Pedro St., Poblacion, Davao City |
| Eatery details | Budget, open, Tinolang Manok, Suki ni Senajon and Budget Meal |
| Permit | `DVO-2026-1015`, expiring October 15, 2027 |

## Relationships

| Relationship | Eloquent methods | Why it fits |
| --- | --- | --- |
| District and Eatery | `hasMany` / `belongsTo` | A district can list many eateries and each eatery has one district. |
| Eatery and Dish | `hasMany` / `belongsTo` | A menu can contain several dishes, each listed under one eatery. |
| Eatery and Review | `hasMany` / `belongsTo` | Many diners can review the same eatery, and each review is about one eatery. |
| User and Review | `hasMany` / `belongsTo` | A reviewer can write many reviews, each under a single name. |
| Eatery and Permit | `hasOne` / `belongsTo` | The guide keeps one permit per eatery, and that permit identifies one eatery. |
| Eatery and Feature | `belongsToMany` both ways | Eateries can share features and an eatery can have several features. |
| District and Review | `hasManyThrough` via Eatery | A district counts reviews through the eateries located in it. |

## Routes

```text
  GET|HEAD        / ............................................................................ home › HomeController
  GET|HEAD        districts ............................................... districts.index › DistrictController@index
  GET|HEAD        districts/{district} ...................................... districts.show › DistrictController@show
  GET|HEAD        eateries ................................................... eateries.index › EateryController@index
  POST            eateries ................................................... eateries.store › EateryController@store
  GET|HEAD        eateries/create .......................................... eateries.create › EateryController@create
  GET|HEAD        eateries/{eatery} ............................................ eateries.show › EateryController@show
  PUT|PATCH       eateries/{eatery} ........................................ eateries.update › EateryController@update
  DELETE          eateries/{eatery} ...................................... eateries.destroy › EateryController@destroy
  GET|HEAD        eateries/{eatery}/edit ....................................... eateries.edit › EateryController@edit
  POST            eateries/{eatery}/reviews .......................... eateries.reviews.store › ReviewController@store
  GET|HEAD        reviewers/{user} .......................................... reviewers.show › ReviewerController@show
  DELETE          reviews/{review} ........................................ reviews.destroy › ReviewController@destroy

                                                                                                   Showing [13] routes
```


## Screenshots

- [Eatery list](screenshots/eatery-list.png)
- [Carinderia ni Senajon and its reviews](screenshots/eatery-reviews.png)
- [Create form with validation errors](screenshots/create-validation.png)
