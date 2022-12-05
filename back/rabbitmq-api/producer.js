const amqp = require('amqplib/callback_api');
let i = 0;
const fs = require('fs')
//tableau ou on stockera les données qui seront envoyés au consommateur 
//let infos = [] 


//Récuperation des données du front (displayOrders()) 
//et envoie au consommateur sous format json

/*
fetch('http://localhost:3000/').
.then(res => res.json())
.then(res.push(infos) )
*/

amqp.connect('amqp://localhost',(err,connection) => {
    if(err){
        throw err;
    }

    connection.createChannel((err,channel) => {
        if(err){
            throw err;
        }

        let queue = 'channel_one';
        //envoie des informations sous format json 
        let msg = infos;

        channel.assertQueue(queue,{
            durable : false
        });

        channel.sendToQueue(queue,Buffer.from(msg));
        console.log('Le producteur à envoyé %s',msg) ;

    })
})