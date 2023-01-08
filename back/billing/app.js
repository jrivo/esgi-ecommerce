import * as amqp from 'amqplib/callback_api.js';
import PDFDocument from 'pdfkit'
import pdf from 'pdfkit'
import fs from 'fs'
import express from 'express'
import cors from 'cors'
import axios from 'axios';

//Les objets crées ici servent à tester la génération de PDF
//Indépendamment des autres microservices
//Disponible dans le fichier 'test.js'

/*
function ProductOrder (customer , total_price) {
    this.id = id;
    this total_price = total_price;
}

function Product (id, name, price, colors[] , sizes[] , description, images[]) {
    this.id = id ;
    this.name = date ;
    this.price = price ;
    this.colors = colors ;
    this.sizes = sizes ;
    this.description = description ;
    this.images = images ;
}
*/

amqp.connect('amqp://localhost:5672',(err,connection) => {
    if(err){
        throw err;
    }

    connection.createChannel((err,channel) => {
        if(err){
            throw err;
        }

        channel.assertQueue('productOrder',{durable : false});        
        channel.assertQueue('product',{durable : false}); 
        
        //enregistrement des infos dans la queue nécessaire pour la génération de la facture

        channel.consume('product', async (msg) => {

            const productOrder = new ProductOrder()
            const eventProductOrder = new ProductOrder()
            eventProductOrder = JSON.parse(msg.content.toString())

            productOrder.id = parseInt(eventProductOrder.id)
            productOrder.totalPrice = parseInt(eventProductOrder.totalPrice)
            console.log('information sur la facture enregistrés')

            const product = new Product()
            eventProduct = JSON.parse(msg.content.toString())

        
            product.id = parseInt(eventProduct.id)
            product.name = eventProduct.name
            product.price = parseInt(eventProduct.price)
            product.colors = eventProduct.colors
            product.description = eventProduct.description
            product.images = eventProduct.images

            //génération du PDF 

            const doc = new PDFDocument();
            doc.fontSize(18);
            doc.font('Times-Roman');

            const title = 'Facture : Produit numéro ' + productOrder.id
            const line_one = "Nom : " + product.name + "\n";
            const line_one_bis = 'Produit numéro ' + product.id
            const line_two = "Prix du produit : " + product.price + "euro(s)\n"
            const line_three = "Couleur : " + product.colors + "\n"
            const line_four = "Acheteur : " + product.sizes + "\n";
            const line_five = "Date de l'achat : " + product.description + "\n"
            const line_six = "Images : " + product.images + "\n"
            const line_seven = "Prix : " + productOrder.totalPrice + "euro(s)\n"

            doc.moveDown();
            doc.text(title);
            doc.text(line_one_bis);
            doc.text(line_one);
            doc.text(line_two)
            doc.text(line_three)
            doc.text(line_four);
            doc.text(line_five)
            doc.text(line_six)
            doc.text(line_seven)

            doc.end()

            const myPdf = 'Productnumber'+ product.id
            doc.pipe(fs.createWriteStream(myPdf+'.pdf'))
            let finalPdf = (myPdf).pdf 


            console.log('information sur le produit enregistrés')
        }, { noAck: true } )

        


        // mise en disponibilité du pdf
        const app = express()
        app.use(cors())
        app.use(express.json())

        console.log('Listening to port: 8001')
        app.listen(8001)

        const pdfPath = './biling/finalPdf'

        axios('htttp:localhost:8001/upload', {
            method: 'POST',
            body: fs.createReadStream(pdfPath),
            headers: {
                'Content-Type': 'application/pdf'
            }
        })
        .then(res => res.json())
        .then(json => console.log(json))
        .catch(error => console.error(error));

    })

    connection.close()

})

