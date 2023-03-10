<!DOCTYPE html>
<html lang="id">

<head>
    <?php $this->load->view('admin/template-parts/head') ?>
</head>

<body class="sb-nav-fixed">
    <?php $this->load->view('admin/template-parts/header') ?>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php $this->load->view('admin/template-parts/sidebar') ?>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12" id="div_add_barang">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <span class="cursor-pointer" data-toggle="collapse" data-target="#add_barang_collapse" aria-expanded="false" aria-controls="add_barang_collapse">
                                        <i class="fas fa-table mr-1"></i>
                                        Tambah Baru
                                    </span>
                                    <button class="btn btn-sm btn-outline-secondary float-right" type="button" data-toggle="collapse" data-target="#add_barang_collapse" aria-expanded="false" aria-controls="add_barang_collapse">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div class="card-body py-0 collapse" id="add_barang_collapse">
                                    <form id="add_barang" class="pt-3" action="">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 mb-2">
                                                <label class="" for="add_barang_category">Kategori</label>
                                                <select class="form-control mr-sm-2" id="add_barang_category" name="category_id">
                                                    <option value="">Pilih Kategori</option>
                                                    <?php foreach ($categories as $category) : ?>
                                                        <option value="<?= $category->id ?>"><?= $category->name ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-lg-8 col-md-6 mb-2">
                                                <label class="" for="add_barang_name">Nama Barang</label>
                                                <input type="text" class="form-control mr-sm-2" id="add_barang_name" name="name" placeholder="Nama Barang">
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-6 mb-2">
                                                <label class="" for="add_barang_stock">Stok</label>
                                                <!-- inpt group with increase decrease button -->
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-outline-secondary" type="button" data-toggle="input-number" data-action="minus"><i class="fas fa-minus"></i></button>
                                                    </div>
                                                    <input type="text" class="form-control text-center input-number" id="add_barang_stock" name="stock" placeholder="Stok" value="0">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button" data-toggle="input-number" data-action="plus"><i class="fas fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-xl-2 col-lg-3 col-md-6 mb-2">
                                                <label class="" for="add_barang_unit">Satuan</label>
                                                <input type="text" name="unit" class="form-control mr-sm-2" placeholder="(pcs, Kg, dll)">
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-xl-4 col-lg-3 col-md-6 mb-2">
                                                <label class="" for="add_barang_buy_price">Harga Beli</label>
                                                <input type="number" class="form-control mr-sm-2" id="add_barang_buy_price" name="buy_price" placeholder="Harga Beli" min="0">
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-xl-4 col-lg-3 col-md-6 mb-2">
                                                <label class="" for="add_barang_price">Harga Jual</label>
                                                <input type="number" class="form-control mr-sm-2" id="add_barang_price" name="sell_price" placeholder="Harga Jual" min="0">
                                                <small class="text-danger"></small>
                                            </div>
                                            <div class="col-lg-12 col-md-12 mb-2">
                                                <button type="submit" class="btn btn-primary btn-block">Tambah</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-table mr-1"></i>
                                    Daftar Barang
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <!-- tabel barang -->
                                        <table class="table table-bordered datatable-items" width="100%" cellspacing="0">
                                            <thead>
                                                <th>Kode</th>
                                                <th>Nama Barang</th>
                                                <th>Stok</th>
                                                <th>Satuan</th>
                                                <th>Harga Beli</th>
                                                <th>Harga Jual</th>
                                                <th></th>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php $this->load->view('admin/template-parts/footer') ?>
        </div>
    </div>
    <div class="modal fade" id="modal_update_stock" data-backdrop="static" tabindex="-1"></div>
    <?php $this->load->view('admin/template-parts/scripts') ?>
    <script>
        var datatable_item;
        $(document).ready(function() {
            datatable_item = $('.datatable-items').DataTable({
                "language" : {
                    "url" : "<?= base_url('assets/json/datatables-id.json') ?>"
                },
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    "url": "<?= admin_url('items/datatables') ?>",
                    "type": "POST"
                },
                "columnDefs": [{
                    "targets": [3, 6],
                    "orderable": false,
                }, ],
            });
        });

        // form add barang handler
        $('#add_barang').submit(function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: "<?= admin_url('items/add') ?>",
                type: "POST",
                data: $(form).serialize(),
                dataType: "json",
                beforeSend: function() {
                    // remove help block
                    $(form).find('small').text('')
                    // disable button
                    $(form).find('button[type="submit"]').prop('disabled', true)
                },
                complete: function() {
                    // re enable button
                    $(form).find('button[type="submit"]').prop('disabled', false)
                },
                success: function(json) {
                    if (json.status == 'success') {
                        swal("Data berhasil ditambahkan!", {
                            icon: "success",
                        }).then((value) => {
                            form.reset();
                            datatable_item.draw(false);
                        });
                    } else {
                        // add help block
                        $.each(json.message, function(key, value) {
                            
                            var input = $(form).find('[name="' + key + '"]')

                            if(input.hasClass('input-number'))
                                var help_block = input.closest('.input-group').next('small')
                            else
                                var help_block = input.next('small')
                            help_block.text(value)
                        })
                    }
                }
            });
        });

        function edit_stock(id) {
            $.ajax({
                url: "<?= admin_url('items/edit_stock') ?>",
                type: "GET",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(json) {
                    if (json.status == 'success') {
                        $('#modal_update_stock').html(json.html);
                        $('#modal_update_stock').modal('show');
                    } else {
                        swal_error(json.message);
                    }
                }
            });
        }

        $(document).on('change input', '#edit_barang_stok', function(e) {
            // 0.5 1.45 34.65
            // if comma change to dot
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
            let $input = $(this);
            let addition = parseFloat($input.val());
            let before = parseFloat($('#edit_barang_stok_before').html());
            let after = before + addition;
            $('#edit_barang_stok_addition').text(addition);
            $('#edit_barang_stok_total').text(after);

            document.getElementById('edit_barang_stok_submit').disabled = (addition == 0);
        })

        $(document).on('submit', '#form_update_stock', function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: "<?= admin_url('items/update_stock') ?>",
                type: "POST",
                data: $(form).serialize(),
                dataType: "json",
                success: function(json) {
                    if (json.status == 'success') {
                        swal("Data berhasil diubah!", {
                            icon: "success",
                        }).then((value) => {
                            $('#modal_update_stock').modal('hide');
                            datatable_item.draw(false);
                        });
                    } else {
                        // remove all help block
                        $(form).find('small').text('')
                        // add help block
                        $.each(json.message, function(key, value) {
                            var input = $(form).find('[name="' + key + '"]')

                            var help_block = input.next('small')
                            help_block.text(value)
                        })
                    }
                }
            });
        });

    </script>
</body>

</html>