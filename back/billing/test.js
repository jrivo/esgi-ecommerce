//Fichier crée pour tester la génération de PDF 
//Indépendamment de RabbitMQ

const PDFDocument = require('pdfkit');
const fs = require('fs');

/*
function ProductOrder (customer , total_price) {
    this.id = id;
    this total_price = total_price;
}
*/
function Product (id, name, price, colors[] , sizes[] , description, images[]) {
    this.id = id ;
    this.name = date ;
    this.price = price ;
    this.colors = colors ;
    this.sizes = sizes ;
    this.description = description ;
    this.images = images ;
}

const doc = new PDFDocument();
doc.fontSize(18);
doc.font('Times-Roman');

const productOne = Product(1,'T-shirt Rouge',25)

const title = 'Facture : Produit numéro ' + product.id
const line_one = "Nom : " + product.name + "\n";
const line_two = "Prix du produit : " + product.price + "euros\n"
const line_three = "Couleur : " + product.colors + "\n"
const line_four = "Acheteur : " + product.sizes + "\n";
const line_five = "Date de l'achat : " + product.description + "\n"
const line_six = "Images : " + product.images + "\n"

doc.moveDown();
doc.text(title);
doc.text(line_one);
doc.text(line_two)
doc.text(line_three)
doc.text(line_four);
doc.text(line_five)
doc.text(line_six)

doc.end()

const myPdf = 'Productnumber'+ productOrder.id
doc.pipe(fs.createWriteStream(myPdf+'.pdf'))
let finalPdf = (myPdf).pdf 