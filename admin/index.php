  <?php require 'inc/header.php'; ?>

  <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h2">Notlar</h1>
    </div>

    <?php 
    $query = $db->query("SELECT * FROM notlar", PDO::FETCH_ASSOC);
    ?>

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>Kategori Adı</th>
            <th>Ders Başlık</th>
            <th>İşlem</th>
          </tr>
        </thead>
        <tbody>

          <?php if ($query->rowCount()): ?>

            <?php foreach ($query as $row): ?>
              <tr>
                <td><?= $row['kategori_adi'] ?></td>
                <td><?= $row['not_baslik'] ?></td>
                <td><a class="nav-link active" href="sil.php?tablo=notlar&sutun=not_id&id=<?=$row['not_id']?>">
                  <span data-feather="trash"> </span>
                </a>
                <a class="nav-link active" href="not-guncelle.php?id=<?=$row['not_id']?>">
                  <span data-feather="edit"></span>
                </a>
              </td>
            </tr>
          <?php endforeach ?>

        <?php endif ?>



      </tbody>
    </table>
  </div>
</main>
</div>
</div>


<?php require 'inc/footer.php'; ?>
