This is a Symfony 4.2 project with the Sonata Admin bundle, user bundle.

It has the security using ROLES, so you can create users, let them modify the entities you prefeer and so on.
It also has the fos oauth bundle: https://github.com/FriendsOfSymfony/FOSOAuthServerBundle

As always, steps:

1 - Clone project:
```
git clone git@github.com:simonberton/symfony4sonata.git
```
2 - Go to folder and run:
```
composer install
```

3 - Create and Update your database schema.
```
php bin/console doctrine:database:create

php bin/console d:s:u --f
```

For the fos oauth to make a client run the following command that will create a client:
```
php bin/console oauth-server:client:create 'http://www.yourlocalurl.local'
```
Then check it on your browser with the returned client_id and secret like so:
http://www.yourlocalurl.local:8086/oauth/v2/token?client_id=1_5hdp7ouc5d0kk4ckg8sk4o4wwoo4k8csowo8wc0go4wwgscccs&client_secret=36con31ekbok0o0804ogs04kw80o8gcc480wosos48004o8844&grant_type=client_credentials

4 - Enjoy.

Hint: If you want you can use this docker locally:
https://github.com/simonberton/dockerphp7.2apachemysql