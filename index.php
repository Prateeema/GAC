<html>
  <head>
      <!-- css & bootstraps libraries -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <link rel="stylesheet" type="text/css" href="css/style.css"/>

      <!-- tooltip script -->
      <script>
            $('#import').tooltip('toggle')
      </script>
  </head>
  <body > 
    <h2 align="center" >GAC Technology </h2>
      <div align="center" class="white-pink">
        <form action="upload.php" method="POST" enctype="multipart/form-data" name="formfile" >
          <p><h3>Importer le fichier csv </h3>
              <button type = "submit" 
                      name = "btnUpload" 
                      id   = "import" 
                      data-toggle ="tooltip" data-placement ="bottom" title ="Cliquez pour importer le fichier csv"
                      class="btn btn-success">Import
              </button>
          </p>
        </form>
      </div>
  </body>
</html>
