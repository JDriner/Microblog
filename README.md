## Driner - Microblog Project
*Executables*		
- `docker-compose build`
- `docker-compose up -d` / `docker-compose up`
- `docker-compose exec web composer install`

**Might be necessary to:**
- `sudo chown -R <user_name>:<user_name> .`
- `docker-compose run web chown -R www-data:www-data ./storage`
- > :coffee:
