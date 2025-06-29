# Laravel Проект

Это приложение Laravel, созданное с использованием Laravel 12.0 и PHP 8.2. Проект использует Laravel Sail для контейнеризации Docker, PostgreSQL для базы данных и Redis для кэширования.

## Требования

- [Docker](https://www.docker.com/products/docker-desktop)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Composer](https://getcomposer.org/download/) (для локальной разработки)

## Настройка проекта

### Шаг 1: Клонирование репозитория

```bash
git clone <url-репозитория>
cd m-test
```

### Шаг 2: Настройка окружения

Скопируйте пример файла окружения:

```bash
cp .env.example .env
```

Обновите файл `.env` своими учетными данными для базы данных и другими настройками конфигурации.

### Шаг 3: Установка зависимостей

Используя Composer:

```bash
composer install
```

### Шаг 4: Запуск Docker-контейнеров

Используя Laravel Sail:

```bash
./vendor/bin/sail up -d
```

Если у вас нет доступа к команде sail, вы можете использовать:

```bash
docker-compose up -d
```

### Шаг 5: Генерация ключа приложения

```bash
./vendor/bin/sail artisan key:generate
```

### Шаг 6: Запуск миграций

```bash
./vendor/bin/sail artisan migrate
```

## Запуск приложения

### Запуск приложения

```bash
./vendor/bin/sail up -d
```

Приложение будет доступно по адресу: http://localhost

### Остановка приложения

```bash
./vendor/bin/sail down
```

## Управление базой данных

Проект использует PostgreSQL 17. Конфигурация базы данных определена в файле `.env`:

```
DB_CONNECTION=pgsql
DB_HOST=pgsql
DB_PORT=5432
DB_DATABASE=имя_вашей_базы_данных
DB_USERNAME=ваше_имя_пользователя
DB_PASSWORD=ваш_пароль
```

## Дополнительные команды

### Запуск тестов

```bash
./vendor/bin/sail test
```

### Доступ к оболочке контейнера

```bash
./vendor/bin/sail shell
```

### Запуск команд Artisan

```bash
./vendor/bin/sail artisan <команда>
```

## Устранение неполадок

Если у вас возникли проблемы с правами доступа:

```bash
chmod -R 777 storage bootstrap/cache
```

Если вам нужно перестроить контейнеры:

```bash
./vendor/bin/sail build --no-cache
```

## Лицензия

Этот проект лицензирован под лицензией MIT - подробности см. в файле LICENSE.
