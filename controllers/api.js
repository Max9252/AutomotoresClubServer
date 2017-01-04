var runner = require("child_process");

var AWS = require('aws-sdk');

var accessKeyId =  process.env.AWS_ACCESS_KEY || "AKIAJDYNJSPSOZO4T4SQ";
var secretAccessKey = process.env.AWS_SECRET_KEY || "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";

AWS.config.update({
    accessKeyId: accessKeyId,
    secretAccessKey: secretAccessKey
});

var s3 = new AWS.S3();
var myBucket = 'ac-automotor';

exports.uploadPhoto = function(req,res){

  var buf = new Buffer(req.body.imagen.replace(/^data:image\/\w+;base64,/, ""),'base64');

  var params = {
      Bucket: myBucket,
      Key: req.body.placa+'_1.jpg',
      Body: buf,
      ContentEncoding: 'base64',
      ContentType: 'image/jpeg'
    };

    s3.putObject(params, function(err, data) {
         if (err) {
             res.json({success:false,error:err});
         } else {
             res.json({success:true,url:'https://s3-us-west-2.amazonaws.com/'+params.Bucket+'/'+params.Key});
         }
      });
}

exports.deletePhoto = function(req,res){
  var params = {
    Bucket: myBucket,
    Delete: {
      Objects: [
        {
          Key: req.body.placa+'_1.jpg'
        }
      ]
    }
  }
  s3.deleteObjects(params, function(err, data) {
    if (err) res.json({success:false,error:err}); // an error occurred
    else     res.json({success:true});           // successful response
  });
}

exports.getPromociones = function(req, res) {
    var phpScriptPath = "php/getPromociones.php";
    var argsString = '"'+req.params.codClase+','+req.params.codEst+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getProveedores = function(req, res) {
    var phpScriptPath = "php/getProveedores.php";
    var argsString = '"'+req.params.codClase+','+req.params.codEst+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getDatosProv = function(req, res) {
    var phpScriptPath = "php/getDatosProveedor.php";
    var argsString = '"'+req.params.idProv+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.login = function(req,res){
    var phpScriptPath = "php/getDatosUsuario.php";
    var argsString = '"'+req.body.user+','+req.body.pass+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, message:phpResp.message, data: phpResp.data});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getVehiculos = function(req, res) {
    var phpScriptPath = "php/getVehiculo.php";
    var argsString = '"'+req.params.id+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.reg = function(req,res){
    var phpScriptPath = "php/registrousuario.php";
    var argsString = '"'+req.body.user+','+req.body.pass+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, message:phpResp.message});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.regAutomotor = function(req, res) {
    var phpScriptPath = "php/registrarVehiculo.php";
    var argsString = '"'+req.body.placa+','+req.body.vigencia+','+req.body.servicio+','+req.body.linea+','
        +req.body.barrio+','+req.body.convenio+','+req.body.modelo+','+req.body.user+','+req.body.aseguradora+','
        +req.body.color+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, message:phpResp.message});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.regAutomotorWithImage = function(req, res) {
    var phpScriptPath = "php/registrarVehiculoconImagen.php";
    var argsString = '"'+req.body.placa+','+req.body.vigencia+','+req.body.servicio+','+req.body.linea+','
        +req.body.barrio+','+req.body.convenio+','+req.body.modelo+','+req.body.user+','+req.body.aseguradora+','
        +req.body.color+','+req.body.img+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, message:phpResp.message});
            }else{
                res.json({success:false, message:phpResp.message, data:phpResp});
            }
        }
    });
}

exports.getUserId = function(req, res) {
    var phpScriptPath = "php/getUserId.php";
    var argsString = '"'+req.body.user+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, message:phpResp.message, data:phpResp.data});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getClaseVehiculo = function(req, res) {
    var phpScriptPath = "php/getClaseVehiculo.php";
    runner.exec("php " + phpScriptPath, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getMarca = function(req, res) {
    var phpScriptPath = "php/getMarca.php";
    var argsString = '"'+req.params.clase+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getLinea = function(req, res) {
    var phpScriptPath = "php/getLinea.php";
    var argsString = '"'+req.params.marca+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getColor = function(req, res) {
    var phpScriptPath = "php/getColor.php";
    runner.exec("php " + phpScriptPath, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getServicio = function(req, res) {
    var phpScriptPath = "php/getTipoVehiculo.php";
    runner.exec("php " + phpScriptPath, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getConvenio = function(req, res) {
    var phpScriptPath = "php/getConvenio.php";
    runner.exec("php " + phpScriptPath, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getAseguradora = function(req, res) {
    var phpScriptPath = "php/getAseguradora.php";
    runner.exec("php " + phpScriptPath, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getDepartamento = function(req, res) {
    var phpScriptPath = "php/getDepartamento.php";
    runner.exec("php " + phpScriptPath, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getCiudad = function(req, res) {
    var phpScriptPath = "php/getCiudad.php";
    var argsString = '"'+req.params.departamento+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getBarrio = function(req, res) {
    var phpScriptPath = "php/getBarrio.php";
    var argsString = '"'+req.params.ciudad+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.getComuna = function(req, res) {
    var phpScriptPath = "php/getComuna.php";
    var argsString = '"'+req.params.barrio+'"';
    runner.exec("php " + phpScriptPath + " " + argsString, function(err, phpResponse, stderr) {
        if(err){
            res.json({success:false,reason:err});
        } else if(phpResponse){
            var phpResp = JSON.parse(phpResponse);
            if(phpResp.status){
                res.json({success:true, data:phpResp.datos});
            }else{
                res.json({success:false, message:phpResp.message});
            }
        }
    });
}

exports.test = function(req, res) {
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
}
