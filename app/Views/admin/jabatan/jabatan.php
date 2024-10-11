<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>
    
    <!-- <a href="<?= base_url('admin/jabatan/create')?>" class="btn btn-primary"><i class="lni lni-circle-plus"></i> Tambah Data</a> -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="lni lni-circle-plus"></i>    
        Tambah Data
    </button>

    <!-- Modal -->
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahData" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahData">Form Tambah Data Jabatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url('admin/jabatan/store')?>" id="formTambah">
                    <?= csrf_field() ?>
                        <div class="input-style-1">
                            <label>Nama Jabatan</label>
                            <input type="text" name="jabatan" id="jabatan" placeholder="Nama Jabatan" class="form-control <?= isset(session('errors')['jabatan']) ? 'is-invalid' : '' ?>" value="<?= old('jabatan') ?>"/>
                        <div class="invalid-feedback"><?= isset(session('errors')['jabatan']) ? esc(session('errors')['jabatan']) : 'Nama Jabatan wajib diisi.' ?></div>
                        </div>
                        <!-- end input -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>                           
    <div class="table-responsive mt-2">
        <table class="table table-white table-striped" id="data-tables">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <?php $no = 1;
            foreach ($jabatan as $jab) :?>
                <tbody>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $jab['jabatan']?></td>
                        <td>
                            <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                Ubah Data
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditData" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalEditData">Modal title</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        ...
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="button" class="btn btn-primary">Simpan</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <a href="<?= base_url('admin/jabatan/delete/'. $jab['id'])?>" class="btn btn-danger mb-2">Hapus Data</a>
                        </td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    <!-- <script>
        $(function() {
            $("#formTambah").validate({
                rules: {
                    jabatan: "required"
                },
                messages: {
                    jabatan: "Nama Jabatan wajib diisi"
                }
            });
        });
    </script> -->

    <?php if(session()->getFlashdata('errors')): ?>
        <script>
            
            document.addEventListener('DOMContentLoaded', function() {
                
                var myModal = new bootstrap.Modal(document.getElementById('modalTambah'));
                // event.preventDefault();
                myModal.show();
            });

            $(function() {
            $("#formTambah").validate({
                rules: {
                    jabatan: "required"
                },
                messages: {
                    jabatan: "Nama jabatan wajib diisi"
                }
            });
            // event.preventDefault();
        });
        </script>
    <?php endif; ?>
<?= $this->endSection() ?>