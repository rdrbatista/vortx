@extends('layout')

@section('cabecalho')
    VxTel - Cálculo de chamadas de longa distância
@endsection

@section('conteudo')
    <form id="frmCalculateSavings">
        @csrf
        <div id="validation-errors">
        </div>
        <div class="row">
            <div class="col-lg-3">
                <label>DDD de origem:</label>
                <select id="areaCodeSource" name="areaCodeSource" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($areaCodes as $areaCode)
                    <option value="{{$areaCode->id}}">{{$areaCode->code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                <label>DDD de destino:</label>
                <select id="areaCodeDestiny" name="areaCodeDestiny" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($areaCodes as $areaCode)
                        <option value="{{$areaCode->id}}">{{$areaCode->code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3">
                <label for="minutes">Minutos</label>
                <input type="number" class="form-control" min="1" id="minutes" name="minutes">
            </div>
            <div class="col-lg-3">
                <label>Plano:</label>
                <select class="form-control" id="product" name="product">
                    <option value="">Selecione</option>
                    @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row mt-2">
            <div class="container-fluid">
                <div class="pull-left">
                    <button type="button" id="btCalculates" name="btCalculates" class="btn btn-primary" onclick="getCallSavings()">
                        <i class="fa fa-plus"></i> Calcular
                    </button>
                </div>
            </div>
        </div>

        <div class="row mt-2 showPrices invisible">
            <div class="col-lg-3">
                <label>Preço sem o produto:</label>
                <span class="btn-danger" id="priceWithoutProduct"></span>
            </div>
            <div class="col-lg-3">
                <label>Preço com o produto:</label>
                <span class="btn-primary" id="priceWithProduct"></span>
            </div>
            <div class="col-lg-3">
                <label>Economia:</label>
                <span class="btn-success" id="saving"></span>
            </div>
        </div>
    </form>
@endsection
<script>
    function clearPrices() {
        $('#priceWithoutProduct').html('');
        $('#priceWithProduct').html('');
        $('#saving').html('');
        $('.showPrices').addClass("invisible");
    }

    function showPrices(data) {
        $('#validation-errors').html('');

        $('.showPrices').removeClass("invisible");
        var priceWithoutProduct = data.priceWithoutProduct.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
        var priceWithProduct = data.priceWithProduct.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
        var saving = data.saving.toLocaleString('pt-br',{style: 'currency', currency: 'BRL'});
        $('#priceWithoutProduct').html(priceWithoutProduct);
        $('#priceWithProduct').html(priceWithProduct);
        $('#saving').html(saving);
    }

    function showErrors(errors) {
        clearPrices();
        $('#validation-errors').html('');
        $.each(errors, function(key,value) {
            $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div');
        })
    }

    function getCallSavings() {
        const button = document.querySelector('#btCalculates');

        const areaCodeSourceId = document.querySelector('#areaCodeSource').value;
        const areaCodeDestinyId = document.querySelector('#areaCodeDestiny').value;
        const minutes = document.querySelector('#minutes').value;
        const product = document.querySelector('#product').value;
        const token = document.querySelector(`input[name="_token"]`).value;

        const url = '/api/getCallSavings/';

        button.disabled = true;
        button.innerHTML = 'Aguarde...';
        $.ajax({
            url: url,
            dataType: "json",
            type: "GET",
            data: {
                areaCodeSource: areaCodeSourceId,
                areaCodeDestiny: areaCodeDestinyId,
                minutes: minutes,
                product: product
            },
            success: function(response) {
                showPrices(response.data);
            },
            error: function(errorResponse) {
                if (errorResponse.responseJSON.errors != null) {
                    showErrors(errorResponse.responseJSON.errors);
                } else {
                    showErrors([errorResponse.responseJSON.msg]);
                }
            },
        }).always(function() {
            button.disabled = false;
            button.innerHTML = 'Calcular';
        });
    }
</script>
