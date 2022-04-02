
            <h1>{{modeDsc}}</h1>
            <hr>
            <section class="container-m">

                    <form action="index.php?page=mnt-documentos-documento&mode={{mode}}&doccod={{doccod}}" method="post">

            <input type="hidden" name="xssToken" value="{{xssToken}}">

                    {{ifnot isInsert}}
                    <fieldset class="row flex-center align-center">
                        <label for="doccod" class="col-5">doccod</label>
                        <input class="col-7"  id="doccod" name="doccod" type="text" value="{{doccod}}" readonly placeholder="" >
                    </fieldset>
                    {{endifnot isInsert}}

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docfch">docfch</label>
                        <input class="col-7" id="docfch" name="docfch"   type="text" value="{{docfch}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="usercod">usercod</label>
                        <input class="col-7" id="usercod" name="usercod"   type="text" value="{{usercod}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docobs">docobs</label>
                        <input class="col-7" id="docobs" name="docobs"   type="text" value="{{docobs}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docshipping">docshipping</label>
                        <input class="col-7" id="docshipping" name="docshipping"   type="text" value="{{docshipping}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docest">docest</label>
                        <input class="col-7" id="docest" name="docest"   type="text" value="{{docest}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docmeta">docmeta</label>
                        <input class="col-7" id="docmeta" name="docmeta"   type="text" value="{{docmeta}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docfchdlv">docfchdlv</label>
                        <input class="col-7" id="docfchdlv" name="docfchdlv"   type="text" value="{{docfchdlv}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docestdlv">docestdlv</label>
                        <input class="col-7" id="docestdlv" name="docestdlv"   type="text" value="{{docestdlv}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docFrmPgo">docFrmPgo</label>
                        <input class="col-7" id="docFrmPgo" name="docFrmPgo"   type="text" value="{{docFrmPgo}}" {{readonly}} placeholder="">
                    </fieldset>

            <fieldset class="row flex-center align-center">
                <label class="col-5" for="option">Ejemplo de comboBox(Aplicar si se requiere)</label>
                <select class="col-7"  name="option" id="option">
                    {{foreach cmbOptions}}
                    <option value="{{value}}" {{selected}}>{{text}}</option>
                    {{endfor cmbOptions}}
                </select>
            </fieldset>
            

            <fieldset class="row flex-end align-center">
                <button type="submit" name="btnConfirmar" class="btn primary">Confirmar</button>
                &nbsp;<button type="button" id="btnCancelar" class="btn secondary">Cancelar</button>
                &nbsp;
            </fieldset>
            </form>
        </section>
            

            <script>
                document.addEventListener("DOMContentLoaded", (e)=>{
                document.getElementById("btnCancelar").addEventListener("click", (e)=>{
                    e.preventDefault();
                    e.stopPropagation();
                    location.assign("index.php?page=mnt.documentos.documentos")
                })
                });
            </script>