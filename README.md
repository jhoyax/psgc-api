# Philippine Standard Geographic Code API

## Routes

```
+----------+------------------------------------------+
| Method   | URI                                      |
+----------+------------------------------------------+
| GET|HEAD | api/barangays                            |
| GET|HEAD | api/barangays/{barangay}                 |
| GET|HEAD | api/cities                               |
| GET|HEAD | api/cities/{city}                        |
| GET|HEAD | api/districts                            |
| GET|HEAD | api/districts/{district}                 |
| GET|HEAD | api/municipalities                       |
| GET|HEAD | api/municipalities/{municipality}        |
| GET|HEAD | api/provinces                            |
| GET|HEAD | api/provinces/{province}                 |
| GET|HEAD | api/regions                              |
| GET|HEAD | api/regions/{region}                     |
| GET|HEAD | api/sub-municipalities                   |
| GET|HEAD | api/sub-municipalities/{subMunicipality} |
| GET|HEAD | api/summary                              |
+----------+------------------------------------------+
```

## Pagination

`/api/regions?per_page=20`

## Includes

```
/api/regions?include=provinces,districts,cities
/api/regions/010000000?include=provinces
/api/regions/130000000?include=districts
/api/regions/090000000?include=cities

/api/provinces?include=cities,municipalities
/api/provinces/012800000?include=municipalities
/api/provinces/072200000?include=cities,municipalities

/api/districts?include=cities,municipalities
/api/districts/133900000?include=cities
/api/districts/137600000?include=municipalities

/api/municipalities?include=barangays
/api/municipalities/012801000?include=barangays

/api/cities?include=barangays
/api/cities/099701000?include=barangays
/api/cities/133900000?include=subMunicipalities

/api/sub-municipalities?include=barangays
/api/sub-municipalities/133901000?include=barangays
```

## Parents

```
/api/provinces/072200000?parents=show
/api/districts/137600000?parents=show
/api/municipalities/012801000?parents=show
/api/cities/133900000?parents=show
/api/sub-municipalities/133901000?parents=show
/api/barangays/012802001?parents=show
```

## Summary

```
/api/summary
/api/regions?summary=show
```
