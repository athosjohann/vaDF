//Declaracao de variaveis globais
var retornoRequestPOST;
var retornoRequestGET;
var retornoMsgInfo;

function loading(ativo){
    if(ativo){
       document.getElementById("loading").innerHTML = '<div style=" width: 6em; height:3em;position: absolute;  left: 50%;  top: 50%;  transform: translate(-50%, -50%);" class="card-body collapse show" id="collapse3">' +
           '<div class="pd-y-50">' +
               '<div class="sk-wave">' +
                   ' <div class="sk-rect sk-rect1"></div>' +
                   ' <div class="sk-rect sk-rect2"></div>' +
                   ' <div class="sk-rect sk-rect3"></div>' +
                   ' <div class="sk-rect sk-rect4"></div>' +
                   ' <div class="sk-rect sk-rect5"></div>' +
               '</div>' +
          '</div>' +
       '</div>';
       document.getElementById("loading").style.display = "initial";
    } else {
       document.getElementById("loading").innerHTML = '';
       document.getElementById("loading").style.display = "none";
    }
}
function FormPOST(url,form){
    let json = FormToJSON(form);
    POST(url,json);

}

function FormPOSTPesquisar(url, form, div){
    let json = FormToJSON(form);
    loading(true);
    POST(url,json);
    let intervalo = setInterval(() => {
        if(retornoRequestPOST != null){
            SubstituirConteudoDIV(retornoRequestPOST, div);
            recarregarDIV();
            EsconderDIV(div, true);
            loading(false);
            clearInterval(intervalo);
            retornoRequestPOST = null;
        }
    }, 50);    
}


function FormPOSTMensagemRetorno(url,form, redirecionamento = ''){
    let json = FormToJSON(form);
    loading(true);
    POST(url,json);
    let intervalo = setInterval(() => {
        if(retornoRequestPOST != null){
            loading(false);
            if(retornoRequestPOST['sucesso']){
                if(retornoRequestPOST['mensagem'] != null){
                    MensagemSucesso(retornoRequestPOST['mensagem'].toString(), redirecionamento);
                } else {
                    MensagemSucesso('Operação realizada com sucesso!', redirecionamento);
                }
                
            } else {
                if(retornoRequestPOST['mensagem'] != null){
                    MensagemErro(retornoRequestPOST['mensagem'].toString());
                } else {
                    MensagemErro('Não foi possivel realizar a operação!');
                }
                
            }
            clearInterval(intervalo); 
            retornoRequestPOST = null;
        }
    }, 50);

}

function WinthorAPIPost(vURL, vToken, vPostDATA){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", vURL.toString(), true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('Authorization', 'Bearer ' + vToken);
    xhr.send(JSON.stringify(vPostDATA));
    xhr.timeout = 15000;
    xhr.onload = function() {
        console.log("POST")
        console.log(this.responseText);
        var data = JSON.parse(this.responseText);
        console.log(data);
    }

}

function WinthorAPIGET(vURL, vToken){
    let request = new XMLHttpRequest();
    request.open('GET', vURL.toString(), true);
    request.setRequestHeader("Content-Type", "application/json");    
    request.setRequestHeader('Authorization', 'Bearer ' + vToken);
    request.timeout = 15000;
    request.addEventListener("error", ErrorHandler);
    request.send();
    //Trata erros
    function ErrorHandler(erro){
        return null;  
    }

    request.onload = function(){
        //Verifica status code da request
        if(request.status === 200){            
            var data = JSON.parse(request.responseText);
            return data;
        } else {
            return null;  
        }
    }
    
    request.ontimeout = function (event) {        
        return null;  
    }
}


function POST(url,json, winthorapi = false){
    let request = new XMLHttpRequest();
    request.open('POST', url.toString(), true);
    request.setRequestHeader("Content-Type", "application/json");
    request.setRequestHeader("Authorization", "Bearer MTUwODIwMTk6UFJPRDoxNzQ1NzQwNDAwMTM0NQ==");
    request.timeout = 15000;
    request.addEventListener("error", ErrorHandler);
    request.send(json);
    //Trata erros
    function ErrorHandler(erro){
        retornoRequestPOST = {sucesso : false, mensagem : 'Erro desconhecido'};
    };

    request.onload = function(){
        //Verifica status code da request
        if(request.status === 200){
            let retornoVerificacao
            try{
                retornoVerificacao = JSON.parse(request.responseText);
            } catch(e) {
                retornoVerificacao = false;    
            }
            if(retornoVerificacao !== false){
                if(typeof retornoVerificacao['sucesso'] !== "undefined"){
                    if(retornoVerificacao['sucesso']){
                        retornoRequestPOST = {sucesso : true , mensagem : retornoVerificacao['mensagem']};
                    }else {
                        retornoRequestPOST = {sucesso : false , mensagem : retornoVerificacao['mensagem']};
                    }
                } else {
                    retornoRequestPOST = request.responseText; 
                       
                } 
            }
        } else {
            retornoRequestPOST = {sucesso : false , mensagem : 'Não foi possivel realizar a operação'};
        }
    }

    request.ontimeout = function (event) {
        //Apresenta a mensagem de erro de conexão
        retornoRequestPOST = {sucesso : false , mensagem : 'Não foi possivel conectar ao servidor'};    
    };

}

