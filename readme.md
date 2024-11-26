## @blumilksoftware/interns2024c
### About application
> Interns2024c application.

### Local development
```
cp .env.example .env
make init
make dev
```
Application will be running under [localhost:43851](localhost:43851) and [http://interns2024c.blumilk.localhost/](http://interns2024c.blumilk.localhost/) in Blumilk traefik environment. If you don't have a Blumilk traefik environment set up yet, follow the instructions from this [repository](https://github.com/blumilksoftware/environment).

#### Commands
Before running any of the commands below, you must run shell:
```
make shell
```

| Command                 | Task                                        |
|:------------------------|:--------------------------------------------|
| `composer <command>`    | Composer                                    |
| `composer test`         | Runs backend tests                          |
| `composer analyse`      | Runs Larastan analyse for backend files     |
| `composer cs`           | Lints backend files                         |
| `composer csf`          | Lints and fixes backend files               |
| `php artisan <command>` | Artisan commands                            |
| `npm run dev`           | Compiles and hot-reloads for development    |
| `npm run build`         | Compiles and minifies for production        |
| `npm run lint`          | Lints frontend files                        |
| `npm run lintf`         | Lints and fixes frontend files              |
| `npm run tsc`           | Runs TypeScript checker                     |


#### Containers

| service    | container name             | default host port               |
|:-----------|:---------------------------|:--------------------------------|
| `app`      | `interns2024c-app-dev`     | [43851](http://localhost:43851) |
| `database` | `interns2024c-db-dev`      | 43853                           |
| `redis`    | `interns2024c-redis-dev`   | 43852                           |
| `mailpit`  | `interns2024c-mailpit-dev` | 43854                           |
