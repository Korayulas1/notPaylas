  <?php require 'inc/header.php'; 


  ?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Yeni Not Ekle</h1>
    </div>

    <?php 
    $categories = $db->query("SELECT * FROM kategoriler", PDO::FETCH_ASSOC);


    if (isset($_POST['submit'])) {

      $kategori_adi = $_POST['kategori_adi'];
      $not_baslik = $_POST['not_baslik'];
      $not_icerik = $_POST['not_icerik'];
      $not_resim = $_FILES['image']['size'];

      if (empty($kategori_adi)) {

        $hata = 'Kategori seçmediniz';

      }
      elseif (empty($not_baslik)) {
        $hata = 'Not başlığı girmediniz';
      }
      elseif (empty($not_icerik)) {
        $hata = 'Not içeriği girmediniz';
      }
      elseif(!$not_resim > 0){
        $hata = 'Not görseli seçmediniz';
      }
      else{



        $image = new \Verot\Upload\Upload( $_FILES[ 'image' ] );
        if ( $image->uploaded ) {

         $image->file_new_name_body = md5(uniqid());
         $image->Process('resimler/');

         if ( $image->processed ){

          $not_resim =  $image->file_dst_path . $image->file_dst_name;

          $query = $db->prepare("INSERT INTO notlar SET kategori_adi = ?,not_baslik = ?,not_icerik = ?,not_resim = ?");
          $insert = $query->execute(array($kategori_adi,$not_baslik,$not_icerik,$not_resim));
          if ( $insert ){
           $basarili = 1;
         }

       } else {
         $hata = $image->error;
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

<form method="POST" action="" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group col-md-6 ">
      <label for="not_baslik">Ders Başlık</label>
      <input type="text" name="not_baslik" value="<?= isset($_POST['not_baslik']) ? $_POST['not_baslik'] : '' ?>" class="form-control" id="not_baslik">
    </div>

    <div class="form-group col-md-6">
      <label for="kategori_adi">Ders Kategorisi</label>
      <select name="kategori_adi" id="kategori_adi" class="form-control">
        <option value="">Kategori Seçin</option>
        <?php if ($categories->rowCount()): ?>
          <?php foreach ($categories as $category): ?>
            <option <?= isset($_POST['kategori_adi']) && $_POST['kategori_adi'] == $category['kategori_adi'] ? 'selected' : '' ?> value="<?= $category['kategori_adi'] ?>"><?= $category['kategori_adi'] ?></option>
          <?php endforeach ?>
        <?php endif ?>

      </select>
    </div>
  </div>

  <div class="form-group">
    <label for="image">Not Görseli</label>
    <input type="file" class="form-control-file" name="image" id="image">
  </div>

  <div class="form-group">
    <label for="not_icerik">Ders Notu İçeriği</label>
    <textarea class="form-control" name="not_icerik" id="not_icerik" rows="7"><?= isset($_POST['not_icerik']) ? $_POST['not_icerik'] : '' ?></textarea>
  </div>

  <button type="submit" name="submit" value="1" class="btn btn-primary">Ekle</button>
</form>


</main>
</div>
</div>


<?php require 'inc/footer.php'; ?>
