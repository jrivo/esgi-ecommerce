# RabbitMQ

## Installation

```bash
Javascript :
npm install amqplib
```

## Usage

Pour ouvrir l'interface de rabbitmq , une fois le docker démarré , aller sur :

```
http://localhost:15672/
username : guest
password : guest
```

### Use case

-   Un producteur

Pour le démarrer :

```bash
node producer.js
```

-   Un consomamteur

Pour le démarrer :

```bash
node consumer.js
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License

[MIT](https://choosealicense.com/licenses/mit/)
