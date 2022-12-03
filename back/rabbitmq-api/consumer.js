const amqp = require('amqplib/callback_api');
let i = 0;
const fs = require('fs')



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

        console.log(" Waiting for messages in %s . To exit press CTRL+C",queue);
        //reception des informations 
        channel.consume(queue,(msg) => {
            //ecriture du PDF 
            fs.writeFile('biling.pdf',content,err => {
                if(err) {
                    console.error(err);
                    return
                }
                /*
                else  = écriture du PDF 
                */
            })
        }, {
            noAck : true
        })

    })
})