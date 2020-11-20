<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <title>Posto</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div>

          <div class="form-group">
            <label>Nome do Posto</label>
            <input type="text" class="form-control" id="nome_posto" name="nome_posto">
          </div>
           <div class="form-group">
            <label>Endereço</label>
            <input type="text" class="form-control" id="endereco_post" name="endereco_posto">
          </div>

          <button type="button" class="btn btn-primary" id="enviar">Enviar</button>

      </div>
    </div>
    <div class="row">
      <ul class="list-group" id="post_list"></ul>
    </div>
  </div>
  <script src="/assets/js/jquery-3.4.1.min.js"></script>
  <script>
    $.get('/api/posto.php', res => {
      console.log(res);
      $.each(res.data, (k,v) => {
        $('#post_list').append($(`<li class="list-group-item">${v.nome_posto}</li>`))
      })
    })

    $('#enviar').on('click', e => {
      e.preventDefault();
      let d = $('input').serializeArray();
      console.log(d);
      $.ajax({
        url: '/api/posto.php',
        method: 'POST',
        data: d,
        statusCode: {
          201: function() {
            alert('Sucesso');
          },
          301: function() {
            alert('Erro');
          }
        }
      });
    })

  </script>
</body>
</html>