
            <h1>{{modeDsc}}</h1>
            <hr>
            <section class="container-m">

                    <form action="index.php?page=mnt-Anonimas-Anonima&mode={{mode}}&anoncartid={{anoncartid}}" method="post">

                    <form action="index.php?page=mnt-Anonimas-Anonima&mode={{mode}}&invPrdId={{invPrdId}}" method="post">

            <input type="hidden" name="xssToken" value="{{xssToken}}">

                    {{ifnot isInsert}}
                    <fieldset class="row flex-center align-center">
                        <label for="anoncartid" class="col-5">anoncartid</label>
                        <input class="col-7"  id="anoncartid" name="anoncartid" type="text" value="{{anoncartid}}" readonly placeholder="" >
                    </fieldset>
                    {{endifnot isInsert}}

                    {{ifnot isInsert}}
                    <fieldset class="row flex-center align-center">
                        <label for="invPrdId" class="col-5">invPrdId</label>
                        <input class="col-7"  id="invPrdId" name="invPrdId" type="text" value="{{invPrdId}}" readonly placeholder="" >
                    </fieldset>
                    {{endifnot isInsert}}

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="cartCtd">cartCtd</label>
                        <input class="col-7" id="cartCtd" name="cartCtd"   type="text" value="{{cartCtd}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="cartPrc">cartPrc</label>
                        <input class="col-7" id="cartPrc" name="cartPrc"   type="text" value="{{cartPrc}}" {{readonly}} placeholder="">
                    </fieldset>

                    <fieldset class="row flex-center align-center">
                        <label class="col-5" for="cartIat">cartIat</label>
                        <input class="col-7" id="cartIat" name="cartIat"   type="text" value="{{cartIat}}" {{readonly}} placeholder="">
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
                    location.assign("index.php?page=mnt.Anonimas.Anonimas")
                })
                });
            </script>