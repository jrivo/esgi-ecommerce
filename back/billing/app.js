const amqp = require('amqplib/callback_api');
const PDFDocument = require('pdfkit');
const fs = require('fs');
import Payment from './producer'

connection.createChannel((err,channel) => {
    if(err){
        throw err;
    }

    let queue = 'channel_one';
    //envoie des informations sous format json 
    //let msg = infos;

    channel.assertQueue(queue,{
        durable : false
    });

    channel.consume('channel_one', async(msg) => {
        // recuperer info de paiement 
        eventPayment = JSON.parse(msg.content.toString());
        payment = new Payment();
        payment.id = parseInt(eventPayment.id);
        payment.date = eventPayment.date;
        payment.price = parseInt(eventPayment.price);
        payment.isDone = eventPayment.isDone;
        //console.log(payment)

        // generation du PDF 

        const doc = new PDFDocument();
        const line_one = "Date de l'achat : " + payment.date + "\n";
        const line_two = "Prix : " + payment.price + "\n";
        doc.
        text('Facture numéro'+ payment.id, 100, 100);
        text(line_one)
        text(line_two)       
        doc.end()


        // enregistre PDF ( regardez S3 gratuit) 
        //Solution : Minio 
        //Creation d'un bucket S3 gratuit 
    } )
})

connection.close()

function downloadpPdf () {
    // creer le get qui va permettre de telecharger le PDF 
}