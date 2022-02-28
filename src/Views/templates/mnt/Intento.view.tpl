<h1>{{modeDsc}}</h1>
<hr>
<section class="container-m">
    <form action="index.php?page=mnt-intentospagos-intento&mode={{mode}}&id={{id}}" method="post">
        <input type="hidden" name="csxsToken" value="{{csxsToken}}">
   {{ifnot isInsert}}
    <fieldset class="row flex-center align-center">
        <label for="id" class="col-5">Codigo</label>
        <input class="col-7"  id="id" name="id" type="text" value="{{id}}" readonly placeholder="" >
    </fieldset>
    
      <fieldset class="row flex-center align-center">
        <label class="col-5" for="fecha">Fecha</label>
        <input class="col-7" id="fecha" name="fecha"   type="text" value="{{fecha}}" readonly placeholder="">
    </fieldset>
     {{endifnot isInsert}}
    <fieldset class="row flex-center align-center">
        <label class="col-5" for="cliente">Cliente</label>
        <input class="col-7" id="cliente" name="cliente"   type="text" value="{{cliente}}" {{readonly}} placeholder="" required>
    </fieldset>
    <fieldset class="row flex-center align-center">
        <label class="col-5" for="monto">Monto</label>
        <input class="col-7" id="monto" name="monto"   type="number" step="0.01" value="{{monto}}" {{readonly}} placeholder="" required>
    </fieldset>
    <fieldset class="row flex-center align-center">
        <label class="col-5" for="fechaVencimiento">Fecha de vencimiento</label>
        <input class="col-7" id="fechaVencimiento" name="fechaVencimiento"   type="date" value="{{fechaVencimiento}}" {{readonly}} placeholder="" required>
    </fieldset>
      <fieldset class="row flex-center align-center">
        <label class="col-5" for="estado">Estado</label>
        <select class="col-7"  name="estado" id="estadot">
            {{foreach estOptions}}
            <option value="{{value}}" {{selected}}>{{text}}</option>
            {{endfor estOptions}}
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
    document.getElementById("btnCancelar").addEventListener('click', (e)=>{
        e.preventDefault();
        e.stopPropagation();
        location.assign("index.php?page=mnt.intentospagos.intentospagos")
    })
    });
</script>