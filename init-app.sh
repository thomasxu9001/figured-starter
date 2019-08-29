#!/usr/bin/env bash

cp .env.example .env
docker exec -it mongodb mongo admin --eval "db.createUser({ user: 'user', pwd: 'pass', roles: [ { role: 'userAdminAnyDatabase', db: 'admin' } ] });"
