<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
  <style>
    html,
    body {
      height: 100%;
      font-size: 16px;
      font-family: Arial, sans-serif;
    }

    .container {
      background: rgb(250, 205, 205);
      padding: 25px;
    }

    .image-container {
      width: 300px;
      height: auto;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      margin-bottom: 20px;
    }

    .image-container img {
      max-width: 100%;
      height: auto;
    }

    .paragraphs-container {
      text-align: center;
    }

    table {
      width: 100%;
    }
  </style>
</head>

<body>
  <form action="{{ route('simpanTambahJenisAlat') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container">
      <label for="gambarAlat">Gambar Alat</label>
      <input accept="image/*" type="file" id="gambarAlat" name="gambarAlat" required />
      <div class="image-container">
        <img id="imagePreview" class="card-img-top img-fluid" />
      </div>
      <div class="paragraphs-container">
        <label for="namaAlat">Nama Alat</label>
        <input id="namaAlat" name="namaAlat" required />
        <label for="deskripsiAlat">Deskripsi Alat</label>
        <textarea id="deskripsiAlat" name="deskripsiAlat" required></textarea>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="paragraphs-container">
            <h2>Spesifikasi</h2>
          </div>
          <button id="addSpesifikasi" type="button">Tambah Spesifikasi Baru</button>
          <table class="table table-striped">
            <thead>
              <th>Nama</th>
              <th>Spesifikasi</th>
            </thead>
            <tbody id="spesifikasi-body">
            </tbody>
          </table>
        </div>

        <div class="col-md-6">
          <div class="paragraphs-container">
            <h2>SOP</h2>
          </div>
          <button id="addSop" type="button">Tambah SOP Baru</button>
          <table class="table table-striped">
            <thead>
              <th>SOP</th>
            </thead>
            <tbody id="sop-body">
            </tbody>
          </table>
        </div>
      </div>

      <div class="paragraphs-container">
        <label for="jumlahAlat">Jumlah Alat</label>
        <input id="jumlahAlat" name="jumlahAlat" type="number" required />
      </div>
      <button type="submit" onclick="return confirm('Apakah data jenis alat sudah benar?')">Simpan Alat</button>
  </form>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
  <script>
    $(document).ready(function() {
      document.getElementById('gambarAlat').onchange = function() {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('imagePreview').src = src
      }

      $("#addSpesifikasi").click(function() {
        var countItems = document.getElementById("spesifikasi-body").childElementCount;
        $("#spesifikasi-body").append("<tr draggable='true'><td><input name='namaSpesifikasi[]' required /></td><td><input name='spesifikasi[]' required /></td><td><button type='button' onClick='delete_row(this)'>Hapus</button></td></tr>");
      });

      $("#addSop").click(function() {
        var countItems = document.getElementById("spesifikasi-body").childElementCount;
        $("#sop-body").append("<tr draggable='true'><td><input name='sop[]' required /></td><td><button type='button' onClick='delete_row(this)'>Hapus</button></td></tr>");
      });
    });

    function delete_row(element) {
      element.closest("tr").remove();
    };

    // Sortable Spesifikasi
    const sortableList =
      document.getElementById("spesifikasi-body");
    let draggedItem = null;

    sortableList.addEventListener(
      "dragstart",
      (e) => {
        draggedItem = e.target;
        setTimeout(() => {
          e.target.style.display =
            "none";
        }, 0);
      });

    sortableList.addEventListener(
      "dragend",
      (e) => {
        setTimeout(() => {
          e.target.style.display = "";
          draggedItem = null;
        }, 0);
      });

    sortableList.addEventListener(
      "dragover",
      (e) => {
        e.preventDefault();
        const afterElement =
          getDragAfterElement(
            sortableList,
            e.clientY);
        const currentElement =
          document.querySelector(
            ".dragging");
        if (afterElement == null) {
          sortableList.append(
            draggedItem
          );
        } else {
          sortableList.insertBefore(
            draggedItem,
            afterElement
          );
        }
      });

    const getDragAfterElement = (
      container, y
    ) => {
      const draggableElements = [
        ...container.querySelectorAll(
          "tr:not(.dragging)"
        ),
      ];

      return draggableElements.reduce(
        (closest, child) => {
          const box =
            child.getBoundingClientRect();
          const offset =
            y - box.top - box.height / 2;
          if (
            offset < 0 &&
            offset > closest.offset) {
            return {
              offset: offset,
              element: child,
            };
          } else {
            return closest;
          }
        }, {
          offset: Number.NEGATIVE_INFINITY,
        }
      ).element;
    };

    // Sortable SOP
    const sortableList2 =
      document.getElementById("sop-body");
    let draggedItem2 = null;

    sortableList2.addEventListener(
      "dragstart",
      (e) => {
        draggedItem2 = e.target;
        setTimeout(() => {
          e.target.style.display =
            "none";
        }, 0);
      });

    sortableList2.addEventListener(
      "dragend",
      (e) => {
        setTimeout(() => {
          e.target.style.display = "";
          draggedItem2 = null;
        }, 0);
      });

    sortableList2.addEventListener(
      "dragover",
      (e) => {
        e.preventDefault();
        const afterElement =
          getDragAfterElement2(
            sortableList2,
            e.clientY);
        const currentElement =
          document.querySelector(
            ".dragging");
        if (afterElement == null) {
          sortableList2.append(
            draggedItem2
          );
        } else {
          sortableList2.insertBefore(
            draggedItem2,
            afterElement
          );
        }
      });

    const getDragAfterElement2 = (
      container, y
    ) => {
      const draggableElements = [
        ...container.querySelectorAll(
          "tr:not(.dragging)"
        ),
      ];

      return draggableElements.reduce(
        (closest, child) => {
          const box =
            child.getBoundingClientRect();
          const offset =
            y - box.top - box.height / 2;
          if (
            offset < 0 &&
            offset > closest.offset) {
            return {
              offset: offset,
              element: child,
            };
          } else {
            return closest;
          }
        }, {
          offset: Number.NEGATIVE_INFINITY,
        }
      ).element;
    };
  </script>
</body>

</html>
