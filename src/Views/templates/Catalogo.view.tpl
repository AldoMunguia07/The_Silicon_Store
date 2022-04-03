<h1>{{SITE_TITLE}}</h1>

<h1><a href="index.php?page=mnt-Autenticados-Autenticados">Ver mi carrito</a></h1>
{{foreach celular}}
  <section>
    <form action="index.php?page=mnt-Autenticados-Autenticado&mode=UPD&usercod={{usercod}}&invPrdId={{invPrdId}}" method="post">
      <h2>{{nombre}}</h2>
      <h3>{{marca}}</h3>
      <h4>{{descripcion}}</h4>
      <span>{{cartPrc}}</span>
      <input type="hidden" name="cartPrc" value="{{cartPrc}}">
      <br>
      <span>{{StockDisp}}</span>
      <br>
      <input type="hidden" name="cant" value="{{cant}}">
      <input class="col-7" id="cartCtd" name="cartCtd" min="0" max="{{StockDisp}}"  type="number" value="{{cartCtd}}" style="width: 60px;">
      <br>
      <br>
      <button type="submit" name="btnConfirmar" class="btn primary">Agregar</button>

    </form>
  </section>
{{endfor celular}}


