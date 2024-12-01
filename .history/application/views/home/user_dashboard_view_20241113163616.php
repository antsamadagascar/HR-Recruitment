<?php
echo base_url('A');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <form action="annonces" method="post">
                    <div class="row mb-3">
                        <label class="col-sm-2 col-form-label">Branche concernée</label>
                        <div class="col-sm-10">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Choisir une branche</option>
                            <option value="1">branche 1</option>
                            <option value="2">branche 2</option>
                            <option value="3">branche 3</option>
                        </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>
</html>