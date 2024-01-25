@extends('admin.home')
@section('content')
    <h2>Tambah Jenis Alat</h2>
    <form action="{{ route('simpanTambahJenisAlat') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="gambarAlat" class="form-label">Gambar Alat</label>
            <input accept="image/*" type="file" id="gambarAlat" class="form-control" name="gambarAlat" required />
        </div>

        <div class="image-container">
            <img id="imagePreview" class="card-img-top img-fluid" />
        </div>

        <div class="form-group"></div>
        <label for="namaAlat">Nama Alat</label>
        <input type="text" class="form-control" placeholder="Masukkan nama jenis alat Anda" id="namaAlat"
            name="namaAlat" required /><br>
        <label for="deskripsiAlat">Deskripsi Alat</label>
        <textarea class="form-control" rows="3" id="deskripsiAlat" name="deskripsiAlat"
            placeholder="Tuliskan deskripsi jenis alat Anda" required></textarea>
        <br>

        <div class="row">
            <h2>Spesifikasi</h2>
            <div class="col-md-3">
                <button id="addSpesifikasi" type="button" class="btn btn-info btn-fill">+ Tambah Spesifikasi Baru</button>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>Nama</th>
                    <th>Spesifikasi</th>
                </thead>
                <tbody id="spesifikasi-body">
                </tbody>
            </table>
        </div>

        <div class="row">
            <h2>SOP</h2>
            <div class="col-md-3">
                <button id="addSop" type="button" class="btn btn-info btn-fill">+ Tambah SOP Baru</button>
            </div>
            <table class="table table-striped">
                <thead>
                    <th>SOP</th>
                </thead>
                <tbody id="sop-body">
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <label for="jumlahAlat">Jumlah Alat</label>
            <input id="jumlahAlat" name="jumlahAlat" type="number" class="form-control" required />
        </div><br>
        <button type="submit" class="btn btn-info btn-fill"
            onclick="return confirm('Apakah data jenis alat sudah benar?')">Simpan Alat</button>
    </form>
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
                    "<tr draggable='true'><td><input name='namaSpesifikasi[]' required /></td><td><input name='spesifikasi[]' required /></td><td><button type='button' onClick='delete_row(this)'>Hapus</button></td></tr>"
                );
            });

            $("#addSop").click(function() {
                var countItems = document.getElementById("spesifikasi-body").childElementCount;
                $("#sop-body").append(
                    "<tr draggable='true'><td><input name='sop[]' required /></td><td><button type='button' onClick='delete_row(this)'>Hapus</button></td></tr>"
                );
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
@endsection
