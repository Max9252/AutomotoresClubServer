var multer = require('multer'); // v1.0.5
var runner = require("child_process");

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
    /*var argsString = '"'+req.body.placa+','+req.body.vigencia+','+req.body.servicio+','+req.body.linea+','
        +req.body.barrio+','+req.body.convenio+','+req.body.modelo+','+req.body.user+','+req.body.aseguradora+','
        +req.body.color+'"';*/
        var argsString = '"'+req.body.imagen+'"';
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

expors.getClaseVehiculo = function(req, res) {
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
