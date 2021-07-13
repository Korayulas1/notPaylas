  <?php require 'inc/header.php'; ?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Kategori Güncelle</h1>
    </div>


    <?php 

    $id = $_GET['id'];

    if (empty($id)) {
      header('Location: kategoriler.php');
      exit();
    }

    $row = $db->query("SELECT * FROM kategoriler WHERE kategori_id = '{$id}'")->fetch(PDO::FETCH_ASSOC);

    if (isset($_POST['submit'])) {

      $kategori_adi = $_POST['kategori_adi'];

      if (empty($kategori_adi)) {

        $hata = 'Kategori adı boş olamaz';

      }
      else{

        $query = $db->query("SELECT * FROM kategoriler WHERE kategori_adi = '{$kategori_adi}' AND kategori_id != '{$id}'")->fetch(PDO::FETCH_ASSOC);
        if ( $query ){

          $hata = 'Bu isimde bir kategori zaten mevcut';

        }
        else{

          $query = $db->prepare("UPDATE kategoriler SET
            kategori_adi = :kategori_adi
            WHERE kategori_id = :kategori_id");
          $update = $query->execute(array(
           "kategori_adi" => $kategori_adi,
           "kategori_id" => $id
         ));
          if ( $update ){
           $basarili = 1;
         }

       }
     }
   }


   ?>

   <?php if (isset($basarili)): ?>
     <div class="alert alert-success" role="alert">
       İşlem Başarılı
     </div>
   <?php endif ?>

   <?php if (isset($hata)): ?>
     <div class="alert alert-danger" role="alert">
      <?= $hata ?>
    </div>
  <?php endif ?>


  <form method="POST" action="">
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="kategori_adi">Kategori Adı</label>
        <input type="text" name="kategori_adi" value="<?= isset($_POST['kategori_adi']) ? $_POST['kategori_adi'] : $row['kategori_adi'] ?>" class="form-control" id="kategori_adi">
      </div>
    </div>
    <button type="submit" name="submit" value="1" class="btn btn-primary">Ekle</button>
  </form>
</main>

</div>
</div>


<?php require 'inc/footer.php'; ?>
