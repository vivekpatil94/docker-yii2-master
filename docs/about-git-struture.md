# Структура наследования репозиториев

Данный проект имеет определённу цепочку предков и подмодулей, обновление исходного кода которых может повлечь 
за собой улучшение кода и актуализацию его относительно исходного. Также данная схема признана помочь при ломании вендорами
обратной совместимости (обновлённый код, скорее всего, будет работать с обновлёнными зависимостями)


## Подмодули и пути

```
docker-yii2-app-advanced-rbac
url = https://github.com/bscheshirwork/docker-yii2-app-advanced-rbac.git
|
|---- docker-codeception-yii2
|     path = docker-codeception-run/docker-codeception-yii2/build
|     url = https://github.com/bscheshirwork/docker-codeception-yii2.git
|
|---- docker-php
|     path = docker-run/docker-php
|     url = https://github.com/bscheshirwork/docker-php.git
|
|---- yii2-app-advanced-redis
      path = php-data
      url = https://github.com/bscheshirwork/yii2-app-advanced-rbac.git
```


## Предки

Соответствущие цепочки для окружения приложения `docker` и подмодуля с кодом приложения `php-data`

```
docker-yii2-app-advanced-redis
url = https://github.com/bscheshirwork/docker-yii2-app-advanced-redis.git
⇑
docker-yii2-app-advanced-rbac
url = https://github.com/bscheshirwork/docker-yii2-app-advanced-rbac.git
⇑
docker-yii2-app-advanced
url = https://github.com/bscheshirwork/docker-yii2-app-advanced.git
```

```
yii2-app-advanced-redis
url = https://github.com/vivekpatil94/docker-yii2-master.git
⇑
yii2-app-advanced-rbac
url = https://github.com/bscheshirwork/yii2-app-advanced-rbac.git
⇑
yii2-app-advanced
url = https://github.com/yiisoft/yii2-app-advanced.git
```

### Обновление

Важно помнить, что без соответствующего опубликованого коммита в подмодуле `php-data` репозиторий `docker-...`
будет ссылатся на несуществующие данные.  
С другой стороны при публикации подмодуля `php-data` без публикации `docker-...` с соответствующим коммитом 
при клонировании репозитория с подмодулями даст устаревшие данные
Конечно, раздельный `git pull` даёт актуальную информацию, но указывать будет не на конечный коммит.

Таким образом, необходимо актуализировать оба репозитория, см.псевдокод. 
`php-data`: `git commit; git push bitbucket`, `docker`: `git add php-data; git commit; git push bitbucket`

Раздельный `git pull` даёт актуальную информацию
`php-data`: `git pull origin`, `docker`: `git pull origin`

## Актуализация

Добавив репозитории предков под псевдонимом `parent` либо обращаясь напрямую по адресу, можно сделать `pull` изначального кода.
Доступно как по цепочке (если есть доступ), так и последовательно, над каждым предком, из верхнеуровнего.

Например, после обновления версии продукта окружения

```sh
cd ./docker-run/docker-php
git pull origin master
cd ../..
cd ./docker-codeception-run/docker-codeception-yii2
git pull origin master
cd ../..
cd ./php-data
git pull parent master
cd ..
sed -i -e 's/\(php:\?\)7.2.5/\17.2.8/;s/nginx:1.13.11/nginx:1.13.12/' ./docker-compose.yml ./docker-run/docker-compose.yml ./docker-codeception-run/docker-compose.yml
git status
```

После завершения слияния коммит и во внешний репозиторий.

И для последующих
```sh
cd ./docker-run/docker-php
git pull origin master
cd ../..
cd ./docker-codeception-run/docker-codeception-yii2
git pull origin master
cd ../..
cd ./php-data
git pull parent master
cd ..
git pull parent master
git status
```

и т.п.

Для всей цепочки можно запустить обновление общих подмодулей в цикле:
```sh
for i in "/home/dev/projects/docker-yii2-app-advanced" "/home/dev/projects/docker-yii2-app-advanced-rbac" "/home/dev/projects/docker-yii2-app-advanced-redis"; do for j in "docker-codeception-run/docker-codeception-yii2" "docker-run/docker-php"; do cd $i/$j; git pull; done; done
```

# Внешние репозитории
Для удобства используются псевдонимы `parent`, добавленные для соответствующих репозиториев (`url` см. выше)
```sh
git remote add parent parentUrlHere
```

с отключённой возможностью изменить предка
```sh
git remote set-url --push parent DISSALOWED
```
