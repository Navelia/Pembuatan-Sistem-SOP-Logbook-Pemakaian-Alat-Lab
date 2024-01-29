@extends('admin.home')
@section('content')
  <h2>Ubah Jenis Alat</h2>
  @if (session('status'))
    <div class="alert alert-primary">
      <p>{{ session('status') }}</p>
    </div>
  @endif
  <form action="{{ route('ubahGambarJenisAlat') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="idJenisAlat" value="{{ $dataJenisAlat->id }}">
    <div class="form-group">
      <label for="gambarAlat">Gambar Alat</label>
      <input class="form-control" accept="image/*" type="file" id="gambarAlat" name="gambarAlat" required />
    </div><br>
    <div class="image-container">
      <img id="imagePreview" class="card-img-top img-fluid" src='{{ asset("images/jenis_alat/$dataJenisAlat->gambar") }}' />
    </div>
    <button class="btn btn-info btn-fill" type="submit">Ubah Gambar</button>
  </form>
  <form action="{{ route('simpanUbahJenisAlat') }}" method="post" enctype="multipart/form-data">
    @csrf
    <br>
    <input type="hidden" name="idJenisAlat" value="{{ $dataJenisAlat->id }}">
    <div class="form-group"><label for="namaAlat">Nama Alat</label>
      <input class="form-control" id="namaAlat" name="namaAlat" value="{{ $dataJenisAlat->nama }}" required />
      <label for="deskripsiAlat">Deskripsi Alat</label>
      <textarea rows="3" class="form-control" id="deskripsiAlat" name="deskripsiAlat" required>{{ $dataJenisAlat->deskripsi }}</textarea>
    </div>
    <br>
    <div class="row">
      <h2>Spesifikasi</h2>
      <div class="col-md-3">
        <button id="addSpesifikasi" type="button" class="btn btn-info"> + Tambah Spesifikasi Baru</button>
      </div>
      <table class="table table-striped-columns">
        <thead>
          <th>Nama</th>
          <th>Spesifikasi</th>
        </thead>
        <tbody id="spesifikasi-body">
          @foreach ($dataSpesifikasi as $spesifikasi)
            <tr draggable='true'>
              <td><input name='namaSpesifikasi[]' value="{{ $spesifikasi->nama }}" required /></td>
              <td><input name='spesifikasi[]' value="{{ $spesifikasi->spesifikasi }}" required /></td>
              <td><button class="btn btn-danger" type='button' onClick='delete_row(this)'>Hapus</button></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br>
    <div class="row">
      <h2>SOP</h2>
      <div class="col-md-3">
        <button id="addSop" type="button" class="btn btn-info">+ Tambah SOP Baru</button>
      </div>
      <table class="table table-striped">
        <thead>
          <th>SOP</th>
        </thead>
        <tbody id="sop-body">
          @foreach ($dataSop as $sop)
            <tr draggable='true'>
              <td><input name='sop[]' value="{{ $sop->sop }}" required /></td>
              <td><button class="btn btn-danger" type='button' onClick='delete_row(this)'>Hapus</button></td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <button class="btn btn-primary" type="submit" onclick="return confirm('Apakah data jenis alat sudah benar?')">Ubah Data Alat</button>
  </form>

  <br>
  <form action="{{ route('tambahAlat') }}" method="post">
    @csrf
    <div class="form-group">
      <input type="hidden" name="idJenisAlat" value="{{ $dataJenisAlat->id }}">
      <label for="jumlahAlat">Jumlah Tambah Alat</label>
      <div class="col-md-3" style="padding-bottom: 1%;">
        <input class="form-control" id="jumlahAlat" name="jumlahAlat" type="number" required />
      </div>
      <label for="jumlahAlat">Letak Alat</label>
      <div class="col-md-3" style="padding-bottom: 1%;">
        <select class="form-control" id="labAlat" name="labAlat" required>
          @foreach ($dataLab as $lab)
            <option value="{{ $lab->id }}">{{ $lab->nama }}</option>
          @endforeach
        </select>
      </div>
      <button class="btn btn-info" type="submit">+ Tambah Alat</button>
    </div>
  </form>

  <br>
  <h2>List Alat</h2>
  <form action="{{ route('simpanListAlat') }}" method="POST">
    @csrf
    <table>
      <thead>
        <th>Alat</th>
        <th>Lab</th>
        <th>Hapus</th>
        <th>Cetak</th>
      </thead>
      <tbody>
        @foreach ($dataAlat as $alat)
          <input type="hidden" name="idAlat[]" value="{{ $alat->id }}">
          <tr>
            <td href="{{ url('detailAlat/' . $alat->id) }}">{{ $dataJenisAlat->nama }} - {{ $alat->nomor }}</td>
            <td>
              <select class="form-control" id="listLabAlat" name="listLabAlat[]" required>
                @foreach ($dataLab as $lab)
                  @if ($lab->id == $alat->lab->id)
                    <option value="{{ $lab->id }}" selected>{{ $lab->nama }}</option>
                  @else
                    <option value="{{ $lab->id }}">{{ $lab->nama }}</option>
                  @endif
                @endforeach
              </select>
            </td>
            <td><a href="{{ url('hapusAlat/' . $alat->id) }}" class="btn btn-danger" onclick="return confirm('Hapus alat ({{ $dataJenisAlat->nama }} - {{ $alat->nomor }}) dan seluruh datanya?')">Hapus</a></td>
            <td><button type="button" class="btn btn-info" idAlat="{{ $alat->id }}" namaAlat="{{ $dataJenisAlat->nama }} - {{ $alat->nomor }}" onClick='cetak_alat(this)'>Cetak</button></td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <button class="btn btn-primary" type="submit" onclick="return confirm('Apakah daftar alat sudah benar?')">Ubah Daftar Alat</button>
  </form>

  {{-- Template Cetak QR Alat --}}
  {{-- <div style="display: none"> --}}
  <div id="templateCetak">
    <div class="cardContainer">
      <div>
        <div id="namaCetakAlat">
        </div>
        <div id="qrcode">
        </div>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    $(document).ready(function() {
      document.getElementById('gambarAlat').onchange = function() {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('imagePreview').src = src
      }

      $("#addSpesifikasi").click(function() {
        var countItems = document.getElementById("spesifikasi-body").childElementCount;
        $("#spesifikasi-body").append(
          "<tr draggable='true'><td><input name='namaSpesifikasi[]' required /></td><td><input name='spesifikasi[]' required /></td><td><button type='button' class='btn btn-danger' onClick='delete_row(this)'>Hapus</button></td></tr>"
        );
      });

      $("#addSop").click(function() {
        var countItems = document.getElementById("spesifikasi-body").childElementCount;
        $("#sop-body").append(
          "<tr draggable='true'><td><input name='sop[]' required /></td><td><button type='button' class='btn btn-danger' onClick='delete_row(this)'>Hapus</button></td></tr>"
        );
      });
    });

    function delete_row(element) {
      element.closest("tr").remove();
    };

    function cetak_alat(element) {
      var idAlat = element.getAttribute("idAlat");
      var namaAlat = element.getAttribute("namaAlat");
      var namaCetakAlat = document.getElementById("namaCetakAlat")
      namaCetakAlat.innerHTML = namaAlat;

      var qrcodeDiv = document.getElementById("qrcode");
      qrcodeDiv.innerHTML = "";

      var qrcode = new QRCode("qrcode", {
        text: "{{ url('detailAlat/') }}/" + idAlat,
        width: 300,
        height: 300,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
      });

      var templateCetak = document.getElementById("templateCetak");
      html2canvas(templateCetak)
        .then(canvas => {
          canvas.style.display = 'none'
          document.body.appendChild(canvas)
          return canvas
        })
        .then(canvas => {
          const image = canvas.toDataURL('image/png')
          const a = document.createElement('a')
          a.setAttribute('download', namaAlat + '.png')
          a.setAttribute('href', image)
          a.click()
          canvas.remove()
        })

      var namaCetakAlat = document.getElementById("namaCetakAlat")
      namaCetakAlat.innerHTML = "";

      var qrcodeDiv = document.getElementById("qrcode");
      qrcodeDiv.innerHTML = "";
    }

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
@endsection
