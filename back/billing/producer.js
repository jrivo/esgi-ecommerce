const amqp = require('amqplib/callback_api');
const fs = require('fs')



//créer un objet ici pour envoyer les infos au consommateur 
export default function Payment (id , date , price , isDone) {
    this.id = id ;
    this.date = date ;
    this price = price ;
    this isDone= isDone
}

const mypayment = new Payment(1,'1-01-22', 30, 'yes')


amqp.connect('amqp://localhost',(err,connection) => {
    if(err){
        throw err;
    }

    connection.createChannel((err,channel) => {
        if(err){
            throw err;
        }

        let queue = 'channel_one';    

        channel.assertQueue(queue,{
            durable : false
        });



        channel.sendToQueue(queue,Buffer.from(JSON.stringify(msg)));
        console.log('Le producteur à envoyé %s',msg) ;

    })
})