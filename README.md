# Smart City Web (api, landingpage & admin)

**Install requirement**

```
composer install
npm install
```

**Set Environment**

```
cp .env.example .env
nano .env
```

**Migration Database**

```
php artisan migrate
php artisan db:seed
```

**Runing in Local**

```
composer run dev

# open in browser localhost:8000

# default user 
'email' => 'admin@email.com',
'username' => 'admin',
'password' => 'rnPgxzQ3qJeyNWKMtSD5La',
```

**Swagger**

```
php artisan l5-swagger:generate
```

**Build vue to public**

```
npm run build
```

**Third party**

storage using minio.io (credential on env)
mail using resend.com (credential on env)
