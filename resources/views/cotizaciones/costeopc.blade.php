<div id="partesPC" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 v-text="title"></h1>
            </div>
            <div class="modal-body">
                <label class="control-label">Marca:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                    <input type="text" id="txtNomMarca" name="txtNomMarca" class="form-control"
                           value="{{ old('txtMarca') }}">
                </div>
                <div class="input-group">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>DESC</th>
                            <th>VAL</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in items">
                            <td>@{{ item.id }}</td>
                            <td>@{{ item.desc }}</td>
                            <td><input class="form-control" type="text" v-model="itemSel" v-on:keyup="ver">@{{ item.val }}</td>
                        </tr>
                        <tr>
                            <td colspan="2">TOTAL</td>
                            <td>NUM</td>
                        </tr>
                        </tbody>
                    </table>
                    <input type="text" id="txtNomMarca" name="txtNomMarca" class="form-control"
                           value="{{ old('txtMarca') }}">
                    <input class="form-control" type="text" v-model="num1" v-on:keyup="ver">
                    <input class="form-control" type="text" v-model="num2" v-on:keyup="ver">
                    <input class="form-control" type="text" v-model="total" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    {{--$(function () {--}}
        {{--//    buscar la marca con campo autocompletable--}}
        {{--$( "#txtNomMarca" ).autocomplete({--}}
            {{--source: function( request, response ) {--}}
                {{--$.ajax({--}}
                    {{--url: "{{ URL::to('/getMarca') }}",--}}
                    {{--dataType: "json",--}}
                    {{--data: {--}}
                        {{--name: request.term--}}
                    {{--},--}}
                    {{--success: function( data ) {--}}
                        {{--response($.map(data, function(item){--}}
                            {{--console.log(data);--}}
                            {{--return{--}}
{{--//								id: item.codiCoti,--}}
                                {{--value: item.nombreMarca,--}}
                            {{--}--}}
                        {{--}));--}}
                    {{--}--}}
                {{--});--}}
            {{--},--}}
            {{--minLength: 3,--}}
{{--//            select: function( event, ui ) {--}}
{{--//                $(this).val(ui.item.value);--}}
{{--//                $('#txt_cliente').val(ui.item.id);--}}
{{--//            }--}}
        {{--});--}}
    {{--});--}}
</script>

<script src="{{ asset('js/vue-partespc/partespc.js') }}"></script>
