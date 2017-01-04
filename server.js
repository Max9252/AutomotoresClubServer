var cors = require('cors');
var express = require('express');
var bodyParser = require('body-parser');
var app = express();
var multer = require('multer'); // v1.0.5
var upload = multer(); // for parsing multipart/form-data
var puerto = 80;

app.all('*', cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

var api = require('./controllers/api.js');

app.get('/',cors(),function(req,res){
    return res.send("Hola mundo with Ec2");
});

app.get('/test', cors(), api.test);

app.get('/validatePlaca/:placa', cors(), api.validatePlaca);

app.get('/getPromociones/:codClase/:codEst', api.getPromociones);

app.get('/getProveedores/:codClase/:codEst', api.getProveedores);

app.get('/getDatosProv/:idProv', api.getDatosProv);

app.get('/getVehiculos/:id', api.getVehiculos);

app.get('/getClaseVehiculo', api.getClaseVehiculo);

app.get('/getMarca/:clase', api.getMarca);

app.get('/getLinea/:marca', api.getLinea);

app.get('/getColor', api.getColor);

app.get('/getServicio', api.getServicio);

app.get('/getConvenio', api.getConvenio);

app.get('/getAseguradora', api.getAseguradora);

app.get('/getDepartamento', api.getDepartamento);

app.get('/getCiudad/:departamento', api.getCiudad);

app.get('/getBarrio/:ciudad', api.getBarrio);

app.get('/getComuna/:barrio', api.getComuna);

app.post('/login',cors(),upload.array(), api.login);

app.post('/reg',cors(),upload.array(), api.reg);

app.post('/regAutomotor', cors(), upload.array(), api.regAutomotor);

app.post('/regAutomotorWithImage', cors(), upload.array(), api.regAutomotorWithImage);

app.post('/getUserId', cors(), upload.array(), api.getUserId);

app.post('/testImagen', cors(), upload.array(), api.uploadPhoto);

app.post('/updateColor', cors(), upload.array(), api.updateColor);

app.post('/updateLocation', cors(), upload.array(), api.updateLocation);

app.listen(puerto, function () {
  console.log("Servidor corriendo por el puerto " + puerto);
});
