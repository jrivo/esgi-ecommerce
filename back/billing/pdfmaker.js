const PDFDocument = require('pdfkit');
const fs = require('fs');




function Payment (id , date , price , isDone) {
    this.id = id ;
    this.date = date ;
    this.price = price ;
    this.isDone= isDone
}  
    
const mypayment = new Payment(1,'1-01-22', 30, 'yes')


const doc = new PDFDocument();
const line_one = "Date de l'achat : " + mypayment.date + "\n";
const line_two = "Prix : " + mypayment.price + "\n";

doc.text('Facture numéro ' + mypayment.id, 100, 100);
doc.text(line_one)
doc.text(line_two)       
doc.end()

const myPdf = 'paymentnumber'+ mypayment.id
doc.pipe(fs.createWriteStream(myPdf+'.pdf'))
let pdf = (myPdf).pdf ; 






