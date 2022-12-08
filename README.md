# Project

- Launch project

```
sudo docker compose up -d
```

- API-Platform : http://localhost/ (http://localhost/docs for the documentation)

- Product service : http://localhost/product-service

- Billing service : http://localhost:15672

- Payment service : ???

## API-Platform

- Commandes

```
sudo docker compose exec php composer install
sudo docker compose exec php bin/console d:f:l
```