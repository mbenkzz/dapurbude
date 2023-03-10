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
                    <h1 class="mt-4">Edit Data Pengguna</h1>

                    <a href="<?= admin_url('user') ?>" class="btn btn-danger btn-sm mb-4"><i class="fas fa-arrow-left fa-fw mr-2"></i>Kembali ke tabel</a>

                    <div class="card mb-4">
                        <div class="card-body">
                            <form id="user_form">
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputUsername">Username</label>
                                    <input class="form-control py-4" id="inputUsername" name="username" type="text" placeholder="Masukkan username" value="<?= $user->username ?>" />
                                    <small class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputPassword">Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <input type="checkbox" id="passwordToggle" onchange="document.getElementById('inputPassword').disabled = !this.checked; document.getElementById('inputPassword').value = ''">
                                            </div>
                                        </div>
                                        <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Beri centang jika ingin mengganti password" disabled/>
                                    </div>
                                    <small class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputNama">Nama</label>
                                    <input class="form-control py-4" id="inputNama" name="fullname" type="text" placeholder="Masukkan nama" value="<?= $user->fullname ?>" />
                                    <small class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <label class="mb-1 font-size-20" for="inputRole">Role</label>
                                    <select class="form-control" id="inputRole" name="role">
                                        <option value="admin" <?= $user->role == 'admin' ? 'selected' : '' ?>>Admin</option>
                                        <option value="user" <?= $user->role == 'user' ? 'selected' : '' ?>>User</option>
                                    </select>
                                    <small class="form-text text-danger"></small>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <?php $this->load->view('admin/template-parts/footer') ?>
        </div>
    </div>
    <?php $this->load->view('admin/template-parts/scripts') ?>
    <script>
        $(document).ready(function() {
            $('#user_form').on('submit', function(e) {
                e.preventDefault()

                var form = this
                $.ajax({
                    url: '<?= admin_url("user/edit/{$user->id}") ?>',
                    type: "POST",
                    data: new FormData(form),
                    dataType: "JSON",
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(json) {
                        if (json.status == 'success') {
                            swal_success(json.message).then((value) => {
                                window.location.href = '<?= admin_url("user") ?>'
                            })
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
                })
            })
        })
    </script>
</body>

</html>