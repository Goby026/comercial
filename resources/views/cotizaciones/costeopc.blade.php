<style>
    .input-width {
        width: 70px;
    }
    .btn-parte{
        margin: 5px;
        height: 60px;
        width: 100px;
    }
    .btn-parte span{
        font-size: 25px;
    }

    .add-partes{
        margin: 0 auto;
        width: 80%;
    }
</style>
<div id="partesPC">
    <input type="hidden" name="_costeo" id="_costeo" value="{{ $costeo->codiCosteo }}">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-xs pull-right" data-toggle="modal" data-target="#myModal" v-if="showButton">
        Cotizar PC
    </button>
    <br>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">¿Cotizar PC ensamblada?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    {{--<button type="button" class="btn btn-primary" v-on:click="saveItemParte()">Continuar</button>--}}
                    <button type="button" class="btn btn-primary" v-on:click="regCosteoParte">Continuar</button>
                </div>
            </div>
        </div>
    </div>

    {{--<div v-show="showCosteo">--}}
    <div>
        <parte-pc>
            <input type="hidden" name="_dolar" id="_dolar" value="{{ $dolar->dolarVenta }}">
            <input type="hidden" name="_igv" id="_igv" value="{{ $igv->valorIgv/100 }}">
        </parte-pc>
    </div>

</div>

<script src="{{ asset('js/vue-partespc/partespc.js') }}"></script>