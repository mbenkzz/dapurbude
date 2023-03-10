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
                        <h1 class="mt-4">Your content here</h1>
                    </div>
                </main>
                <?php $this->load->view('admin/template-parts/footer') ?>
            </div>
        </div>
        <?php $this->load->view('admin/template-parts/scripts') ?>
    </body>
</html>