function recarregarDIV(){
    //Função para recarregar algumas scripts
    
    let datepicker = document.getElementsByClassName("datepicker-here");
    $(datepicker).datepicker({});
    
    let multiselected = document.getElementsByClassName("selectpicker");
        $(multiselected).selectpicker({
            deselectAllText: "Limpar",
            selectAllText:"Selecionar Todos"
        });

    let tabelas = document.getElementsByClassName("table");
    $(tabelas).DataTable({
        "ordering": false,    
        "iDisplayLength": 50,
        "bLengthChange": false,      
        "aaSorting": [],
        "bInfo": false, // hide showing entries
        "oLanguage": {
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sZeroRecords": "Nada encontrado..",
                "sInfo": "Motrando _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Nenhum registro.",
                "sSearch": "Pesquisar: ",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":    "Último",
                    "sNext":    "Próximo",
                    "sPrevious": "Anterior"
                }
            }
    });
    

}

function GET(url){
    let request = new XMLHttpRequest();
    request.open('GET', url.toString(), true);
    request.setRequestHeader("Content-Type", "application/json");
    request.timeout = 15000;
    request.addEventListener("error", ErrorHandler);
    request.send();
    //Trata erros
    function ErrorHandler(erro){
        retornoRequestGET = 'erro'    ;
    }

    request.onload = function(){
        //Verifica status code da request
        if(request.status === 200){
            retornoRequestGET = request.responseText;
        } else {
            retornoRequestGET = 'erro';
        }
    }
    
    request.ontimeout = function (event) {
        //Apresenta a mensagem de erro de conexão
        retornoRequestGET = 'erro';    
    }
}

function loadjscssfile(filename, filetype){
    if (filetype=="js"){ //if filename is a external JavaScript file
        var fileref=document.createElement('script')
        fileref.setAttribute("type","text/javascript")
        fileref.setAttribute("src", filename)
    }
    else if (filetype=="css"){ //if filename is an external CSS file
        var fileref=document.createElement("link")
        fileref.setAttribute("rel", "stylesheet")
        fileref.setAttribute("type", "text/css")
        fileref.setAttribute("href", filename)
    }
    if (typeof fileref!="undefined")
        document.getElementsByTagName("head")[0].appendChild(fileref)
}

function SubstituirConteudoDIV(html, div){
    document.getElementById(div.toString()).innerHTML = html.toString();
}

function MensagemSucesso(mensagem,url = ''){
    swal({
        title: "Sucesso!",
        text: mensagem.toString(),
        type: "success",
        showCancelButton: false,
        confirmButtonClass: 'btn-success',
        confirmButtonText: 'OK'
      },
      function(isConfirm){
            if(isConfirm){
                if(url != ''){
                    CarregarPagina(url.toString(), 'main');
                }        
            } 
      }
      );
}

function MensagemAlerta(mensagem){
    swal({
        title: "Atenção!",
        text: mensagem.toString(),
        type: "warning",
        showCancelButton: false,
        confirmButtonClass: 'btn-success',
        confirmButtonText: 'OK'
    });
}

function AdicionarValue(id, idSelecionado){
    let retorno;
    let indice = 0;
    let options = document.getElementById(id.toString()).getElementsByTagName("option"); 
    for(let i = 0; i < options.length; i++){
        if(options[i].selected){
            if(indice == 0){
                retorno = options[i].value;
            } else {
                retorno = retorno +';' + options[i].value;
            }
            indice = indice + 1;
            // document.getElementById(id.toString()).value =  document.getElementById(id.toString()).value + " " +  options[i].value;
        } 
    }
    return retorno;
}

function MensagemInformacao(mensagem){
    swal({
        title: "Atenção",
        text: mensagem.toString(),
        type: "info",
        showCancelButton: false,
        confirmButtonClass: 'btn-info',
        confirmButtonText: 'OK'
      },
      function(isConfirm){
            if(isConfirm){
                retornoMsgInfo = true;
            } else {
                retornoMsgInfo = false;
            }
      });    
}

function MensagemErro(mensagem){
    swal({
        title: "Erro",
        text: mensagem.toString(),
        type: "error",
        showCancelButton: false,
        confirmButtonClass: 'btn-danger',
        confirmButtonText: 'OK'
      });    
}

