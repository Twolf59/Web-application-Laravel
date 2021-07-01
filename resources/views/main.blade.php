<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test Technique</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>

    <header>
        <nav class="navbar navbar-large bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">
                Test Technique DESREUMAUX Thomas
              </a>
            </div>
            <button class="btn btn-outline-secondary" id="btn_add">Ajouter</button>

            <div id="form_add" style="display:none;">

                <h5>Ajouter</h5>

                <div class="row">
                    <div class="col">
                        <input type="text" name="numero" placeholder="Numero" id="numero_form_add">
                        <input type="number" name="gateway" placeholder="Gateway" id="gateway_form_add">
                    </div>
                    <div class="col">
                        <p> Date installation : <input type="date" name="date" id="date_form_add"></p>
                        <p>Disponible : <input type="radio" id="r1_add" name="status_add"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="" name="latitude" placeholder="latitude" id="latitude_form_add">
                    </div>
                    <div class="col">
                        <input type="" name="longitude" placeholder="longitude" id="longitude_form_add">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <input type="text" name="batterie" placeholder="batterie" id="batterie_form_add">
                    </div>
                    <div class="col">
                        <input type="" name="rssi" placeholder="RSSI" id="rssi_form_add">
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-success" id="add">Valider</button>
                    </div>
                </div>
            </div>
        </div>
          </nav>
    </header>

    <div id="list">
        @foreach ($capteurs as $data)
            <div class="card" style="width: 40rem;" id="card-{{$data->id}}" value="{{$data->id}}">
                <div class="card-body">
                    <div class="card-title">
                        <h5>ID : {{ $data->id }}</h5>
                    </div>
                    <div class="card-text">
                        <div class="row">
                            <div class="col">
                                <p id="numero_card-{{$data->id}}">Numéro : {{ $data->numero }}</p>
                                <p id="gateway_card-{{$data->id}}">Gateway : {{ $data->gateway }}</p>
                            </div>
                            <div class="col">
                                <p id="date_card-{{$data->id}}">Date d'installation : {{ $data->installation_date }}</p>
                                <p id="status_card-{{$data->id}}">Status : {{ $data->status }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                            <p id="latitude_card-{{$data->id}}">Latitude : {{$data->latitude}}</p>
                            </div>
                            <div class="col">
                                <p id="longitude_card-{{$data->id}}">Longitude : {{$data->longitude}}</p>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                @if ($data->batterie != null)
                                <p id="batterie_card-{{$data->id}}">Batterie : Oui</p>
                                @else
                                    <p id="batterie_card-{{$data->id}}" >Batterie : Non</p>
                                @endif
                            </div>
                            <div class="col">
                                @if($data->rssi != null)
                                    <p id="rssi_card-{{$data->id}}">RSSI : {{$data->rssi}}</p>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <a id="btn_delete" value="{{$data->id}}" type="button" class="btn btn-danger">Delete</a>
                            </div>
                            <div class="col">
                                <button id="edit" value="{{$data->id}}" class="btn btn-primary">Editer</a>
                            </div>

                        </div>

                        <div id="form-{{$data->id}}" style="display:none;">

                                <h5>Editer</h5>

                                <div class="row">
                                    <div class="col">
                                        <input type="number" name="id" id="id_form" value="{{$data->id}}" readonly>
                                        <input type="text" name="numero" placeholder="Numero" id="numero_form-{{$data->id}}">
                                        <input type="number" name="gateway" placeholder="Gateway" id="gateway_form-{{$data->id}}">
                                    </div>
                                    <div class="col">
                                        <p> Date installation : <input type="date" name="date" id="date_form-{{$data->id}}"></p>
                                        <p>Disponible : <input type="checkbox" id="r1" name="status"/></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="number" name="latitude" placeholder="latitude" id="latitude_form-{{$data->id}}">
                                    </div>
                                    <div class="col">
                                        <input type="number" name="longitude" placeholder="longitude" id="longitude_form-{{$data->id}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" name="batterie" placeholder="batterie" id="batterie_form-{{$data->id}}">
                                    </div>
                                    <div class="col">
                                        <input type="number" name="rssi" placeholder="RSSI" id="rssi_form-{{$data->id}}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button class="btn btn-success" value="{{$data->id}}" id="update">Valider</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <script>

document.addEventListener('click', function (e) {
    if(e.target.id === 'btn_delete') {
        const target = e.target;
        const id = target.getAttribute('value');
        const card = document.getElementById('card-' + id);

        $.ajax({
            type:'GET',
            url:"/capteur/" + id,
            success:function(data) {
                card.remove();
            }
        });
    }

    else if(e.target.id === 'edit'){
        const target = e.target;
        const id = target.getAttribute('value');

        if(document.getElementById("form-" + id).style.display === "none"){
            document.getElementById("form-" + id).style.display = ""
        }else if(document.getElementById("form-" + id).style.display === "")
        {
            document.getElementById("form-" + id).style.display = "none"
        }

    }

    else if(e.target.id === 'btn_add'){
        if(document.getElementById("form_add").style.display === "none"){
            document.getElementById("form_add").style.display = ""
        }else if(document.getElementById("form_add").style.display === "")
        {
            document.getElementById("form_add").style.display = "none"
        }
    }

    if(e.target.id === 'update'){
        const target = e.target;
        const id = target.getAttribute('value');

        var rate_value;
        if(document.getElementById("r1").checked){
            rate_value = "Disponible";

        }else {
            rate_value = "Indisponible";

        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'GET',
            url:"/update/" + id,
            data:{
                id: id,
                numero:  $('#numero_form-' + id).val(),
                gateway:  $('#gateway_form-' + id).val(),
                date:  $('#date_form-' + id).val(),
                status:  rate_value,
                batterie:  $('#batterie_form-' + id).val(),
                longitude:  $('#longitude_form-' + id).val(),
                latitude:  $('#latitude_form-' + id).val(),
                rssi:  $('#rssi_form-' + id).val()
            },
            success:function(data) {
                for(var i = 0; i < data.length; i++){
                    for(var j = 0; j < data.length; j++){
                        $('#numero_card-' + id).text("Numero : " + data[j]["numero"])
                        $('#gateway_card-' + id).text("Gateway : " + data[j]["gateway"])
                        $('#date_card-' + id).text("Date d'installation : " + data[j]["installation_date"])
                        $('#status_card-' + id).text("Status : " + data[j]["status"])
                        $('#latitude_card-' + id).text("Latitude : " + data[j]["latitude"])
                        $('#longitude_card-' + id).text("Longitude : " + data[j]["longitude"])
                        $('#batterie_card-' + id).text("Batterie : " + data[j]["batterie"])
                        $('#rssi_card-' + id).text("RSSI : " + data[j]["rssi"])
                    }
                }

            }
        });
    }

    else if(e.target.id === 'add'){
        const target = e.target;
        const id = target.getAttribute('value');

        var rate_value;
        if(document.getElementById("r1_add").checked){
            rate_value = "Disponible";

        }else {
            rate_value = "Indisponible";
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type:'POST',
            url:"/add",
            data:{
                numero:  $('#numero_form_add').val(),
                gateway:  $('#gateway_form_add').val(),
                date:  $('#date_form_add').val(),
                status:  rate_value,
                batterie:  $('#batterie_form_add').val(),
                longitude:  $('#longitude_form_add').val(),
                latitude:  $('#latitude_form_add').val(),
                rssi:  $('#rssi_form_add').val()
            },
            success:function(data) {
                console.log(data)
                for(var i = 0; i < data.length; i++){
                    for(var j = 0; j < data.length; j++){


                        const div = document.getElementById("list");
                        const Header = document.createElement("div");
                        const divCard = document.createElement("div");
                        const divTitle = document.createElement("div");
                        const divContent = document.createElement("div");
                        const h5 = document.createElement("h5");
                        const divRow1 = document.createElement("div");
                        const divCol1 = document.createElement("div");
                        const p1 = document.createElement("p");
                        const p2 = document.createElement("p");
                        const divCol2 = document.createElement("div");
                        const p3 = document.createElement("p");
                        const p4 = document.createElement("p");
                        const divRow2 = document.createElement("div");
                        const divCol3 = document.createElement("div");
                        const p5 = document.createElement("p");
                        const divCol4 = document.createElement("div");
                        const p6 = document.createElement("p");
                        const divRow3 = document.createElement("div");
                        const divCol5 = document.createElement("div");
                        const p7 = document.createElement("p");
                        const divCol6 = document.createElement("div");
                        const p8 = document.createElement("p");
                        const divRow4 = document.createElement("div");
                        const divCol7 = document.createElement("div");
                        const a1 = document.createElement("a");
                        const divCol8 = document.createElement("div");
                        const b1 = document.createElement("button");

                        divTitle.appendChild(h5);

                        divCol1.appendChild(p1);
                        divCol1.appendChild(p2);
                        divRow1.appendChild(divCol1);
                        divCol2.appendChild(p3);
                        divCol2.appendChild(p4);
                        divRow1.appendChild(divCol2);
                        divContent.appendChild(divRow1);

                        divCol3.appendChild(p5);
                        divRow2.appendChild(divCol3);
                        divCol4.appendChild(p6);
                        divRow2.appendChild(divCol4);
                        divContent.appendChild(divRow2);

                        divCol5.appendChild(p7);
                        divRow3.appendChild(divCol5);
                        divCol6.appendChild(p8);
                        divRow3.appendChild(divCol6);
                        divContent.appendChild(divRow3);

                        divCol8.appendChild(b1);
                        divRow4.appendChild(divCol8);
                        divCol7.appendChild(a1);
                        divRow4.appendChild(divCol7);
                        divContent.appendChild(divRow4);

                        divCard.appendChild(divTitle);
                        divCard.appendChild(divContent);
                        Header.appendChild(divCard);
                        div.appendChild(Header);

                        Header.setAttribute('class', 'card');
                        Header.setAttribute('id', 'card-'+data[j]['id']);
                        Header.setAttribute('style', 'width: 40rem;');
                        Header.setAttribute('value', data[j]['id']);

                        divCard.setAttribute('class', 'card-body');

                        divTitle.setAttribute('class', 'card-title');

                        h5.innerHTML = "ID : " + data[j]['id'];

                        divContent.setAttribute('class', 'card-text');

                        divRow1.setAttribute('class', 'row');
                        divCol1.setAttribute('class', 'col');
                        p1.setAttribute('id', 'numero_card-' + data[j]['id']);
                        p2.setAttribute('id', 'gateway_card-' + data[j]['id']);
                        p1.innerHTML = "Numéro : " + data[j]["numero"];
                        p2.innerHTML = "Gateway : " + data[j]["gateway"];
                        divCol2.setAttribute('class', 'col');
                        p3.setAttribute('id', 'date_card-' + data[j]['id']);
                        p4.setAttribute('id', 'status_card-' + data[j]['id']);
                        p3.innerHTML = "Date d'installation : " + data[j]["installation_date"];
                        p4.innerHTML = "Status : " + data[j]["status"];

                        divRow2.setAttribute('class', 'row');
                        divCol3.setAttribute('class', 'col');
                        p5.setAttribute('id', 'latitude_card-' + data[j]['id']);
                        p5.innerHTML = "Latitude : " + data[j]["latitude"];
                        divCol4.setAttribute('class', 'col');
                        p6.setAttribute('id', 'longitude_card-' + data[j]['id']);
                        p6.innerHTML = "Longitude : " + data[j]["longitude"];

                        divRow3.setAttribute('class', 'row');
                        divCol5.setAttribute('class', 'col');
                        p7.setAttribute('id', 'batterie_card-' + data[j]['id']);
                        p7.innerHTML = "Batterie : " + data[j]["batterie"];
                        divCol6.setAttribute('class', 'col');
                        p8.setAttribute('id', 'rssi_card-' + data[j]['id']);
                        p8.innerHTML = "RSSI : " + data[j]["rssi"];

                        divRow4.setAttribute('class', 'row');
                        divCol7.setAttribute('class', 'col');
                        a1.setAttribute('id', 'btn_delete');
                        a1.setAttribute('class', 'btn btn-primary');
                        a1.setAttribute('value', data[j]['id']);
                        a1.setAttribute('type', 'button');
                        a1.innerHTML = "Editer";
                        divCol8.setAttribute('class', 'col');
                        b1.setAttribute('id', 'edit');
                        b1.setAttribute('class', 'btn btn-danger');
                        b1.setAttribute('value', data[j]['id']);
                        b1.innerHTML = "Delete";
                    }
                }

            }
        });
    }
});



    </script>
</body>
</html>
