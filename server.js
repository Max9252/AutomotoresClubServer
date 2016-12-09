var cors = require('cors');
var express = require('express');
var bodyParser = require('body-parser');
var app = express();
var multer = require('multer'); // v1.0.5
var upload = multer(); // for parsing multipart/form-data
var puerto = 80;
var runner = require("child_process");


app.all('*', cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

app.post('/login',cors(),upload.array(),function(req,res){
    var phpScriptPath = "getDatosUsuario.php";
    var argsString = '"'+req.body.user+','+req.body.pass+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResp){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, message:phpResp.message});
            }else{
                res.json({success:false, message:phpResp.message});
            } 
        }
    });
});

app.get('/test', function(req, res) {
    var phpScriptPath = "config/test.php";
    runner.exec("php " + phpScriptPath, function(err, phpResponse, stderr) {
    if(err) {
        res.json({success:false,reason:err});
    } else if(phpResponse){
        res.json({success:true,auth:phpResponse});
    } else{
        res.json({success:false,auth:phpResponse});
    }
    });
});

app.get('/',cors(),function(req,res){
    return res.send("Hola mundo with Ec2");
});

app.post('/reg',cors(),upload.array(),function(req,res){
    var phpScriptPath = "registrousuario.php";
    var argsString = '"'+req.body.user+','+req.body.pass+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResp){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, message:phpResp.message});
            }else{
                res.json({success:false, message:phpResp.message});
            } 
        }
    });
});


app.listen(puerto, function () {
  console.log("Servidor corriendo por el puerto " + puerto);
});
