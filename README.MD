# KvartirkinBot (Parser)

Этот бот позволяет следить за квартирами на сайте thelocals.ru и отправлять изменения о них всем
заинтересованным лицам прямо в телеграм-контакт бота.  
Все запросы используют мобильное api сайта thelocals.ru  

Приложение разделено на две части:  
парсер и слушатель. Парсер это однопроходный скрипт который вызывается по расписанию раз в какое-то
время, или же единоразово пользователем. Бот ведёт базу квартир, и при обнаружении изменений,
информирует о них всех подписанных пользователей.

# Полезная информация

## Список известных точек входа на сайт locals:

| URL: /api/frontend/...                | METHOD | DESCRIPTION                                        |
| ----------------------                | :----: | :------------------------------------------------: |
| `/profile`                            | GET    | JSON with profile                                  |
| `/subways/select2`                    | GET    | Count number of flats by underground stations      |
| `/rooms`                              | GET    | ALL flats get                                      |
| `/rooms/map`                          | GET    | Map coordinates of flats                           |
| `/rooms/126514`                       | GET    | Info about flat                                    |
| `/rooms/126514/contacts`              | GET    | Subscription (get contacts)                        |
| `/main_filter/result_url?city_id=1`   | GET    | ?????????????????????????????????????????????      |
| `/subways/select2?city_id=1`          | GET    | ?????????????????????????????????????????????      |

| URL: /api/v1/...                      | METHOD | DESCRIPTION                                        |
| ----------------------                | :----: | :------------------------------------------------: |
| `/subways`                            | GET    | Underground dictionary                             |



https://geocode-maps.yandex.ru/1.x/?geocode=37.59374,55.81156 - get name of the street, building, etc

filter example: 'filter[kind]=apartment&filter[rooms][]=1&filter[rooms][]=2&filter[rooms][]=3&filter[price_max]=50000'

https://thelocals.ru/treshka-na-dinamo
https://thelocals.ru/treshka-na-dinamo-d6d52b02-0a6d-48d5-8301-ab46003f1581 // IF were already

https://thelocals.ru/horoshiy-dom-s-krasivym-divanom-i-kuhney // Way to get data, unfortunately

getFavoriteUrl: function() {
    return "/api/frontend/rooms/" + this.props.ad.id + "/favorite"
},
getUnfavoriteUrl: function() {
    return "/api/frontend/rooms/" + this.props.ad.id + "/unfavorite"
},

print(flats_pages[i-1]['ads'])

[thelocals]
url_api = https://thelocals.ru/api
pattern = ?filter[kind]=apartment&filter[rooms][]=1&filter[rooms][]=2&filter[rooms][]=3&filter[price_max]=50000&page=%%d
https://thelocals.ru/api/frontend/rooms?filter[kind]=apartment&filter[rooms][]=1&filter[rooms][]=2&filter[rooms][]=3&filter[price_max]=50000&page=1

25 flats per request json
