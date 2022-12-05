const amqp = require('amqplib/callback_api');
let i = 0;
const fs = require('fs')

connection.createChannel((err,channel) => {
    if(err){
        throw err;
    }

    let queue = 'channel_one';
    //envoie des informations sous format json 
    /                          /let msg = infos;

    channel.assertQueue(queue,{
        durable : false
    });

    channel.consume('channel_one', async(msg) => {
        // recuperer info de paiement 
        // generer le PDF 
        // enregistre PDF ( regardez S3 gratuit) 
    } )
})

connection.close()

function downloadpPdf () {
    // creer le get qui va permettre de telecharger le PDF 
}