# Описание REST API

Базовый адрес: `/api`. Формат данных — JSON. Все запросы, кроме входа, требуют заголовок
`Authorization: Bearer <token>`.

| Метод | Путь | Роль | Назначение | Ответ |
|---|---|---|---|---|
| POST | `/auth/login` | все | Вход по email и паролю | `200` + токен, `401` |
| GET | `/zones` | сотрудник | Список офисных зон | `200` |
| GET | `/workplaces?zone_id=&date=&equipment=` | сотрудник | Места с фильтром по зоне, дате, оборудованию | `200` |
| GET | `/workplaces/{id}/availability?date=` | сотрудник | Занятые интервалы места на дату | `200` |
| GET | `/bookings/my` | сотрудник | Мои бронирования | `200` |
| POST | `/bookings` | сотрудник | Создать бронирование | `201`, `409` (занято), `422` |
| DELETE | `/bookings/{id}` | сотрудник | Отменить свою бронь | `204`, `403` |
| POST | `/admin/workplaces` | офис-менеджер | Добавить рабочее место | `201` |
| PUT | `/admin/workplaces/{id}` | офис-менеджер | Изменить место / оборудование / отключить | `200` |
| GET | `/admin/bookings?date=` | офис-менеджер | Все бронирования на дату | `200` |

## Пример: создание бронирования

Запрос:

```http
POST /api/bookings
Authorization: Bearer eyJhbGciOi...
Content-Type: application/json

{ "workplace_id": 12, "start_at": "2026-10-01 09:00", "end_at": "2026-10-01 18:00" }
```

Успех — `201 Created`:

```json
{ "id": 345, "workplace_id": 12, "start_at": "2026-10-01 09:00", "end_at": "2026-10-01 18:00", "status": "active" }
```

Место занято — `409 Conflict`:

```json
{ "error": "Место уже занято на это время", "alternatives": [13, 15, 21] }
```
