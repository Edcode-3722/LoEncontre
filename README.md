### Crear app Laravel

```
composer create-project laravel/laravel devstagram
```

### Extensiones necesarias

```
extension=curl
extension=fileinfo
extension=gd
extension=mbstring
extension=mysqli
extension=openssl
extension=pdo_mysql
```

### Descargar dependencias (vendor)

```
composer install
```

### Arrancar servidor

```
php artisan serve
```

### Arrancar Vite

Asset Bundling de Laravel, es necesario ejecutarlo para que construya nuestro front

```
npm run dev
```

### Aplicar migraciones

```
php artisan migrate
```

#### Rollback

```
php artisan migrate:rollback
```

#### Crear link a storage
```
php artisan storage:link
```
#### Para hacer uso de los factory

```
php artisan tinker
```

##### Crear la factoria para insertar registros en Base de Datos

```
App\Models\Post::factory()->times(50)->create();
```

##### Creación de Policy

`Permite al usuario, ver, actualizar, modificar un registro de DB.`
_--model=Post Asocia el policy al modelo Post_

```
php artisan make:policy PostPolicy --model=Post
```

#### Mostrar las rutas del proyecto

```
php artisan route:list
```

#### Limpiar cache de las rutas del proyecto

```
php artisan route:cache
```

#### Crear un componente

-   Se utilizan para reutilizar componentes HTML.

```
php artisan make:component ListarPost
```

#### Crear un seeder
```
php artisan make:seeder CategoriasSeeder
```

#### Aplicando seeder
```
php artisan db:seed
```
>>>>>>> 73ff2b6 (Proyecto completo)