function CarregarPagina(url,div = 'main'){
    EsconderDIV(div, false);
    loading(true);
    GET(url);
    let intervalo = setInterval(() => {
        if(retornoRequestGET != null){
            SubstituirConteudoDIV(retornoRequestGET, div);
            recarregarDIV(div);
            EsconderDIV(div, true);
            loading(false);
            clearInterval(intervalo);
            retornoRequestGET = null;                    
        }
    }, 50);    
}

function LimparDIVPagina(div){//Funcao que remove o conteudo de uma div
    document.getElementById(div.toString()).innerHTML = '';
}

function EsconderDIV(div,is_hidden, display = false){//Funcao para esconder a div e nao alterar o layout da pagina
    if(is_hidden){//Verifica se a div está visivel, caso não, mostra a div
        if(display){
            document.getElementById(div.toString()).style.display = "initial";   
        } else {
            document.getElementById(div.toString()).style.opacity = 1;    
        } 
    } else {
        if(display){
            document.getElementById(div.toString()).style.display = "none";
        } else {
            document.getElementById(div.toString()).style.opacity = 0;
        }
    }
}

function VerificaChecked(id){
    let retorno = document.getElementById(id.toString()).checked;
    return retorno;
}

function VerificaSelected(id, value){
    let pesquisar = "#"+id.toString()+" option:selected";
    let retorno = $(pesquisar).val(); 
    if(value == retorno){
        return true;
    }
    return false;

}
function AlternarDIV(div,divesconder){//Funcao para esconder uma div e mostrar outra
    document.getElementById(div.toString()).style.display = "initial";    
    document.getElementById(divesconder.toString()).style.display = "none";   
}

function CarregarPaginaComAviso(url, div, mensagem){
    MensagemInformacao(mensagem.toString());
    let intervalo = setInterval(() => {
        if(retornoMsgInfo){
            CarregarPagina(url,div);
            clearInterval(intervalo); 
            retornoMsgInfo = false;
        }
    }, 50);
    
}

function FormToJSON(formName){
    let object = {};
    let form = document.getElementById(formName.toString());
    var formData = new FormData(form);
    formData.forEach(function(value, key){
        if(key.includes('[]')){
            object[key] = AdicionarValue(key);
        } else {
            object[key] = value;
        }
    });
    var json = JSON.stringify(object);
    return json;
}

function MensagemPergunta(mensagem, tipo_request, url){
    swal({
            title: "Voce tem certeza",
            text: mensagem.toString(),
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Sim",
            cancelButtonText: "Não",
            closeOnConfirm: true,
            closeOnCancel: false
        },
        function(isConfirm) {
            if (isConfirm) {
                if(tipo_request == 'post'){
                    loading(true);
                    POST(url);
                    //Verifica se a variavel de retorno foi preenchida
                    let intervalo = setInterval(() => {
                        if(retornoRequestPOST != null){
                            if(retornoRequestPOST != 'erro'){
                                if(Array.isArray(retornoRequestPOST)){
                                    if(retornoRequestPOST['sucesso'] == true){
                                        loading(false);
                                        swal("Sucesso", "Operação concluida com sucesso", "success");
                                    } else {
                                        loading(false);
                                        swal("Erro!", retornoRequestPOST[mensagem].toString(), "error");    
                                    }
                                } else {
                                    loading(false);
                                    swal("Sucesso", "Operação concluida com sucesso", "success");
                                }
                            } else {
                                loading(false);
                                swal("Erro!", 'Não foi possivel realizar a operação.', "error");    
                            }
                            retornoRequestPOST = null;
                            clearInterval(intervalo);    
                        }    
                    }, 50);
                    
                } else {
                    loading(true);
                    GET(url);
                    let intervalo = setInterval(() => {
                        if(retornoRequestGET != 'erro'){
                            if(Array.isArray(retornoRequestGET)){
                                if(retornoRequestGET['sucesso'] == true){
                                    loading(false);
                                    swal("Sucesso", "Operação concluida com sucesso", "success");
                                } else {
                                    loading(false);
                                    swal("Erro!", retornoRequestGET[mensagem].toString(), "error");    
                                }
                            } else {
                                loading(false);
                                swal("Sucesso", "Operação concluida com sucesso", "success");
                            }
                        } else {
                            loading(false);
                            swal("Erro!", 'Não foi possivel realizar a operação.', "error");    
                        }
                        retornoRequestGET = null; 
                        clearInterval(intervalo);    
                           
                    }, 50);
                           
                }    
            } else {
                swal("Cancelada!", "Operação cancelada com sucesso", "error");
            }
        }
    );    
}