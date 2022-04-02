
            <h1>{{modeDsc}}</h1>
            <hr>
            <section class="container-m">

                    <form action="index.php?page=mnt-documentoFiscals-documentoFiscal&mode={{mode}}&doccod={{doccod}}" method="post">

                    <form action="index.php?page=mnt-documentoFiscals-documentoFiscal&mode={{mode}}&invPrdId={{invPrdId}}" method="post">

            <input type="hidden" name="xssToken" value="{{xssToken}}">

                    {{ifnot isInsert}}
                    <fieldset class="row flex-center align-center">
                        <label for="doccod" class="col-5">doccod</label>
                        <input class="col-7"  id="doccod" name="doccod" type="text" value="{{doccod}}" readonly placeholder="" >
                    </fieldset>
                    {{endifnot isInsert}}

                    {{ifnot isInsert}}
                    <fieldset class="row flex-center align-center">
                        <label for="invPrdId" class="col-5">invPrdId</label>
                        <input class="col-7"  id="invPrdId" name="invPrdId" type="text" value="{{invPrdId}}" readonly placeholder="" >
                    </fieldset>
                    {{endifnot isInsert}}

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docCtd">docCtd</label>
                        <input class="col-7" id="docCtd" name="docCtd"   type="text" value="{{docCtd}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docPrc">docPrc</label>
                        <input class="col-7" id="docPrc" name="docPrc"   type="text" value="{{docPrc}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docIva">docIva</label>
                        <input class="col-7" id="docIva" name="docIva"   type="text" value="{{docIva}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docLObs">docLObs</label>
                        <input class="col-7" id="docLObs" name="docLObs"   type="text" value="{{docLObs}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="docDsc">docDsc</label>
                        <input class="col-7" id="docDsc" name="docDsc"   type="text" value="{{docDsc}}" {{readonly}} placeholder="">
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
                    location.assign("index.php?page=mnt.documentoFiscals.documentoFiscals")
                })
                });
            </script>