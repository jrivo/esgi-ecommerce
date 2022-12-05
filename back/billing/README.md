# Billing

## Installation

```bash
Javascript :
npm install amqplib
```

## Usage

### RabbitMQ

Pour ouvrir l'interface de rabbitmq , une fois le docker démarré , aller sur :

```
http://localhost:15672/
username : guest
password : guest
```

### Minio

Minio est une alternative gratuite à Amazon S3 afin de créer des bucket S3 gratuits

## Use case

-   Un producteur (producer.js) envoie le message à partir des données fourni par le microservices de paiement

```bash
node producer.js
```

-   Un consomamteur (app.js) consomme les messages , recupère les informations , génère un PDF ,l'enregistre dans un bucket S3 et le rend disponible au télechargement

```bash
node app.js
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
