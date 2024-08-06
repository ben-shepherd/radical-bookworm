# Build docker
docker compose up --build -d

# SSH into api
docker exec -it radical-bookworm-backend-1 /bin/bash

## Run commands
cp .env.example .env
php artisan db:wipe
php artisan migrate
php artisan db:seed