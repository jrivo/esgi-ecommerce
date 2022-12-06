var EntiySchema = require("typeorm");

module.exports = new EntiySchema({
    name: "Pdf",
    columns : {
        id : {
            primary: true,
            type: "int",
            generated: true,
        }

        filename : {
            type : "varchar"
        }
    }
})